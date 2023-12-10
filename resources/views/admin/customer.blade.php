@extends('layouts.admin')

@section('content')
    @include('admin.blocks._modal_delete_block',['modalId' => 'delete-modal', 'function' => 'delete-task', 'head' => 'Вы действительно хотите удалить эту задачу?'])

    <div class="panel panel-flat">
        <div class="panel-heading">
            <h4 class="panel-title">{{ isset($data['customer']) ? 'Редактирование клиента '.$data['customer']->name : 'Добавление клиента' }}</h4>
            @include('admin.blocks._heading_elements_block')
        </div>
        <div class="panel-body">
            <form class="form-horizontal" enctype="multipart/form-data" action="{{ url('/admin/customer') }}" method="post">
                {{ csrf_field() }}
                @if (isset($data['customer']))
                    <input type="hidden" name="id" value="{{ $data['customer']->id }}">
                @endif

                <div class="col-md-4 col-sm-6 col-xs-12">
                    @if (Auth::user()->is_admin)
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h5 class="panel-title">Статус</h5>
                            </div>
                            <div class="panel-body">
                                @include('admin.blocks._radio_button_block', [
                                    'name' => 'type',
                                    'values' => [
                                        ['val' => 1, 'descript' => 'Премиум'],
                                        ['val' => 2, 'descript' => 'Обычный'],
                                        ['val' => 3, 'descript' => 'Не важный'],
                                        ['val' => 4, 'descript' => 'Проблемный'],
                                        ['val' => 5, 'descript' => 'Под санкциями']
                                    ],
                                    'activeValue' => isset($data['customer']) ? $data['customer']->type : 2
                                ])
                            </div>
                        </div>
                    @endif
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h5 class="panel-title">Тип</h5>
                        </div>
                        <div class="panel-body">
                            @include('admin.blocks._radio_button_block', [
                                'addClass' => 'customer-type',
                                'name' => 'ltd',
                                'values' => [
                                    ['val' => 0, 'descript' => 'ИП'],
                                    ['val' => 1, 'descript' => 'ООО'],
                                    ['val' => 2, 'descript' => 'Ч/Л'],
                                    ['val' => 3, 'descript' => 'ЗАО'],
                                ],
                                'activeValue' => isset($data['customer']) ? $data['customer']->ltd : 2
                            ])
                        </div>
                    </div>

                    @if (isset($data['customer']) && $data['customer']->ltd != 2)
                        <div class="panel panel-flat">
                            <div class="panel-body">
                                @include('admin.blocks._docs_buttons_contract_block',['customer' => $data['customer']])
                            </div>
                        </div>
                    @endif
                </div>

                <div class="col-md-8 col-sm-6 col-xs-12">
                    <div class="panel panel-flat">
                        <div class="panel-body">
                            @include('admin.blocks._input_block', [
                                'addClass' => 'col-md-4 col-sm-12 col-xs-12',
                                'label' => 'Имя',
                                'name' => 'name',
                                'type' => 'text',
                                'max' => 255,
                                'placeholder' => 'Название клиента',
                                'value' => isset($data['customer']) ? $data['customer']->name : ''
                            ])

                            @include('admin.blocks._input_block', [
                                'addClass' => 'col-md-4 col-sm-12 col-xs-12',
                                'label' => 'E-mail',
                                'name' => 'email',
                                'type' => 'email',
                                'max' => 100,
                                'placeholder' => 'E-mail клиента',
                                'value' => isset($data['customer']) ? $data['customer']->email : ''
                            ])

                            @include('admin.blocks._input_block', [
                                'addClass' => 'col-md-4 col-sm-12 col-xs-12',
                                'label' => 'Телефон',
                                'name' => 'phone',
                                'type' => 'tel',
                                'placeholder' => '+7(___)__-__-__',
                                'value' => isset($data['customer']) ? $data['customer']->phone : ''
                            ])

                            @include('admin.blocks._input_block', [
                                'addClass' => 'col-4-to-12 col-md-'.(Helper::isPrivatePersonTheCustomer($data) ? ' 12' : '4').' col-sm-12 col-xs-12',
                                'label' => 'Контактное лицо',
                                'name' => 'contact_person',
                                'type' => 'text',
                                'max' => 255,
                                'placeholder' => 'Контактное лицо',
                                'value' => isset($data['customer']) ? $data['customer']->contact_person : ''
                            ])

                            @include('admin.blocks._input_block', [
                                'addClass' => 'hiding col-md-4 col-sm-12 col-xs-12'.(Helper::isPrivatePersonTheCustomer($data) ? ' hidden' : ''),
                                'label' => 'Директор',
                                'name' => 'director',
                                'type' => 'text',
                                'max' => 255,
                                'placeholder' => 'Директор компании',
                                'value' => isset($data['customer']) ? $data['customer']->director : ''
                            ])

                            @include('admin.blocks._input_block', [
                                'addClass' => 'hiding col-md-4 col-sm-12 col-xs-12'.(Helper::isPrivatePersonTheCustomer($data) ? ' hidden' : ''),
                                'label' => 'Директор (родительный падеж)',
                                'name' => 'director_case',
                                'type' => 'text',
                                'max' => 255,
                                'placeholder' => 'Директор компании в родительном падеже',
                                'value' => isset($data['customer']) ? $data['customer']->director_case : ''
                            ])

                            @include('admin.blocks._input_block', [
                                'addClass' => 'col-md-12 col-sm-12 col-xs-12',
                                'label' => 'Адрес',
                                'name' => 'address',
                                'type' => 'text',
                                'max' => 255,
                                'placeholder' => 'Адрес компании',
                                'value' => isset($data['customer']) ? $data['customer']->address : ''
                            ])

                            @include('admin.blocks._input_block', [
                                'addClass' => 'hiding col-md-6 col-sm-12 col-xs-12'.(Helper::isPrivatePersonTheCustomer($data) ? ' hidden' : ''),
                                'label' => 'Номер договора',
                                'name' => 'contract_number',
                                'type' => 'text',
                                'max' => 255,
                                'placeholder' => 'Номер договора',
                                'value' => isset($data['customer']) ? $data['customer']->contract_number : date('d-m-y').((int)Settings::getSettings()['my_status'] ? ' ИП': '')
                            ])

                            @include('admin.blocks._date_block', [
                                'addClass' => 'hiding col-md-6 col-sm-12 col-xs-12'.(Helper::isPrivatePersonTheCustomer($data) ? ' hidden' : ''),
                                'label' => 'Дата заключения договора',
                                'name' => 'contract_date',
                                'value' => isset($data['customer']) ? $data['customer']->contract_date : time()
                            ])
                        </div>
                    </div>

                    <div class="hiding panel panel-flat {{ !isset($data['customer']) || (isset($data['customer']) && $data['customer']->ltd == 2)  ? ' hidden' : '' }}">
                        <div class="panel-heading">
                            <h5 class="panel-title">Реквизиты</h5>
                        </div>
                        <div class="panel-body">
                            @include('admin.blocks._input_block', [
                                'addClass' => 'col-md-4 col-sm-12 col-xs-12',
                                'label' => 'ОГРН',
                                'name' => 'ogrn',
                                'type' => 'text',
                                'max' => 13,
                                'placeholder' => 'ОГРН компании',
                                'value' => isset($data['customer']) ? $data['customer']->ogrn : ''
                            ])

                            @include('admin.blocks._input_block', [
                                'addClass' => 'col-md-4 col-sm-12 col-xs-12',
                                'label' => 'ОКПО',
                                'name' => 'okpo',
                                'type' => 'text',
                                'max' => 8,
                                'placeholder' => 'ОКПО компании',
                                'value' => isset($data['customer']) ? $data['customer']->okpo : ''
                            ])

                            @include('admin.blocks._input_block', [
                                'addClass' => 'col-md-4 col-sm-12 col-xs-12',
                                'label' => 'ОКВЭД',
                                'name' => 'okved',
                                'type' => 'text',
                                'max' => 255,
                                'placeholder' => 'ОКВЭД компании',
                                'value' => isset($data['customer']) ? $data['customer']->okved : ''
                            ])

                            @include('admin.blocks._input_block', [
                                'addClass' => 'col-md-4 col-sm-12 col-xs-12',
                                'label' => 'ОКТМО',
                                'name' => 'oktmo',
                                'type' => 'text',
                                'max' => 8,
                                'placeholder' => 'ОКТМО компании',
                                'value' => isset($data['customer']) ? $data['customer']->oktmo : ''
                            ])

                            @include('admin.blocks._input_block', [
                                'addClass' => 'col-md-4 col-sm-12 col-xs-12',
                                'label' => 'ИНН',
                                'name' => 'inn',
                                'type' => 'text',
                                'max' => 10,
                                'placeholder' => 'ИНН компании',
                                'value' => isset($data['customer']) ? $data['customer']->inn : ''
                            ])

                            @include('admin.blocks._input_block', [
                                'addClass' => 'col-md-4 col-sm-12 col-xs-12',
                                'label' => 'КПП',
                                'name' => 'kpp',
                                'type' => 'text',
                                'max' => 10,
                                'placeholder' => 'КПП компании',
                                'value' => isset($data['customer']) ? $data['customer']->kpp : ''
                            ])

                            @include('admin.blocks._input_block', [
                                'addClass' => 'col-md-4 col-sm-12 col-xs-12',
                                'label' => 'Р/С',
                                'name' => 'payment_account',
                                'type' => 'text',
                                'max' => 20,
                                'placeholder' => 'Р/С компании',
                                'value' => isset($data['customer']) ? $data['customer']->payment_account : ''
                            ])

                            @include('admin.blocks._input_block', [
                                'addClass' => 'col-md-4 col-sm-12 col-xs-12',
                                'label' => 'К/С',
                                'name' => 'correspondent_account',
                                'type' => 'text',
                                'max' => 20,
                                'placeholder' => 'К/С компании',
                                'value' => isset($data['customer']) ? $data['customer']->correspondent_account : ''
                            ])

                            @include('admin.blocks._select_block', [
                                'addClass' => 'col-md-4 col-sm-12 col-xs-12',
                                'label' => 'Банк',
                                'name' => 'bank_id',
                                'values' => $data['banks'],
                                'selected' => isset($data['customer']) ? $data['customer']->bank_id : 1
                            ])
                        </div>
                    </div>
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h5 class="panel-title">Описание</h5>
                        </div>
                        <div class="panel-body">
                            @include('admin.blocks._textarea_block', [
                                'name' => 'description',
                                'value' => isset($data['customer']) ? $data['customer']->description : '',
                                'max' => 2000,
                                'simple' => false
                            ])
                        </div>
                    </div>
                    @if (isset($data['customer']))
                        @include('admin.blocks._custom_contract_fields_block',[
                            'addClass' => 'hiding'.($data['customer']->ltd == 2 ? ' hidden' : ''),
                            'customer' => $data['customer']
                        ])
                    @endif
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    @include('admin.blocks._button_block', ['type' => 'submit', 'icon' => ' icon-floppy-disk', 'text' => trans('admin_content.save'), 'addClass' => 'pull-right'])
                </div>
            </form>
        </div>
    </div>

    @if (isset($data['customer']) && ( Auth::user()->is_admin ? count($data['customer']->tasks) : count($data['customer']->userTasks) ) )
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h4 class="panel-title pull-left">Задачи {{ $data['customer']->name }}</h4>
                @include('admin.blocks._heading_elements_block')
            </div>
            <div class="panel-body customer" data-customer="{{ $data['customer']->name }}">
                <?php $sum = 0; $percents = 0; ?>
                <table class="table datatable-basic table-items">
                    @include('admin.blocks._tasks_table_header_block')
                    @foreach ( (Auth::user()->is_admin ? $data['customer']->tasks : $data['customer']->userTasks) as $k => $task)
                        <?php
                        $percents += $task->percents ? $task->value/100*$task->percents : 0;
                        $sum += $task->value;

                        if (count($task->subTasks)) {
                            foreach($task->subTasks as $subTask) {
                                $sum += $subTask->value;
                            }
                        }
                        ?>
                        @include('admin.blocks._tasks_table_item_block',['task' => $task])
                    @endforeach
                @include('admin.blocks._end_tasks_table_block', ['customer' => $data['customer']->name, 'slug' => $data['customer']->slug, 'useDuty' => $task->use_duty])
    @endif
@endsection