<?php

namespace App\Http\Controllers;

use App\Statistic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Task;
use App\SubTask;
use App\Message;
use App\Customer;
use App\Bank;
use App\Bill;
use App\FixTax;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Settings;
use Illuminate\Support\Facades\Helper;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    use HelperTrait;

    private $yearTime = (60 * 60 * 24 * 365);
    protected $request;
    
    public function __construct(Request $request)
    {
        $this->middleware('auth');
        $this->request = $request;
    }

    public function index()
    {
        return redirect('/admin/tasks');
    }

    public function users($slug=null)
    {
        $this->breadcrumbs = ['users' => 'Пользователи'];
        if ($this->request->has('id')) {
            $this->data['user'] = User::findOfFail($this->request->id);
            if (Gate::denies('user-edit',$this->data['user'])) abort(403, $this->youHaveNoRights);
            $this->breadcrumbs['users?id='.$this->data['user']->id] = $this->data['user']->name;
            return $this->showView('user');
        } else if ($slug && $slug == 'add') {
            if (Gate::denies('is-admin')) abort(403, $this->youHaveNoRights);
            $this->breadcrumbs['users/add'] = 'Добавление пользователя';
            return $this->showView('user');
        } else {
            $this->data['users'] = Gate::allows('is-admin') ? User::all() : User::where('id',Auth::id())->get();
            return $this->showView('users');
        }
    }

    public function tasks($slug=null, $subslug=null)
    {
        $this->breadcrumbs = ['tasks' => 'Задачи'];
        $this->getStatusesSimple();

        if ($this->request->has('id') || ($slug && $slug == 'add')) {
            $this->data['users'] = User::all();
            $this->getStatuses();

            if ($this->request->has('id')) {
                $this->data['task'] = Task::findOrFail($this->request->id);

                $this->data['customers'] = Customer::where('type','<',5)->orWhere('id',$this->data['task']->customer_id)->orderBy('slug')->get();
                $this->data['bills_statuses'] = $this->billsStatuses;

                if (Helper::forbbidenTaskEdit($this->data['task'])) abort(403, $this->youHaveNoRights);

                $this->breadcrumbs['tasks?id='.$this->data['task']->id] = $this->data['task']->name;
                $this->checkTaskMessages();
                $this->data['convention_number'] = $this->getLastConventionNumber($this->data['task']->customer);
                return $this->showView('task');
            } elseif ($slug && $slug == 'add') {
                $this->data['customers'] = Customer::where('type','<',5)->orderBy('slug')->get();
                if ($subslug) {
                    $this->data['customer'] = Customer::where('slug',$subslug)->first();
                    if (!$this->data['customer'] || $this->data['customer']->type == 5) abort(404);
                    $this->breadcrumbs['tasks/add/'.$subslug] = 'Добавление задачи для '.$this->data['customer']->name;
                } else {
                    $this->breadcrumbs['tasks/add'] = 'Добавление задачи';
                }

                $this->data['convention_number'] = isset($this->data['customer']) ? $this->getLastConventionNumber($this->data['customer']) : 1;
                return $this->showView('task');
            }

        } else if ( ($slug && preg_match($this->regYear,$slug)) || ($subslug && preg_match($this->regYear,$subslug)) ) {
            $this->getBackUri($this->request->path());
            $this->data['year'] = ($slug && preg_match($this->regYear,$slug)) ? (int)$slug : (int)$subslug;

            if ($this->data['year'] < 2018 || $this->data['year'] > date('Y')) abort(404);
            $this->breadcrumbs['tasks/'.$this->data['year']] = 'Задачи за '.$this->data['year'].' год';

            $this->getTasks($slug);
            $this->getSidebar();
            $this->getFixTax();
            return $this->showView('tasks');
            
        } else {
            $this->getBackUri($this->request->path());
            $this->data['year'] = date('Y');

            $this->getTasks($slug);
            $this->getSidebar();
            $this->getFixTax();

            if (!$this->data['fix_tax']) {
                $lastFixTax = FixTax::orderBy('id','desc')->first()->year;
                $this->data['fix_tax'] = FixTax::create([
                    'value' => $lastFixTax,
                    'year' => (int)date('Y')
                ]);
            }
            return $this->showView('tasks');
        }
    }

    public function subTask($slug=null)
    {
        $this->breadcrumbs = ['tasks' => 'Задачи'];
        $this->getStatusesSimple();

        if ($slug && $slug == 'add') {
            $this->validate($this->request, ['id' => $this->validationId.'tasks']);
            $this->getStatuses();
            $this->data['task'] = Task::find($this->request->id);
            $this->checkTaskEditRights($this->request->status, $this->data['task']->customer->type, $this->data['task']);
            $this->breadcrumbs['tasks?id='.$this->data['task']->id] = $this->data['task']->name;
            $this->breadcrumbs['tasks/sub_task/add?id='.$this->data['task']->id] = 'Добавление подзадачи к задаче '.$this->data['task']->name;
            return $this->showView('sub_task');
        } else {
            $this->validate($this->request, ['id' => $this->validationId.'sub_tasks']);
            $this->getStatuses();
            $this->data['sub_task'] = SubTask::findOrFail($this->request->id);
            $this->data['task'] = $this->data['sub_task']->task;

            $this->breadcrumbs['tasks?id='.$this->data['sub_task']->task->id] = $this->data['sub_task']->task->name;
            $this->breadcrumbs['tasks/sub_task?id='.$this->data['sub_task']->id] = $this->data['sub_task']->name;
            $this->checkTaskMessages();
            return $this->showView('sub_task');
        }
    }
    
    public function messages()
    {
        $this->breadcrumbs = ['messages' => 'Сообщения'];
        $messages =
            Gate::allows('is-admin') ?
            Message::orderBy('id','desc')->get() :
            Message::where('user_id',Auth::id())->orWhere('owner_id',Auth::id())->orderBy('id','desc')->get();

        $this->data['messages_list'] = $messages;
        return $this->showView('messages');
    }

    public function customers($slug=null)
    {
        $this->breadcrumbs = ['customers' => 'Клиенты'];
        $this->getBackUri($this->request->path());

        if ($slug && $slug != 'add') {
            $this->data['banks'] = Bank::all();
            $this->data['customer'] = Customer::where('slug',$slug)->first();
            if (!$this->data['customer']) abort(404);
            $this->getStatusesSimple();
            $this->breadcrumbs['customers/'.$this->data['customer']->slug] = $this->data['customer']->name;
            return $this->showView('customer');
        } else if ($slug && $slug == 'add') {
            $this->breadcrumbs['customers/add'] = 'Добавление клиента';
            $this->data['banks'] = Bank::all();
            return $this->showView('customer');
        } else {
            $customers = new Customer();
            $this->data['customers'] = Gate::allows('is-admin') ? $customers->orderBy('type')->get() : $customers->whereIn('type',[1,2,3])->get();
            return $this->showView('customers');
        }
    }

    public function banks($slug=null)
    {
        $this->breadcrumbs = ['banks' => 'Банки'];
        $this->data['banks'] = Bank::all();

        if ($this->request->has('id')) {;
            $this->validate($this->request, ['id' => $this->validationId.'banks']);
            $this->data['bank'] = Bank::find($this->request->id);
            $this->breadcrumbs['banks/?id='.$this->data['bank']->id] = $this->data['bank']->name;
            return $this->showView('bank');
        } else if ($slug && $slug == 'add') {
            $this->breadcrumbs['banks/add'] = 'Добавление банка';
            return $this->showView('bank');
        } else {
            return $this->showView('banks');
        }
    }
    
    private function getTasks($slug)
    {
        $timestamp = strtotime('01-01-'.$this->data['year']);

        $model = new Task();
        $modelForYear = clone $model;

        $tasks = $model
            ->where(
                function($query) use ($timestamp) {
                    $query
                        ->where('completion_time','>=',$timestamp)->where('completion_time','<=',($timestamp + $this->yearTime))
                        ->orWhere('start_time','>=',$timestamp)->where('start_time','<=',($timestamp + $this->yearTime));
                }
            )
            ->orderBy('customer_id');

        $tasksConditions = array_keys($this->taskGetCondition);

        if ($slug && in_array($slug, $tasksConditions)) {
            $status = array_search($slug, $tasksConditions)+1;
            $this->getTasksInWork($status);

            $this->breadcrumbs['tasks/'.$slug] = $this->taskGetCondition[$slug];

            $tasks = $tasks->where('status',$status);
            $modelForYear = $modelForYear->where('status',$status);
        } else {
            $this->getTasksInWork();
        }

        if (Gate::allows('is-admin')) {
            $this->data['tasks'] = $tasks->get();
            $this->getTaskYears($modelForYear->orderBy('start_time')->pluck('start_time')->toArray());
        } else {
            $taskOwn = clone $tasks;
            $modelForYearOwn = clone $modelForYear;

            $this->getTaskYears($modelForYear->where('user_id',Auth::id())->orderBy('start_time')->pluck('start_time')->toArray());
            $this->getTaskYears($modelForYearOwn->where('owner_id',Auth::id())->orderBy('start_time')->pluck('start_time')->toArray());

            $this->data['tasks'] = $tasks->where('user_id',Auth::id())->get();
            $this->data['own_tasks'] = $taskOwn->where('owner_id',Auth::id())->get();
        }
    }

    public function bills($slug=null)
    {
        $this->breadcrumbs = ['bills' => 'Счета'];
        $this->data['statuses'] = $this->billsStatuses;
        $this->getLastBillNumber();
        if ($this->request->has('id') && $this->request->id) {
            $this->validate($this->request, ['id' => $this->validationId.'bills']);
            $this->data['bill'] = Bill::find($this->request->id);
            if (
                !$this->data['bill'] ||
                (
                    $this->data['bill']->task->status > 2 &&
                    $this->data['bill']->task->status < 6 &&
                    !($this->data['bill']->task->status == 3 && $this->data['bill']->task->paid_off)
                ) ||
                Gate::denies('check-rights',[$this->data['bill'],'user_id']) ||
                $this->data['bill']->task->customer->ltd == 2
            ) abort(403, $this->youHaveNoRights);

            $this->data['year'] = date('Y',$this->data['bill']->task->start_time);
            $this->getStatusesSimple();
            $this->getDataForBill($this->data['bill']->task->id);
            $this->breadcrumbs['bills/'.$this->data['bill']->slug] = 'Счет №'.$this->data['bill']->number;
            return $this->showView('bill');
        } else if ($slug && $slug == 'add') {
            $this->breadcrumbs['bills/add'] = 'Добавление счета';
            $this->getDataForBill($this->request->has('task_id') ? $this->request->task_id : null);
            if (!count($this->data['tasks'])) abort(403, $this->youHaveNoRights);
            return $this->showView('bill');
        } else if ($slug && $slug != 'add') {
            $customer = Customer::where('slug',$slug)->first();
            if (!$customer) abort(404);
            elseif ($customer->ltd == 2) abort(403, $this->youHaveNoRights);

            $this->data['head'] = 'Счета '.$customer->name;
            $this->getDataForBill();
            $tasksIds = Task::where('customer_id',$customer->id)->pluck('id')->toArray();
            $this->data['bills'] =
                Gate::allows('is-admin') ?
                Bill::whereIn('task_id',$tasksIds)->orderBy('date','desc')->get() :
                Bill::where('user_id',Auth::id())->whereIn('task_id',$tasksIds)->orderBy('date','desc')->get();
            return $this->showView('bills');
        } else {
            $this->data['head'] = 'Счета';
            $this->getDataForBill();
            $this->data['bills'] =
                Gate::allows('is-admin') ?
                Bill::orderBy('number','desc')->get() :
                Bill::where('user_id',Auth::id())->orderBy('number','desc')->get();
            return $this->showView('bills');
        }
    }

    public function printDoc($slug)
    {
        if ($this->request->has('stamp') && $this->request->stamp) $signature = 'stamp.png';
        elseif ($this->request->has('signature') && $this->request->signature) $signature = 'signature.png';
        else $signature = false;

        $taxType = (bool)$this->request->tax_type;

        $savedCustomerFields = [
            'saved_contract',
            'saved_additional',
        ];
        
        $savedTaskFields = [
            'saved_convention',
        ];

        $savedBillFields = [
            'saved_act',
            'saved_bill',
            
        ];
        
        if (!in_array($slug,array_merge(['contract','convention','act','bill'],$savedCustomerFields,$savedTaskFields,$savedBillFields))) abort(404);
        
        if (in_array($slug,$savedCustomerFields) || $slug == 'contract') {
            return $this->getDocument($slug, $signature, $taxType, new Customer(), $savedCustomerFields);
        } elseif (in_array($slug,$savedTaskFields) || $slug == 'convention') {
            return $this->getDocument($slug, $signature, $taxType, new Task(), $savedTaskFields);
        } else {
            return $this->getDocument($slug, $signature, $taxType, new Bill(), $savedBillFields);
        }
    }
    
    private function getDocument($slug, $signature, $taxType, Model $model, array $savedFields)
    {
        $model = $model->findOrFail($this->request->id);

        if (in_array($slug,$savedFields)) return view('docs.empty', ['content' => $model[str_replace('saved_','',$slug)]]);
        else return view('docs.'.$slug, ['item' => $model, 'signature' => $signature, 'taxType' => $taxType]);
    }

    public function editUser()
    {
        $validationArr = [
            'name' => 'required|max:255|unique:users,name',
            'phone' => 'required|'.$this->validationPhone,
            'email' => 'required|email|unique:users,email'
        ];
        $fields = $this->processingFields('send_email', 'old_password');
        $fields['password'] = bcrypt($fields['password']);

        if (Gate::denies('is-admin')) unset($fields['is_admin']);

        if ($this->request->has('id')) {
            $validationArr['id'] = $this->validationId.'users';
            $validationArr['email'] .= ','.$this->request->id;
            $validationArr['name'] .= ','.$this->request->id;
            if (Gate::denies('is-admin')) $validationArr['old_password'] = 'required|min:3|max:50';

            if ($this->request->password) {
                $validationArr['password'] = $this->validationPassword;
            } else unset($fields['password']);

            $this->validate($this->request, $validationArr);
            $user = User::find($this->request->id);
            if (Gate::denies('user-edit',$user)) abort(403, $this->youHaveNoRights);

            if (Gate::denies('is-admin') && $this->request->password && !Hash::check($this->request->old_password, $user->password))
                return redirect()->back()->withInput()->withErrors(['old_password' => 'Неверный старый пароль']);

            if (Gate::allows('is-admin') && $fields['is_admin'] != $user->is_admin && $user->send_email) {
                $this->sendMessage($fields['email'], null,'new_user_status', ['status' => $fields['is_admin']]);
            }

            if ($fields['email'] != $user->email && $user->send_email) {
                $this->sendMessage($fields['email'], null, 'new_user_email');
                $this->sendMessage($user->email, null, 'unbind_email');
            }

            $user->update($fields);
        } else {
            if ($this->request->has('password')) {
                $validationArr['password'] = $this->validationPassword;
                $password = $this->request->password;
            } else {
                $password = str_random(8);
            }
            $this->validate($this->request, $validationArr);
            $fields['password'] = bcrypt($password);
            $user = User::create($fields);
            if ($user->send_email) $this->sendMessage($fields['email'], null, 'new_user', ['password' => $password]);
        }

        $this->saveCompleteMessage();
        return redirect('/admin/users');
    }

    public function editTask()
    {
        $adminOrOwnerValidationArr = [
            'name' => $this->validationName,
            'email' => $this->validationEmail,
            'phone' => 'nullable|'.$this->validationPhone,
            'contact_person' => $this->validationContactPerson,
            'value' => $this->validationValue,
            'paid_off' => 'integer|max:2000000',
            'percents' => 'max:100',
            'start_time' => $this->validationDate,
            'completion_time' => $this->validationDate,
            'description' => 'nullable|min:10|max:10000',
            'user_id' => $this->validationId.'users,id',
            'customer_id' => $this->validationCustomerId
        ];

        $ignoreFields = [];
        $validationArr = [];
        $checkBoxFields = ['send_email','save_convention'];

        if (Gate::allows('is-admin')) $adminOrOwnerValidationArr['paid_percents'] = 'in:0,1';
        else $ignoreFields[] = 'paid_percents';
        
        $timeFields = ['start_time','completion_time'];
        if ($this->request->use_payment_time == 'on') {
            $validationArr['payment_time'] = $this->validationDate;
            $timeFields[] = 'payment_time';
        } else $ignoreFields[] = 'payment_time';

        if ($this->request->has('id')) {
            $task = Task::findOrFail($this->request->id);
            $this->checkTaskEdit($task);
            $this->checkTaskEditRights($this->request->status, $task->customer->type, $task);
            list($validationArr, $timeFields) = $this->getTaskValidationSomeFields($this->request->customer_id, $validationArr, $timeFields);

            $customerBaseFields = ['contract'];
            $customerCheckboxFields = ['save_contract'];

            if (Gate::allows('owner-task', $task)) {
                $validationArr = array_merge($validationArr,$adminOrOwnerValidationArr);
                if (Gate::allows('is-admin')) {
                    $validationArr['owner_id'] = $this->validationId.'users,id';
                    $checkBoxFields[] = 'use_duty';
                }
                $taskFields = $this->processingFields($checkBoxFields, array_merge($ignoreFields,$customerBaseFields,$customerCheckboxFields), $timeFields);
                $taskFields = $this->checkTaskFields($taskFields);

                if (!$this->request->use_payment_time && $task->payment_time) $taskFields['payment_time'] = null;

            } else {
                $taskFields['status'] = $this->request->status;
            }

            $this->validate($this->request, $validationArr);
            if ($this->checkStartCompletionTime($taskFields)) return $this->wrongCompletionTime();

            // Task messages
            if ($taskFields['status'] != $task->status || $taskFields['completion_time'] != $task->completion_time || (isset($taskFields['payment_time']) && $taskFields['payment_time'] != $task->payment_time)) {

                $mailFields = $this->getBaseFieldsMailMessage($task);

                if ($taskFields['status'] != $task->status) {

                    $taskFields = $this->checkTaskStatus($taskFields);

                    $mailFields['status'] = $this->getSimpleTaskStatus($taskFields['status']);
                    $messageText = $this->changedTaskStatus;
                    $messageStatus = 4;
                    $mailView = 'new_task_status';

                    $this->changeTaskStatus($task,$taskFields['status']);

                } elseif ($taskFields['completion_time'] != $task->completion_time) {
                    $mailFields['time'] = date('d.m.Y',$taskFields['completion_time']);
                    $messageText = $this->changedTaskCompletionTime;
                    $mailFields['time_type'] = 'выполнения';
                    $messageStatus = 5;
                    $mailView = 'new_task_time';
                } else {
                    $mailFields['time'] = date('d.m.Y',$taskFields['payment_time']);
                    $messageText = $this->changedTaskPaymentTime;
                    $mailFields['time_type'] = 'оплаты';
                    $messageStatus = 6;
                    $mailView = 'new_task_time';
                }

                $this->createTaskMessage($task,$mailView,$mailFields,$messageText,$messageStatus,$taskFields['send_email']);
            }

            // Checking paid off zeroing check
            if ($task->paid_off && !$taskFields['paid_off']) {
                foreach ($task->bills as $k => $bill) {
                    if (!$k && $bill->status == 2) {
                        $bill->status = 1;
                        $bill->save();
                    } elseif ($k) $bill->delete();
                }
            }

            $task->update($taskFields);

            // Saving foreign documents
            $customerFields = $this->processingFields($customerCheckboxFields, array_merge($ignoreFields,array_keys($taskFields)));
            if (!$customerFields['save_contract']) $customerFields['contract'] = null;
            $task->customer->update($customerFields);

            // Checking subtasks time
            if (count($task->subTasks)) {
                foreach ($task->subTasks as $subTasks) {
                    if ($subTasks->completion_time > $task->completion_time) {
                        $subTasks->completion_time = $task->completion_time;
                        $subTasks->save();
                    }
                }
            }

            if ($task->status == 1 && count($task->bills)) {
                foreach ($task->bills as $bill) {
                    if ($bill->status != 1) $bill->update(['status' => 1]);
                }
            }
        } else {
            $validationArr = array_merge($validationArr,$adminOrOwnerValidationArr);
            list($validationArr, $timeFields) = $this->getTaskValidationSomeFields($this->request->customer_id, $validationArr, $timeFields);

            $this->validate($this->request, $validationArr);

            if (Gate::allows('is-admin')) $checkBoxFields[] = 'use_duty';
            $taskFields = $this->processingFields($checkBoxFields, $ignoreFields, $timeFields);
            if (!isset($taskFields['owner_id']) && $taskFields['status'] < 6) $taskFields['owner_id'] = Auth::id();
            $taskFields = $this->checkTaskFields($taskFields);
            $taskFields['tax_type'] = (int)Settings::getSettings()['my_status'];
            $customer = Customer::find($this->request->customer_id);

            if ($this->checkCustomerType($customer->type)) abort(403, $this->youHaveNoRights);
            $task = Task::create($taskFields);
            $this->updateStatistics($taskFields['status'], $task);

            // Task messages
            $this->sendNewTaskMessage($task->send_email,$task,$this->getNewTaskFieldsMailMessage($task,null,$taskFields));

            Message::create([
                'message' => 'Создана новая задача',
                'owner_id' => $task->owner->id,
                'user_id' => $task->user->id,
                'task_id' => $task->id,
                'status' => 3,
                'active_to_owner' => 1,
                'active_to_user' => 1
            ]);
        }
        
        // Final redirect
        $this->saveCompleteMessage();
        return redirect(Session::has('back_uri') ? Session::get('back_uri') : '/admin/tasks');
    }

    private function checkTaskFields($fields)
    {
        if (!$fields['use_duty']) {
            $fields['convention_number'] = null;
            $fields['convention_date'] = null;
        }

        return $fields;
    }

    public function editSubTask()
    {
        $validationArr = [
            'name' => $this->validationName,
            'value' => $this->validationValue,
            'percents' => 'max:100',
            'start_time' => $this->validationDate,
            'completion_time' => $this->validationDate,
            'description' => 'nullable|min:10|max:2000',
        ];

        if (Gate::allows('is-admin')) $validationArr['paid_percents'] = 'in:0,1';
        $fields = $this->processingFields('send_email', Gate::denies('is-admin') ? 'paid_percents' : null, ['start_time','completion_time']);

        if ($this->request->has('id')) {
            $validationArr['id'] = $this->validationId.'sub_tasks';
            $validationArr['status'] = 'required|integer|min:1|max:5';
            $this->validate($this->request, $validationArr);

            $subTask = SubTask::find($this->request->id);
            if ($this->checkSubTaskTime($subTask->completion_time, $subTask->task)) return $this->wrongCompletionTime();
            if ($this->checkSubTaskTime($fields['completion_time'], $subTask->task) || $this->checkStartCompletionTime($fields)) return $this->wrongCompletionTime();
            $this->checkTaskEditRights($this->request->status, $subTask->task->customer->type, $subTask->task);
            $this->checkTaskEdit($subTask->task);

            // Task messages
            if ($fields['status'] != $subTask->status || $fields['completion_time'] != $subTask->completion_time) {

                $mailFields = $this->getBaseFieldsMailMessage($subTask);

                if ($fields['status'] != $subTask->status) {

                    $fields = $this->checkTaskStatus($fields);

                    $mailFields['status'] = $this->getSimpleTaskStatus($fields['status']);
                    $messageText = $this->changedSubTaskStatus;
                    $messageStatus = 7;
                    $mailView = 'new_task_status';
                } else {

                    if ($fields['completion_time'] < time()) return $this->wrongCompletionTime();

                    $mailFields['time'] = date('d.m.Y',$fields['completion_time']);
                    $messageText = $this->changedSubTaskCompletionTime;
                    $mailFields['time_type'] = 'выполнения';
                    $messageStatus = 8;
                    $mailView = 'new_task_time';
                }

                $this->createTaskMessage($subTask,$mailView,$mailFields,$messageText,$messageStatus,$fields['send_email']);
            }

            $subTask->update($fields);
            $this->saveCompleteMessage();
        } else {
            $validationArr['parent_id'] = $this->validationId.'tasks,id';
            $validationArr['status'] = 'required|integer|min:3|max:5';
            $this->validate($this->request, $validationArr);

            $task = Task::find($this->request->parent_id);

            if ($this->checkSubTaskTime($fields['completion_time'], $task) || $this->checkStartCompletionTime($fields)) return $this->wrongCompletionTime();
            $this->checkTaskEditRights($this->request->status, $task->customer->type, $task);
            $fields['task_id'] = $fields['parent_id'];
            $subTask = SubTask::create($fields);
            $this->sendNewTaskMessage($task->send_email,$task,$this->getNewTaskFieldsMailMessage($task,$subTask,$fields));
            Message::create([
                'message' => 'Создана новая подзадача',
                'owner_id' => $task->owner->id,
                'user_id' => $task->user->id,
                'task_id' => $task->id,
                'sub_task_id' => $subTask->id,
                'status' => 9,
                'active_to_owner' => 1,
                'active_to_user' => 1
            ]);
            $this->saveCompleteMessage();
        }
        return redirect('/admin/tasks?id='.$subTask->task->id);
    }

    public function editCustomer()
    {
        $validateArr = [
            'type' => 'required||min:1|max:5',
            'ltd' => 'min:0|max:3',
            'name' => 'required|max:255|unique:customers,name',
            'phone' => 'nullable|'.$this->validationPhone,
            'email' => 'nullable|email',
            'contact_person' => $this->validationContactPerson,
            'description' => 'max:2000',
            'director' => 'max:255',
            'director_case' => 'max:255',
            'address' => 'max:255',
            'okved' => 'max:255',
            'bank_id' => $this->validationId.'banks,id',
            'contract_number' => 'max:45',
            'contract_date' => $this->validationDate,
        ];

        if (Gate::allows('is-admin')) $validateArr['type'] = 'required|min:1|max:5';

        $variableFields = [
            'ogrn' => 'min:11|max:15',
            'okpo' => 'min:8|max:10',
            'oktmo' => 'size:8',
            'inn' => 'max:12',
            'kpp' => 'size:9',
            'payment_account' => 'size:20',
            'correspondent_account' => 'size:20',
        ];

        foreach ($variableFields as $field => $value) {
            if ($this->request->has($field) && $this->request->input($field)) {
                $validateArr[$field] = $value;
            }
        }

        $fields = $this->processingFields('save_contract', (Gate::allows('is-admin') ? null : 'type'), 'contract_date');
        if (!$fields['save_contract']) $fields['contract'] = null;

        if ($this->request->has('id')) {
            $validateArr['id'] = $this->validationId.'customers';
            $validateArr['name'] .= ','.$this->request->id;

            $this->validate($this->request, $validateArr);
            $this->getBackUri($this->request->path());

            $customer = Customer::findOrFail($this->request->id);
            if (Gate::allows('customer-edit',$customer)) $customer->update($fields);
            else abort(403, $this->youHaveNoRights);
        } else {
            $this->validate($this->request, $validateArr);
            if (Gate::denies('is-admin')) $fields['type'] = 2;
            Customer::create($fields);
        }
        $this->saveCompleteMessage();
        return redirect('/admin/customers');
    }

    public function editBank()
    {
        $validateArr = [
            'name' => 'required|max:255|unique:banks,name',
            'bank_id' => 'required|size:9|unique:banks,bank_id'
        ];
        $fields = $this->processingFields();

        if ($this->request->has('id')) {
            $validateArr['id'] = $this->validationId.'banks';
            $validateArr['name'] .= ','.$this->request->id;
            $validateArr['bank_id'] .= ','.$this->request->id;

            $this->validate($this->request, $validateArr);
            Bank::where('id',$this->request->id)->update($fields);
        } else {
            $this->validate($this->request, $validateArr);
            Bank::create($fields);
        }
        $this->saveCompleteMessage();
        return redirect('/admin/banks');
    }

    public function editBill()
    {
        $validateArr = [
            'number' => $this->validationBillNumber,
            'signing' => 'required|integer|min:1|max:3',
            'date' => $this->validationDate,
        ];

        $customerBaseFields = ['contract'];
        $customerCheckboxFields = ['save_contract'];

        $taskBaseFields = ['convention'];
        $taskCheckboxFields = ['save_convention'];

        $billBaseFields = ['number','signing','status','date'];
        $billCheckboxFields = ['send_email','save_act','save_bill'];
        $billDateFields = ['date'];

        $ignoreFields = ['value'];

        $billFields = $this->processingFields($billCheckboxFields, array_merge($ignoreFields,$customerBaseFields,$customerCheckboxFields,$taskBaseFields,$taskCheckboxFields), $billDateFields);

        if (!$billFields['save_act']) $customerFields['act'] = null;
        if (!$billFields['save_bill']) $customerFields['bill'] = null;

        if ($this->request->has('id')) {
            $customerFields = $this->processingFields($customerCheckboxFields, array_merge($ignoreFields,$billBaseFields,$billCheckboxFields,$billDateFields,$taskBaseFields,$taskCheckboxFields));
            $taskFields = $this->processingFields($taskCheckboxFields, array_merge($ignoreFields,$billBaseFields,$billCheckboxFields,$billDateFields,$customerBaseFields,$customerCheckboxFields));

            $bill = Bill::findOrFail($this->request->id);
            if (Gate::denies('check-rights',[$bill, 'user_id']) || Gate::denies('check-rights',[$bill, 'owner_id'])) abort(403,$this->youHaveNoRights);

            $validateArr['number'] .= ','.$this->request->id;
            $validateArr['status'] = 'required|in:1,'.($bill->task->paid_off && $bill->task->bills[0]->id == $bill->id && $bill->task->paid_off != $bill->task->value ? '3' : '2');
            $this->validate($this->request, $validateArr);

            if (
                $billFields['status'] == 1
                && $bill->task->status > 1
                && $bill->task->status < 7
                && Helper::isFinalBill($bill)
            ) {
                $mailFields = $this->getBaseFieldsMailMessage($bill->task);
                $mailFields['status'] = $this->getSimpleTaskStatus(1);

                $this->changeTaskStatus($bill->task,1);
                $this->createTaskMessage($bill->task,'new_task_status',$mailFields,$this->changedTaskStatus,4,$billFields['send_email']);

                $bill->task->status = $bill->task->status == 6 ? 7 : 1;
                $bill->task->save();
            }

            $this->changeBillsBrothersStatus($billFields['signing'], $bill->task, $bill->id);
            $bill->update($billFields);

            // Saving foreign documents
            if (!$customerFields['save_contract']) $customerFields['contract'] = null;
            $bill->task->customer->update($customerFields);

            if (!$taskFields['save_convention']) $customerFields['convention'] = null;
            $bill->task->update($customerFields);
        } else {
            $validateArr['task_id'] = $this->validationTaskId;
            $this->validate($this->request, $validateArr);
            $task = Task::find($this->request->task_id);
            if (
                Gate::denies('check-rights',[$task, 'owner_id'])
                || ($task->status != 2 && $task->status != 3 && $task->status != 6)
                || (($task->status == 2 || $task->status == 6) && count($task->bills) > 1)
                || ($task->status == 3 && !$task->paid_off)
                || ($task->status == 3 && $task->paid_off && count($task->bills))
            ) abort(403,$this->youHaveNoRights);
            $billFields['status'] = $task->paid_off && !count($task->bills) && $task->paid_off != $task->value ? 3 : 2;
            $billFields['user_id'] = Auth::id();

            $this->changeBillsBrothersStatus($billFields['signing'], $task);
            Bill::create($billFields);
        }

        $this->saveCompleteMessage();
        return redirect('/admin/bills');
    }

    public function getBillsValue()
    {
        $this->validate($this->request, ['id' => $this->validationTaskId]);
        if (!$task = $this->getTaskForBill($this->request->id)) return response()->json(['success' => false]);
        else return response()->json(['success' => true, 'value' => Helper::calculateTaskValForBill($task)]);
    }
    
    public function getConventionNumber()
    {
        $this->validate($this->request, ['id' => $this->validationTaskId]);
        if (!$task = $this->getTaskForBill($this->request->id)) return response()->json(['success' => false]);
        else return response()->json(['success' => true, 'number' => $this->getLastConventionNumber($task->customer)]);
    }

    public function deleteBank()
    {
        Customer::where('bank_id',$this->request->id)->update(['bank_id' => null]);
        return $this->deleteSomething(new Bank());
    }

    public function deleteBill()
    {
        return $this->deleteSomething(new Bill(), null, 'user_id');
    }

    private function updateStatistics($status, $task)
    {
        $update = true;
        if (count($task->statistics)) {
            foreach ($task->statistics as $statistic) {
                if ($statistic->status == $status && date('Y') == $statistic->created_at->format('Y') && date('m') == $statistic->created_at->format('m')) {
                    $update = false;
                    break;
                }
            }
        }
        if ($update) {
            Statistic::create([
                'status' => $status,
                'task_id' => $task->id
            ]);
        }
    }

    private function changeUserTask($tasks, $field)
    {
        foreach ($tasks as $task) {
            $task[$field] = 1;
            $task->save();
        }
    }

    public function deleteMessage()
    {
        $message = Message::findOrFail($this->request->id);
        if (Gate::allows('owner-or-user-message', $message)) {
            if (Gate::allows('is-admin')) {
                $message->active_to_owner = 2;
                $message->active_to_user = 2;
            } elseif (Gate::allows('owner-message-not-admin', $message)) {
                $message->active_to_owner = 2;
            } else {
                $message->active_to_user = 2;
            }
            $message->save();
            return response()->json(['success' => true]);
        } else return response()->json(['success' => false]);
    }

    public function deleteTask()
    {
        $task = Task::findOrFail($this->request->id);
        if (Gate::allows('owner-task', $task)) {
            $task->delete();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    public function deleteSubTask()
    {
        $subTask = SubTask::findOrFail($this->request->id);
        if (!Helper::forbbidenTaskEdit($subTask->task)) {
            $subTask->delete();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }
    
    public function seenAll()
    {
        $messagesList = [];
        $messages = $this->getMessages();
        foreach ($messages as $message) {
            $this->setSeenMessage($message);
            $messagesList[] = $message->id;
        }
        return response()->json(['success' => true, 'messages' => $messagesList]);
    }
    
    public function getNewMessages()
    {
        $messages = $this->getMessages();
        if (count($messages)) {
            return response()->json(['success' => true, 'counter' => count($messages), 'messages' => view('layouts._messages_block',['messages' => $messages])->render()]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    protected function getMessages($addCondition=null)
    {
        $result = [];
        $messages = Message::where('active_to_owner',1)->orWhere('active_to_user',1)->get();
        foreach ($messages as $message) {
            if (
                ($message->owner && Gate::allows('owner-message-not-admin', $message) && $message->active_to_owner) ||
                ($message->user && Gate::allows('user-message-not-admin', $message) && $message->active_to_user) ||
                $addCondition
            ) {
                $result[] = $message;
            }
        }
        return $result;
    }

    private function setSeenMessage($message)
    {
        $userType = Gate::allows('owner-message-not-admin', $message) ? 'owner' : 'user';
        if (Gate::allows('owner-message-not-admin', $message)) {
            $message->active_to_owner = 0;
            $message->active_to_user = 0;
        } else $message['active_to_'.$userType] = 0;
        $message->save();
    }

    private function checkTaskEditRights($status, $customerType, Task $task)
    {
        if (($this->checkCustomerType($customerType) && $status > 2) || Helper::forbbidenTaskEdit($task)) abort(403, $this->youHaveNoRights);
    }

    private function checkCustomerType($customerType)
    {
        return $customerType == 5;
    }

    private function checkSubTaskTime($completionTime, $task)
    {
        return $completionTime > $task->completion_time;
    }

    private function checkStartCompletionTime($fields)
    {
        return $fields['start_time'] > $fields['completion_time'];
    }

    private function getTaskYears($times)
    {
        if (!isset($this->data['years'])) $this->data['years'] = [];
        foreach ($times as $time) {
            $year = date('Y',$time);
            if ( !in_array($year,$this->data['years']) ) $this->data['years'][] = $year;
        }
        if (
            count($this->data['years']) &&
            (int)$this->data['years'][count($this->data['years'])-1] != (int)date('Y')
        ) $this->data['years'][] = (int)date('Y');
    }

    private function getDataForBill($id=null)
    {
        $this->data['tasks'] = [];
        $customers = Customer::where('ltd','<',2)->orWhere('ltd',3)->orderBy('slug')->get();
        foreach ($customers as $customer) {
            $tasks = [];
            foreach ($customer->tasks as $task) {
                if (
                    $task->use_duty
                    && (
                        ( ($task->status == 2 || $task->status == 6) && !count($task->bills) )
                        || ( ($task->status == 2 || $task->status == 6) && $task->paid_off && count($task->bills) == 1)
                        || ($task->status == 3 && $task->paid_off && !count($task->bills))
                        || ($id && $task->id == $id)
                    )
                    && (Gate::allows('owner-task', $task))
                )
                {
                    $tasks[$task->id] = $task->name;
                }
            }
            if (count($tasks)) $this->data['tasks'][$customer->name] = $tasks;
        }
        $this->getFixTax();
    }

    private function getTaskForBill($id)
    {
        $task = Task::find($id);
        return ($task->status != 2 && $task->status != 6) ? false : $task;
    }

    private function getLastConventionNumber($customer)
    {
        $taskCounter = count($customer->tasks);
        $lastNumber = $customer->tasks[$taskCounter-1]->convention_number;
        if ($taskCounter > 1) return $lastNumber ? $lastNumber + 1 : $taskCounter + 1;
        else return 1;
    }

    private function getLastBillNumber()
    {
        $this->data['last_number'] = Bill::orderBy('number','desc')->pluck('number')->first();
    }

    private function getCustomConvention($task)
    {
        $this->data['convention'] = $task->convention ? $task->convention : view('docs.convention',['item' => $task,'noPrint' => true])->render();
    }
}
