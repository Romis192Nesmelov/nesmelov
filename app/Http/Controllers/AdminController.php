<?php

namespace App\Http\Controllers;

use App\Work;
use Illuminate\Http\Request;
use App\Customer;
use App\User;
use App\Task;
use App\News;
use App\Branch;
use App\Question;
use App\SentEmail;
use Illuminate\Support\Facades\Settings;
use Illuminate\Support\Facades\Helper;

class AdminController extends UserController
{
    use HelperTrait;

    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->middleware('auth.admin');
    }

    public function seo()
    {
        $this->breadcrumbs = ['seo' => 'SEO'];
        $this->data['metas'] = $this->metas;
        $this->data['seo'] = Settings::getSeoTags();
        return $this->showView('seo');
    }

    public function settings()
    {
        $this->breadcrumbs = ['settings' => 'Настройки'];
        $this->data['settings'] = Settings::getSettings();
        $this->data['requisites'] = Settings::getRequisites();
        $this->getFixTax();
        return $this->showView('settings');
    }

    public function statistics($slug=null)
    {
        $this->data['years'] = [];
        $this->data['done_tasks_for_all_years'] = [];

        if ($slug && preg_match($this->regYear,$slug)) {
            if (!$this->checkYear($slug)) return redirect()->back();
            $this->data['year'] = $slug;
        } else $this->data['year'] = date('Y');

        if ($this->request->has('slider-months') && $this->request->input('slider-months')) {
            list($minVal, $maxVal) = explode(',',$this->request->input('slider-months'));
        } else {
            $minVal = 1;
            $maxVal = $this->data['year'] != date('Y') ? 12 : date('n');
        }

        for($y=2018;$y<=(int)date('Y');$y++) {
            $this->data['years'][] = $y;
            $this->data['done_tasks_for_all_years'][$y] = [];
            for ($m=$minVal;$m<=$maxVal;$m++) {
                $this->data['done_tasks_for_all_years'][$y][$m] = 0;
            }
        }

        $this->data['max_month'] = $this->data['year'] != date('Y') ? 12 : date('n');
        $this->data['min_val'] = $minVal;
        $this->data['max_val'] = $maxVal;

        $tasks = Task::all();
        foreach ($tasks as $task) {

            // Merge statistics
            if (count($task->statistics)) {
                $statusesTask = [];
                foreach ($task->statistics as $statistic) {
                    $add = true;
                    if (count($statusesTask)) {
                        foreach ($statusesTask as $status) {
                            if ($status['status'] == $statistic->status && $status['year'] == $statistic->created_at->format('Y') && $status['month'] == $statistic->created_at->format('Y')) {
                                $statistic->delete();
                                $add = false;
                            }
                        }
                    }
                    if ($add) $statusesTask[] = [
                        'id' => $statistic->id,
                        'status' => $statistic->status,
                        'year' => $statistic->created_at->format('Y'),
                        'month' => $statistic->created_at->format('Y')
                    ];
                }
            }

            // Filling data of done tasks for all years
            $month = null;
            $year = null;
            if ($task->status == 1 || $task->status == 2 || $task->status == 7) {
                if (date('n',$task->completion_time) >= $minVal && date('n',$task->completion_time) <= $maxVal) {
                    $year = date('Y',$task->completion_time);
                    $month = date('n',$task->completion_time);
                } elseif ($task->payment_time && date('n',$task->payment_time) >= $minVal && date('n',$task->payment_time) <= $maxVal) {
                    $year = date('Y',$task->payment_time);
                    $month = date('n',$task->payment_time);
                }
                if ($month && $year) $this->data['done_tasks_for_all_years'][$year][$month] += (int)Helper::calculateOverTaskVal($task, true, true, true, true);
            }
        }

        $this->getStatuses();
        $this->getStatusesSimple();
        $this->getFixTax();
        $this->getBackUri($this->request->path());
        $this->data['income_statuses'] = $this->incomeStatuses;
        
        $this->breadcrumbs['statistics/'.$this->data['year']] = 'Статистика за '.$this->data['year'].' год';
        $min = strtotime('01.'.$this->data['min_val'].'.'.$this->data['year']);
        $max = $this->data['max_val'] == 12 ? strtotime('01.01'.($this->data['year']+1)) : strtotime('01.'.($this->data['max_val']+1).'.'.$this->data['year']);
        
        $this->data['last_day_in_month'] = $this->data['year'] != date('Y') ? date('t',$min) : date('j');

        $this->data['tasks'] = Task::where(function($query) use ($min, $max) {
                                    $query->where('start_time','>=',$min)->where('start_time','<=',$max);
//                                })->orWhere(function($query) {
//                                    $minDate = Carbon::createFromDate($this->data['year'], $this->data['min_val'], 1, 'Europe/Moscow');
//                                    $maxDate = Carbon::createFromDate($this->data['year'], $this->data['max_val']+1, 1, 'Europe/Moscow');
//                                    $query->where('created_at','>=',$minDate)->where('created_at','<=',$maxDate);
                                })->orWhere(function($query) use ($min, $max) {
                                    $query->where('completion_time','>=',$min)->where('completion_time','<=',$max);
                                })->orWhere(function($query) use ($min, $max) {
                                    $query->where('payment_time','>=',$min)->where('payment_time','<=',$max);
                                })->orderBy('start_time','desk')->get();

        $this->getTasksInWork();

        $this->data['done_tasks'] = Task::where(function($query) use ($min, $max) {
                                            $query->where('status',1)->where('completion_time','>=',$min)->where('completion_time','<=',$max);
                                        })->orWhere(function($query) use ($min, $max) {
                                            $query->where('status',1)->where('payment_time','>=',$min)->where('payment_time','<=',$max);
                                        })->get();

        $this->data['wait_tasks'] = Task::where('status',2)->where('completion_time','>=',$min)->where('completion_time','<=',$max)->get();
        $this->data['in_work_tasks'] = Task::where('status',3)->where('paid_off','>',0)->where('start_time','>=',$min)->where('start_time','<=',$max)->get();

        return $this->showView('statistics');
    }

    public function chapters($slug=null, $subSlug=null)
    {
        $this->breadcrumbs = ['chapters' => 'Разделы лендинга'];
        if ($slug) {
            $this->data['chapter'] = Branch::where('eng',$slug)->first();
            if (!$this->data['chapter']) abort(404,'Page not found');
            $this->breadcrumbs['chapters/'.$this->data['chapter']->eng] = $this->data['chapter']->rus;
            
            if ($this->request->has('id')) {
                $this->validate($this->request, ['id' => $this->validationId.'works']);
                $this->data['work'] = Work::find($this->request->id);
                $this->breadcrumbs['chapters/' . $this->data['chapter']->eng.'?id='.$this->data['work']->id] = $this->data['work']->name;
                return $this->showView('work');
            } elseif ($subSlug && $subSlug == 'add') {
                $this->breadcrumbs['chapters/' . $this->data['chapter']->eng.'/add'] = 'Добавление работы';
                return $this->showView('work');
            } else {
                return $this->showView('chapter');
            }
        } else {
            $this->data['chapters'] = Branch::all();
            return $this->showView('chapters');
        }
    }
    
    public function news($slug=null)
    {
        $this->breadcrumbs = ['chapters/news' => 'Новости'];
        if ($slug && $slug != 'add') {
            $this->data['news'] = News::where('slug',$slug)->first();
            $this->breadcrumbs['news/'.$this->data['news']->slug] = $this->data['news']->head;
            return $this->showView('news');
        } else if ($slug && $slug == 'add') {
            $this->breadcrumbs['chapters/news/add'] = 'Добавление новости';
            return $this->showView('news');
        } else {
            $this->data['news'] = News::orderBy('time','desc')->paginate(10);
            return $this->showView('all_news');
        }
    }

    public function questions($slug=null)
    {
        $this->breadcrumbs = ['questions' => 'Вопросы-ответы'];
        if ($this->request->has('id')) {
            $this->validate($this->request, ['id' => $this->validationId.'questions']);
            $this->data['question'] = Question::find($this->request->id);
            $this->breadcrumbs['questions/?id='.$this->request->id] = $this->data['question']->question;
            return $this->showView('question');
        } else if ($slug && $slug == 'add') {
            $this->breadcrumbs['questions/add'] = 'Добавление вопроса';
            return $this->showView('question');
        } else {
            $this->data['questions'] = Question::all();
            return $this->showView('questions');
        }
    }
    
    public function sentEmails()
    {
        $this->breadcrumbs = ['sent-emails' => 'Отправленные'];
        if ($this->request->has('id')) {
            $this->validate($this->request, ['id' => $this->validationId.'sent_emails']);
            $this->data['email'] = SentEmail::find($this->request->id);
            $this->breadcrumbs['sent-emails/?id='.$this->request->id] = $this->data['email']->created_at;
            return $this->showView('sent_email');
        } else {
            $this->data['emails'] = SentEmail::orderBy('id','desc')->get();
            return $this->showView('sent_emails');
        }
    }

    public function editSeo()
    {
        $this->validate($this->request, [
            'title' => 'max:255',
            'meta_description' => 'max:4000',
            'meta_keywords' => 'max:4000',
            'meta_twitter_card' => 'max:255',
            'meta_twitter_size' => 'max:255',
            'meta_twitter_creator' => 'max:255',
            'meta_og_url' => 'max:255',
            'meta_og_type' => 'max:255',
            'meta_og_title' => 'max:255',
            'meta_og_description' => 'max:4000',
            'meta_og_image' => 'max:255',
            'meta_robots' => 'max:255',
            'meta_googlebot' => 'max:255',
            'meta_google_site_verification' => 'max:255',
        ]);
        Settings::saveSeoTags($this->request);
        $this->saveCompleteMessage();
        return redirect('/admin/seo');
    }
    
    public function editSettings()
    {
        $this->validate($this->request, [
            'tax' => 'required|integer|max:90',
            'tax1' => 'required|integer|max:90',
            'tax2' => 'required|integer|max:90',
            'my_percent' => 'required|integer|min:10|max:90',
            'fix_tax' => 'required|integer|min:5000|max:100000',
            'address' => 'required|min:10|max:255',
            'tin' => 'required|size:12',
            'bank_ie' => $this->validationBankName,
            'bank_se' => $this->validationBankName,
            'bank_id_ie' => $this->validationBankId,
            'bank_id_se' => $this->validationBankId,
            'checking_account_ie' => $this->validationCheckingAccount,
            'checking_account_se' => $this->validationCheckingAccount,
            'correspondent_account_ie' => $this->validationCorrespondentAccount,
            'correspondent_account_se' => $this->validationCorrespondentAccount
        ]);

        $fieldsSettings = $this->processingFields('show_text', [
            'address',
            'tin',
            'bank_ie',
            'bank_se',
            'bank_id_ie',
            'bank_id_se',
            'checking_account_ie',
            'checking_account_se',
            'correspondent_account_ie',
            'correspondent_account_se'
        ]);

        $fieldsRequisites = $this->processingFields('show_text', [
            'tax',
            'tax1',
            'tax2',
            'my_percent',
            'fix_tax',
        ]);

        Settings::saveSettings($fieldsSettings, $fieldsRequisites);
        $this->getFixTax();
        $this->data['fix_tax']->update(['value' => $this->request->fix_tax]);
        $this->saveCompleteMessage();
        return redirect('/admin/settings');
    }

    public function editChapter()
    {
        $validationArr = [
            'id' => $this->validationId.'branches',
            'image' => $this->validationImage,
            'rus' => 'required|min:2|max:20|unique:branches,rus,'.$this->request->id,
            'text' => 'required|min:100|max:3000',
        ];
        
        if ($this->request->full_portfolio) $validationArr['full_portfolio'] = 'active_url';

        $fields = $this->processingFields('active', 'image');
        $this->validate($this->request, $validationArr);

        $chapter = Branch::find($this->request->id);
        $fields = array_merge($fields, $this->processingImage($chapter, 'image', $chapter->eng.'_bg'));

        $chapter->update($fields);
        $this->saveCompleteMessage();
        return redirect('/admin/chapters/'.$chapter->eng);
    }

    public function editWork()
    {
        $validationArr = [
            'branch_id' => $this->validationId.'branches,id',
            'preview' => $this->validationImage,
            'full' => $this->validationImage,
            'name' => 'required|min:3|max:20',
            'description' => 'required|min:5|max:500',
        ];

        if ($this->request->has('branch_id') && ($this->request->branch_id == 2 || $this->request->branch_id == 5)) {
            $validationArr['url'] = 'unique:works,url';
        }

        $fields = $this->processingFields('active', ['preview','full']);
        if ($this->request->has('id')) {
            $validationArr['id'] = $this->validationId.'works';
            if (isset($validationArr['url'])) $validationArr['url'] .= ','.$this->request->id;

            $this->validate($this->request, $validationArr);

            $work = Work::find($this->request->id);
            $fields = array_merge($fields, $this->processingWorkImageFields($work));
        } else {
            $validationArr['preview'] = 'required|'.$this->validationImage;
            if (!isset($validationArr['url'])) {
                $validationArr['full'] = 'required|'.$this->validationImage;
                $fields['full'] = '';
            }
            $this->validate($this->request, $validationArr);

            $fields['preview'] = '';
            $work = Work::create($fields);
            $fields = $this->processingWorkImageFields($work);
        }
        $work->update($fields);
        $this->saveCompleteMessage();
        return redirect('/admin/chapters/'.$work->branch->eng);
    }

    public function editNews()
    {
        $validateArr = [
            'image' => 'image|min:20|max:3000',
            'head' => 'required|max:255|unique:news,head',
            'short' => 'required|max:255',
            'text' => 'required|min:10|max:100000'
        ];
        $fields = $this->processingFields(['active','important'], 'image', 'time');

        if ($this->request->has('id')) {
            $validateArr['id'] = $this->validationId.'news';
            $validateArr['head'] .= ','.$this->request->id;

            $this->validate($this->request, $validateArr);
            $news = News::find($this->request->id);

            $imageFields = $this->processingNewsImage($news);
            if (count($imageFields)) $fields = array_merge($fields, $imageFields);
            $news->update($fields);
            $this->processingImportantNews($news->id, $fields);
        } else {
            $this->validate($this->request, $validateArr);
            $news = News::create($fields);

            $imageFields = $this->processingNewsImage($news);
            if (count($imageFields)) $news->update($imageFields);
            $this->processingImportantNews($news->id, $fields);
        }
        $this->saveCompleteMessage();
        return redirect('/admin/chapters/news/'.$news->slug);
    }

    public function editQuestion()
    {
        $validateArr = [
            'question' => 'required|max:255',
            'answer' => 'required|max:2000',
        ];
        $fields = $this->processingFields('active');

        if ($this->request->has('id')) {
            $validateArr['id'] = $this->validationId.'questions';
            $this->validate($this->request, $validateArr);
            $question = Question::find($this->request->id);
            $question->update($fields);
        } else {
            $this->validate($this->request, $validateArr);
            Question::create($fields);
        }
        $this->saveCompleteMessage();
        return redirect('/admin/questions');
    }

    public function deleteUser()
    {
        return $this->deleteSomething(new User());
    }

    public function deleteNews()
    {
        return $this->deleteSomething(new News(), 'image');
    }

    public function deleteCustomer()
    {
        return $this->deleteSomething(new Customer());
    }

    public function deleteWork()
    {
        $this->validate($this->request, ['id' => $this->validationId.'works']);
        $work = Work::find($this->request->id);

        if ($work->branch->id == 2) $filesFields = 'preview';
        elseif ($work->branch->id == 5) $filesFields = ['preview','url'];
        else $filesFields = ['full','preview'];

        return $this->deleteSomething(new Work(), $filesFields);
    }

    public function deleteQuestion()
    {
        return $this->deleteSomething(new Question());
    }
    
    public function deleteSentEmail()
    {
        return $this->deleteSomething(new SentEmail());
    }

    private function processingNewsImage($news)
    {
        return $this->processingImage($news, 'image', 'news_'.$news->id, 'images/news');
    }

    private function processingImportantNews($id, $fields)
    {
        if ($fields['important'] && $lastImntNews = News::where('important',1)->where('id','!=',$id)->first()) {
            $lastImntNews->important = 0;
            $lastImntNews->save();
        }
    }
}