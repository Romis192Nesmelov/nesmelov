<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Settings;
use Illuminate\Support\Facades\Gate;
use App\Task;
use App\Bill;

class HelperController extends Controller
{
    use HelperTrait;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function calculateTaskValForBill($item)
    {
        if ($item instanceof Bill) {
            if ($item->task->paid_off) {
                $billNumber = 1;
                foreach ($item->task->bills as $bill) {
                    if ($item->id == $bill->id) break;
                    else $billNumber++;
                }
                $value = $billNumber == 1 ? $item->task->paid_off : $item->task->value - $item->task->paid_off;
            } else $value = $item->task->value;
        } else {
            $task = $item instanceof Task ? $item : Task::find($item);
            $value = $task->value + $this->calculateSubTasksValue($task);
            if ($task->paid_off) {
                $value = count($task->bills) == 1 ? $value - $task->paid_off : $task->paid_off;
            };
        }
        return $this->moneyFormat($value).'₽';
    }

    public function calculateOverTaskVal($task, $fullVal=true, $percents=false, $duty=false, $checkFake=false)
    {
        $value = $task->value;

        if ($task instanceof Task) $value += $this->calculateSubTasksValue($task,$percents);
        $baseValue = $value;

        if ($checkFake && $task->status == 7) $value = $this->calculateMyPercent($task, $baseValue);
        elseif ( ($task->status == 3 || $task->status == 4) && $task->paid_off && !$fullVal) $value = $task->paid_off;

        if ($duty) $value -= $this->calculateTaskDuty($value, $task);
        if ($percents && $task->percents) $value -= $this->calculateTaskPercents($value,$task->percents);
        if ($task->paid_off && !$fullVal) $value -= $task->paid_off;

        return $value;
    }
    
    public function calculateSubTasksValue($task, $percents=false)
    {
        $value = 0;
        if (isset($task->subTasks) && count($task->subTasks)) {
            foreach($task->subTasks as $subTask) {
//                if ($subTask->status == 1 || $subTask->status == 2 || $subTask->status == 7)
                    $value += $percents && $subTask->percents ? $subTask->value - $this->calculateTaskPercents($subTask->value,$subTask->percents) : $subTask->value;
            }
        }
        return $value;
    }
    
    public function calculateTaskDuty($value, $task)
    {
        $settings = Settings::getSettings();
        return $value * (int)($task->tax_type || $task->ltd != 2 ? $settings['tax1'] : $settings['tax2']) * 0.01;
    }
    
    public function calculateTaskPercents($value, $percents)
    {
        return $value * $percents * 0.01;
    }
    
    public function calculateMyPercent(Task $task, $value)
    {
        return $value * ($task->my_percent ? $task->my_percent : (int)Settings::getSettings()['my_percent']) * 0.01;
    }
    
    public function moneyFormat($value)
    {
        return number_format($value, 0, ',', ' ');
    }

    public function ruNumScript($value)
    {
        # Все варианты написания чисел прописью от 0 до 999 скомпонуем в один небольшой массив
        $m = [
            ['ноль'],
            ['-','один','два','три','четыре','пять','шесть','семь','восемь','девять'],
            ['десять','одиннадцать','двенадцать','тринадцать','четырнадцать','пятнадцать','шестнадцать','семнадцать','восемнадцать','девятнадцать'],
            ['-','-','двадцать','тридцать','сорок','пятьдесят','шестьдесят','семьдесят','восемьдесят','девяносто'],
            ['-','сто','двести','триста','четыреста','пятьсот','шестьсот','семьсот','восемьсот','девятьсот'],
            ['-','одна','две']
        ];

        # Все варианты написания разрядов прописью скомпануем в один небольшой массив
        $r = [
            ['...ллион','','а','ов'], // используется для всех неизвестно больших разрядов
            ['тысяч','а','и',''],
            ['миллион','','а','ов'],
            ['миллиард','','а','ов'],
            ['триллион','','а','ов'],
            ['квадриллион','','а','ов'],
            ['квинтиллион','','а','ов']
            // ,[... список можно продолжить
        ];

        if ($value==0) return $m[0][0]; # Если число ноль, сразу сообщить об этом и выйти
        $o = []; # Сюда записываем все получаемые результаты преобразования

        # Разложим исходное число на несколько трехзначных чисел и каждое полученное такое число обработаем отдельно
        foreach (array_reverse(str_split(str_pad($value,ceil(strlen($value)/3)*3,'0',STR_PAD_LEFT),3))as$k=>$p) {
            $o[$k] = [];

            # Алгоритм, преобразующий трехзначное число в строку прописью
            foreach ($n = str_split($p) as $kk => $pp)
                if (!$pp) continue;
                else
                    switch ($kk) {
                        case 0:$o[$k][]=$m[4][$pp];break;
                        case 1:if($pp==1){$o[$k][]=$m[2][$n[2]];break 2;}else$o[$k][]=$m[3][$pp];break;
                        case 2:if(($k==1)&&($pp<=2))$o[$k][]=$m[5][$pp];else$o[$k][]=$m[1][$pp];break;
                    } $p*=1;if(!$r[$k])$r[$k]=reset($r);

            # Алгоритм, добавляющий разряд, учитывающий окончание руского языка
            if ($p&&$k) switch (true) {
                case preg_match("/^[1]$|^\\d*[0,2-9][1]$/",$p):$o[$k][]=$r[$k][0].$r[$k][1];break;
                case preg_match("/^[2-4]$|\\d*[0,2-9][2-4]$/",$p):$o[$k][]=$r[$k][0].$r[$k][2];break;
                default: $o[$k][]=$r[$k][0].$r[$k][3];break;
            }
            $o[$k] = implode(' ',$o[$k]);
        }

        return $this->mbStrToUpper(implode(' ',array_reverse($o)));
    }

    public function mbStrToUpper($str, $encoding = 'UTF8')
    {
        return mb_strtoupper(mb_substr($str, 0, 1, $encoding), $encoding).mb_substr($str, 1, mb_strlen($str, $encoding), $encoding);
    }
    
    public function mbFirstStrToLower($str, $encoding = 'UTF8')
    {
        $fc = mb_strtolower(mb_substr($str, 0, 1, $encoding), $encoding);
        return $fc.mb_substr($str, 1, mb_strlen($str, $encoding), $encoding);
    }
    
    public function isFinalBill(Bill $bill)
    {
        return !$bill->task->paid_off || ($bill->task->paid_off && count($bill->task->bills) > 1 && $bill->task->bills[count($bill->task->bills)-1]->id == $bill->id);
    }
    
    public function isFakeTask($data)
    {
        return isset($data['task']) && $data['task']->status >= 6;
    }

    public function isPrivatePersonTheCustomer($data)
    {
        return !isset($data['customer']) || (isset($data['customer']) && $data['customer']->ltd == 2);
    }
    
    public function isPrivatePersonTheCustomerOfTask($data)
    {
        return (!isset($data['task']) && $data['customers'][0]->ltd == 2) || (isset($data['task']) && $data['task']->customer->ltd == 2);
    }
    
    public function isUsedDuty($data)
    {
        return (!isset($data['task']) || (isset($data['task']) && $data['task']->use_duty));
    }

    public function forbbidenTaskEdit($task)
    {
        return (
            Gate::denies('owner-or-user-task',$task) ||
            (
                ($task->status == 1 || $task->status == 6) &&
                date('Y', $task->completion_time) != date('Y')
            )
        );
    }
}
