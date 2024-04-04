@extends('layouts.admin')

@section('content')
    @include('admin.blocks._modal_delete_block',['modalId' => 'delete-modal', 'function' => 'delete-sub-task', 'head' => 'Вы действительно хотите удалить эту подзадачу?'])
    @include('admin.blocks._modal_delete_block',['modalId' => 'delete-image-modal', 'function' => 'delete-task-image', 'head' => 'Вы действительно хотите удалить этот файл?'])

    <div class="panel panel-flat">
        <div class="panel-heading">
            <h4 class="panel-title">{{ isset($data['task']) ? 'Редактирование задачи '.$data['task']->customer->name.' - «'.$data['task']->name.'»' : 'Добавление задачи' }}</h4>
            @include('admin.blocks._heading_elements_block')
        </div>
        <div class="panel-body">
            <form class="form-horizontal task-form" enctype="multipart/form-data" action="{{ url('/admin/task') }}" method="post">
                {{ csrf_field() }}
                @if (isset($data['task']))
                    <input type="hidden" name="id" value="{{ $data['task']->id }}">
                @endif

                <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h5 class="panel-title">Заказчик</h5>
                        </div>
                        <div class="panel-body">
                            @if (
                                    !isset($data['task']) ||
                                    ( isset($data['task']) && !Helper::forbbidenTaskEdit($data['task']) )
                                )
                                @include('admin.blocks._select_block', [
                                    'name' => 'customer_id',
                                    'values' => $data['customers'],
                                    'selected' => isset($data['task']) ? $data['task']->customer->id : (isset($data['customer']) ? $data['customer']->id : 0)
                                ])
                            @else
                                <p>
                                    Название: <b>{{ $data['task']->customer->name }}</b><br>
                                    E-mail: <b>@include('admin.blocks._email_href_block',['email' => $data['task']->customer->email])</b><br>
                                    Телефон: <b>@include('admin.blocks._phone_href_block',['phone' => $data['task']->customer->phone])</b><br>
                                    Контактное лицо: <b>{{ $data['task']->customer->contact_person }}</b><br>

                                    @if (Gate::allows('is-admin'))
                                        Тип: @include('admin.blocks._customers_type_block',['type' => $data['task']->customer->type])
                                    @endif
                                </p>
                                <h6>Описание:</h6>
                                @if ($data['task']->customer->description)
                                    {!! $data['task']->customer->description !!}
                                @else
                                    <p>Нет описания</p>
                                @endif
                            @endif
                        </div>
                    </div>

                    <div class="hiding1 panel panel-flat {{ Helper::isFakeTask($data) ? 'hidden' : '' }}">
                        <div class="panel-heading">
                            <h5 class="panel-title">Ответственный за исполнение</h5>
                        </div>
                        <div class="panel-body">
                            @if (
                                    !isset($data['task']) ||
                                    ( isset($data['task']) && !Helper::forbbidenTaskEdit($data['task']) )
                                )
                                @include('admin.blocks._select_block', [
                                    'label' => 'Ответственный за исполнение',
                                    'name' => 'owner_id',
                                    'values' => $data['users'],
                                    'selected' => isset($data['task']) ? $data['task']->owner->id : 1
                                ])
                            @elseif (isset($data['task']))
                                @include('admin.blocks._user_credentials_block',['user' => $data['task']->owner])
                            @endif
                        </div>
                        <div class="panel-heading">
                            <h5 class="panel-title">Исполнитель</h5>
                        </div>
                        <div class="panel-body">
                            @if (
                                    !isset($data['task']) ||
                                    ( isset($data['task']) && !Helper::forbbidenTaskEdit($data['task']) )
                                )
                                @include('admin.blocks._select_block', [
                                    'label' => 'Исполнитель',
                                    'name' => 'user_id',
                                    'values' => $data['users'],
                                    'selected' => isset($data['task']) ? $data['task']->user->id : 1
                                ])
                            @elseif (isset($data['task']))
                                @include('admin.blocks._user_credentials_block',['user' => $data['task']->user])
                            @endif
                        </div>
                    </div>

                    @if (
                            !isset($data['task']) ||
                            ( isset($data['task']) && !Helper::forbbidenTaskEdit($data['task']) )
                        )
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h5 class="panel-title">Статус</h5>
                            </div>
                            <div class="panel-body">
                                @include('admin.blocks._radio_button_block', [
                                    'addClass' => 'task-status',
                                    'name' => 'status',
                                    'values' => $data['statuses'],
                                    'activeValue' => isset($data['task']) ? $data['task']->status : 3,
                                ])
                                @include('admin.blocks._checkbox_block', [
                                    'addClass' => 'hiding1 '.(Helper::isFakeTask($data) ? 'hidden' : ''),
                                    'label' => 'Учитывать налоги',
                                    'name' => 'use_duty',
                                    'checked' => isset($data['task']) ? $data['task']->use_duty : true
                                ])
                            </div>
                        </div>
                    @else
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h5 class="panel-title">
                                    Статус:
                                    @include('admin.blocks._extended_status_block',[
                                        'status' => $data['task']->status,
                                        'descriptions' => $data['statuses_simple']
                                    ])
                                </h5>
                            </div>
                        </div>
                    @endif

                    @if (Gate::allows('is-admin') && isset($data['task']) && $data['task']->percents)
                        <div class="hiding1 panel panel-flat {{ Helper::isFakeTask($data) ? 'hidden' : '' }}">
                            <div class="panel-heading">
                                <h5 class="panel-title">Проценты выплачены</h5>
                            </div>
                            <div class="panel-body">
                                @if (!Helper::forbbidenTaskEdit($data['task']))
                                    @include('admin.blocks._radio_button_block', [
                                        'name' => 'paid_percents',
                                        'values' => [
                                            ['val' => 0, 'descript' => 'Нет'],
                                            ['val' => 1, 'descript' => 'Да']
                                        ],
                                        'activeValue' => $data['task']->paid_percents
                                    ])
                                @else
                                    @include('admin.blocks._status_block',[
                                        'status' => $data['task']->paid_percents,
                                        'trueLabel' => 'Да',
                                        'falseLabel' => 'Нет'
                                    ])
                                @endif
                            </div>
                        </div>
                    @endif

                    @if (isset($data['task']))
                        <div class="panel panel-flat hiding {{ Helper::isPrivatePersonTheCustomerOfTask($data) ? 'hidden' : '' }}">
                            <div class="panel-heading">
                                <h5 class="panel-title">Документы</h5>
                            </div>
                            <div class="panel-body">
                                @include('admin.blocks._docs_buttons_contract_block',['task' => $data['task']])
                                @include('admin.blocks._docs_buttons_convention_block',['task' => $data['task']])
                            </div>
                        </div>
                    @endif
                </div>

                <div class="col-md-8 col-sm-6 col-xs-12">
                    <div class="panel panel-flat">
                        <div class="panel-body">
                            @if (
                                !isset($data['task']) ||
                                ( isset($data['task']) && !Helper::forbbidenTaskEdit($data['task']) )
                            )
                                <div class="panel panel-flat">
                                    <div class="panel-body">
                                        @include('admin.blocks._input_block', [
                                            'addClass' => 'col-md-12 col-sm-12 col-xs-12 name',
                                            'label' => 'Название задачи',
                                            'name' => 'name',
                                            'type' => 'text',
                                            'max' => 255,
                                            'placeholder' => 'Название задачи',
                                            'value' => isset($data['task']) ? $data['task']->name : ''
                                        ])
                                        @include('admin.blocks._input_block', [
                                            'addClass' => 'col-3-to-4 col-md-'.(Helper::isPrivatePersonTheCustomerOfTask($data) || !Helper::isUsedDuty($data) ? '4' : '3').' col-sm-12 col-xs-12',
                                            'label' => 'Цена (₽)',
                                            'name' => 'value',
                                            'type' => 'number',
                                            'min' => 0,
                                            'max' => 2000000,
                                            'placeholder' => 'Цена вопроса (₽)',
                                            'value' => isset($data['task']) ? $data['task']->value : 100
                                        ])
                                        @include('admin.blocks._input_block', [
                                            'addClass' => 'hiding col-3-to-4 col-md-3 col-sm-12 col-xs-12'.(Helper::isPrivatePersonTheCustomerOfTask($data) || !Helper::isUsedDuty($data) ? ' hidden' : ''),
                                            'label' => '№ доп.согл.',
                                            'name' => 'convention_number',
                                            'type' => 'number',
                                            'min' => 0,
                                            'placeholder' => 'Номер доп.соглашения',
                                            'value' => isset($data['task']) ? ($data['task']->convention_number === null ? $data['convention_number'] : $data['task']->convention_number) : $data['convention_number']
                                        ])
                                        @include('admin.blocks._input_block', [
                                            'addClass' => 'hiding1 col-3-to-4 col-md-'.(Helper::isPrivatePersonTheCustomerOfTask($data) || !Helper::isUsedDuty($data) ? '4' : '3').' col-sm-12 col-xs-12 paid-off',
                                            'label' => 'Предоплата (₽)',
                                            'name' => 'paid_off',
                                            'type' => 'number',
                                            'min' => 0,
                                            'max' => 2000000,
                                            'placeholder' => 'Предоплата (₽)',
                                            'value' => isset($data['task']) ? $data['task']->paid_off : 0
                                        ])
                                        @include('admin.blocks._input_block', [
                                            'addClass' => 'hiding1 col-3-to-4 col-md-'.(Helper::isPrivatePersonTheCustomerOfTask($data) || !Helper::isUsedDuty($data) ? '4' : '3').' col-sm-12 col-xs-12'.(Helper::isFakeTask($data) ? ' hidden' : ''),
                                            'label' => 'Сторонний %',
                                            'name' => 'percents',
                                            'type' => 'number',
                                            'step' => 0.001,
                                            'min' => 0,
                                            'max' => 100,
                                            'placeholder' => 'Сторонний процент (%)',
                                            'value' => isset($data['task']) && $data['task']->percents ? $data['task']->percents : 0
                                        ])
{{--                                        @if (Gate::allows('is-big-boss') && isset($data['task']) && $data['task']->customer->ltd != 2)--}}
{{--                                            @include('admin.blocks._input_block', [--}}
{{--                                                'addClass' => 'showing1 col-3-to-4 col-md-'.(Helper::isPrivatePersonTheCustomerOfTask($data) ? '4' : '3').' col-sm-12 col-xs-12'.(!Helper::isFakeTask($data) ? ' hidden' : ''),--}}
{{--                                                'label' => 'Мой %',--}}
{{--                                                'name' => 'my_percent',--}}
{{--                                                'type' => 'number',--}}
{{--                                                'min' => 1,--}}
{{--                                                'max' => (int)Settings::getSettings()['my_percent'],--}}
{{--                                                'placeholder' => 'Мой процент (%)',--}}
{{--                                                'value' => isset($data['task']) && $data['task']->my_percent ? $data['task']->my_percent : (int)Settings::getSettings()['my_percent']--}}
{{--                                            ])--}}
{{--                                        @endif--}}
                                        @include('admin.blocks._date_block', [
                                            'addClass' => 'col-3-to-4 col-md-'.(Helper::isPrivatePersonTheCustomerOfTask($data) || !Helper::isUsedDuty($data) ? '4' : '3').' col-sm-12 col-xs-12',
                                            'label' => 'Начало работы',
                                            'name' => 'start_time',
                                            'value' => isset($data['task']) ? $data['task']->start_time : time()
                                        ])
                                        @include('admin.blocks._date_block', [
                                            'addClass' => 'hiding1 col-3-to-4 col-md-'.(Helper::isPrivatePersonTheCustomerOfTask($data) || !Helper::isUsedDuty($data) ? '4' : '3').' col-sm-12 col-xs-12',
                                            'label' => 'Дата завершения',
                                            'name' => 'completion_time',
                                            'value' => isset($data['task']) ? $data['task']->completion_time : time()
                                        ])
                                        @include('admin.blocks._date_block', [
                                            'addClass' => 'hiding col-3-to-4 col-md-3 col-sm-12 col-xs-12'.(Helper::isPrivatePersonTheCustomerOfTask($data) || !Helper::isUsedDuty($data) ? ' hidden' : ''),
                                            'label' => 'Дата доп.согл.',
                                            'name' => 'convention_date',
                                            'value' => isset($data['bill']) ? $data['bill']->task->convention_date : time()
                                        ])
                                        @include('admin.blocks._date_block', [
                                            'addClass' => 'col-3-to-4 col-md-'.(Helper::isPrivatePersonTheCustomerOfTask($data) || !Helper::isUsedDuty($data) ? '4' : '3').' col-sm-12 col-xs-12',
                                            'label' => 'Дата оплаты',
                                            'name' => 'payment_time',
                                            'value' => isset($data['task']) && $data['task']->payment_time ? $data['task']->payment_time : time()+(60*60*24)
                                        ])
                                        @include('admin.blocks._checkbox_block', [
                                            'addClass' => 'col-3-to-4 col-md-'.(Helper::isPrivatePersonTheCustomerOfTask($data) || !Helper::isUsedDuty($data) ? '4' : '3').' col-sm-12 col-xs-12 pull-right',
                                            'label' => 'Знаю дату оплаты',
                                            'name' => 'use_payment_time',
                                            'checked' => isset($data['task']) && $data['task']->payment_time
                                        ])
                                    </div>
                                </div>

                                <div class="panel panel-flat hidden-xs">
                                    <div class="panel-heading">
                                        <h4 class="text-grey-300">Эти поля НЕ обязательны к заполнению</h4>
                                    </div>
                                    <div class="panel-body">
                                        @include('admin.blocks._input_block', [
                                            'addClass' => 'col-md-4 col-sm-12 col-xs-12',
                                            'label' => 'Контактный E-mail',
                                            'name' => 'email',
                                            'type' => 'email',
                                            'max' => 100,
                                            'placeholder' => 'E-mail пользователя',
                                            'value' => isset($data['task']) ? $data['task']->email : ''
                                        ])

                                        @include('admin.blocks._input_block', [
                                            'addClass' => 'col-md-4 col-sm-12 col-xs-12',
                                            'label' => 'Контактный тел.',
                                            'name' => 'phone',
                                            'type' => 'tel',
                                            'placeholder' => '+7(___)__-__-__',
                                            'value' => isset($data['task']) ? $data['task']->phone : ''
                                        ])

                                        @include('admin.blocks._input_block', [
                                            'addClass' => 'col-md-4 col-sm-12 col-xs-12',
                                            'label' => 'Контактное лицо',
                                            'name' => 'contact_person',
                                            'type' => 'text',
                                            'max' => 255,
                                            'placeholder' => 'Контактное лицо',
                                            'value' => isset($data['task']) ? $data['task']->contact_person : ''
                                        ])

                                        @include('admin.blocks._textarea_block', [
                                            'label' => 'Описание задачи',
                                            'name' => 'description',
                                            'value' => isset($data['task']) ? $data['task']->description : '',
                                            'max' => 2000,
                                            'simple' => false
                                        ])
                                    </div>
                                    @include('admin.blocks._checkbox_send_mail_block',['checked' => (isset($data['task']) ? $data['task']->send_email : true)])
                                </div>

                                @if (isset($data['task']))
                                    <p>
                                        Задача создана: <b>{{ $data['task']->created_at }}</b><br>
                                        Последняя редакция: <b>{{ $data['task']->updated_at }}</b>
                                    </p>
                                @endif

                            @else
                                <h4>Название задачи: <b>{{ $data['task']->name }}</b></h4>
                                <hr>
                                <h6>
                                    E-mail контактного лица:
                                    <b>
                                        @if ($data['task']->email)
                                            @include('admin.blocks._email_href_block',['email' => $data['task']->email])
                                        @else
                                            нет
                                        @endif
                                    </b><br>
                                    Телефон контактного лица:
                                    <b>
                                        @if ($data['task']->phone)
                                            @include('admin.blocks._phone_href_block',['phone' => $data['task']->phone])
                                        @else
                                            нет
                                        @endif
                                    </b><br>
                                    Контактное лицо:
                                    <b>
                                        @if ($data['task']->contact_person)
                                            {{ $data['task']->contact_person }}
                                        @else
                                            нет
                                        @endif
                                    </b><br>
                                </h6>
                                <hr>
                                <h6>
                                    Цена: <b>{{ $data['task']->value }}₽</b><br>
                                    Предоплата: <b>{{ $data['task']->paid_off }}₽</b><br>
                                    Сторонний %: <b>{{ $data['task']->percents }}%</b><br>
                                </h6>
                                <hr>
                                <h6>
                                    Начало работы: <b>{{ date('d.m.Y',$data['task']->start_time) }}</b><br>
                                    @if ($data['task']->status == 3 || $data['task']->status == 5)
                                        Предполагаемое время завершения: <b>{{ date('d.m.Y',$data['task']->completion_time) }}</b><br>
                                    @else
                                        Предполагаемое время оплаты: <b>{{ $data['task']->payment_time ? date('d.m.Y',$data['task']->payment_time) : 'неизвестно' }}</b><br>
                                    @endif
                                </h6>
                                <hr>
                                <h6>Описание</h6>
                                @if ($data['task']->description)
                                    {!! $data['task']->description !!}
                                @else
                                    <p>Нет описания</p>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>

                @if (
                        !isset($data['task']) ||
                        ( isset($data['task']) && !Helper::forbbidenTaskEdit($data['task']) )
                    )
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="panel-body">
                            @include('admin.blocks._button_block', ['type' => 'submit', 'icon' => ' icon-floppy-disk', 'text' => trans('admin_content.save'), 'addClass' => 'pull-right'])
                        </div>
                    </div>
                @endif
            </form>
        </div>
    </div>

    @if (isset($data['task']))
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h5 class="panel-title">Подзадачи</h5>
                @include('admin.blocks._heading_elements_block')
            </div>
            <div class="panel-body sub-tasks">
                @if (count($data['task']->subTasks))
                    <table class="table datatable-basic table-items">
                        @php $sum = 0; $percents = 0; @endphp
                        @include('admin.blocks._tasks_table_header_block', ['task' => $data['task']])

                        @foreach ($data['task']->subTasks as $task)
                            @include('admin.blocks._tasks_table_item_block',['task' => $task, 'suffix' => 'sub_task'])
                        @endforeach
                    </table>

                    @php
                        $taskValueWithoutPercents = Helper::calculateSubTasksValue($data['task'],true);
                        $taskValue = Helper::calculateSubTasksValue($data['task']);
                        $taskDuty = $data['task']->use_duty ? Helper::calculateTaskDuty($taskValue, $data['task']) : 0;
                        $taskPercents = $taskValue - $taskValueWithoutPercents;
                    @endphp

                    @include('admin.blocks._sum_tasks_block',[
                        'sum' => $taskValueWithoutPercents,
                        'duty' => $taskDuty,
                        'percents' => $taskPercents
                    ])
                @endif

                @if (!Helper::forbbidenTaskEdit($data['task']))
                    @include('admin.blocks._add_button_block',['href' => 'tasks/sub_task/add?id='.$data['task']->id, 'text' => 'Добавить подзадачу'])
                @endif

                @if (count($data['task']->subTasks))
                    @include('admin.blocks._forming_csv_block')
                @endif
            </div>
        </div>
    @endif

    @if (isset($data['task']) && $data['task']->status <= 2)
        <div class="hiding {{ Helper::isPrivatePersonTheCustomerOfTask($data) ? ' hidden' : '' }} panel panel-flat">
            <div class="panel-heading">
                <h3 class="panel-title pull-left">Счета</h3>
                @if ($data['task']->status == 2 && $data['task']->use_duty)
                    @include('admin.blocks._add_button_block',['href' => 'bills/add?task_id='.$data['task']->id, 'text' => 'Добавить счет'])
                @endif
            </div>
            <div class="panel-body">
                @if (count($data['task']->bills) && Helper::isUsedDuty($data))
                    @include('admin.blocks._modal_delete_block',['modalId' => 'delete-modal', 'function' => 'delete-bill', 'head' => 'Вы действительно хотите удалить этот счет?'])
                    @include('admin.blocks._bills_table_block', ['bills' => $data['task']->bills, 'statuses' => $data['bills_statuses']])
                @else
                    <h1 class="text-center">Счетов не найдено</h1>
                @endif
            </div>
        </div>
    @endif

@endsection