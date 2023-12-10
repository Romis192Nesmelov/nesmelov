@extends('layouts.admin')

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h4 class="panel-title">{{ isset($data['bill']) ? 'Счет №'.$data['bill']->number.'. '.$data['bill']->task->customer->name.' — «'.$data['bill']->task->name.'»' : 'Добавление счета' }}</h4>
        </div>
        <div class="panel-body">
            <form class="form-horizontal bill-form" enctype="multipart/form-data" action="{{ url('/admin/bill') }}" method="post">
                {{ csrf_field() }}
                @if (isset($data['bill']))
                    <input type="hidden" name="id" value="{{ $data['bill']->id }}">
                @endif

                <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="panel panel-flat">
                        <div class="panel-body">
                            @include('admin.blocks._radio_button_block', [
                                'name' => 'signing',
                                'values' =>
                                [
                                    ['val' => 1, 'descript' => 'Подп. с 1-й стороны'],
                                    ['val' => 2, 'descript' => 'На подп. 2-й стороны'],
                                    ['val' => 3, 'descript' => 'Подп. обеими сторонами']
                                ],
                                'activeValue' => isset($data['bill']) ? $data['bill']->signing : 1
                            ])
                        </div>
                    </div>

                    @if (isset($data['bill']))
                        <div class="panel panel-flat">
                            <div class="panel-body">
                                @include('admin.blocks._radio_button_block', [
                                    'name' => 'status',
                                    'values' =>
                                    $data['bill']->task->paid_off &&
                                    $data['bill']->task->bills[0]->id == $data['bill']->id &&
                                    $data['bill']->task->paid_off != $data['bill']->task->value ? [
                                        ['val' => 1, 'descript' => $data['statuses'][0]],
                                        ['val' => 3, 'descript' => $data['statuses'][2]]
                                    ] : [
                                        ['val' => 1, 'descript' => $data['statuses'][0]],
                                        ['val' => 2, 'descript' => $data['statuses'][1]]
                                    ],
                                    'activeValue' => $data['bill']->status
                                ])
                            </div>
                        </div>
                        <div class="panel panel-flat">
                            <div class="panel-body">
                                @include('admin.blocks._docs_buttons_contract_block',['task' => $data['bill']->task])
                                @include('admin.blocks._docs_buttons_convention_block',['task' => $data['bill']->task])

                                @if ($data['bill']->status <= 2)
                                    @if ($data['bill']->save_act && $data['bill']->act)
                                        @include('admin.blocks._docs_button_block', ['text' => 'Распечатать каст.акт', 'href' => 'saved_act?id='.$data['bill']->id])
                                    @else
                                        @include('admin.blocks._docs_button_block', ['text' => 'Распечатать акт', 'href' => 'act?id='.$data['bill']->id])
                                        @include('admin.blocks._docs_button_block', ['text' => 'Распечатать акт с '.((int)Settings::getSettings()['my_status'] ? 'с печатью' : 'с подписью' ), 'href' => 'act?id='.$data['bill']->id.((int)Settings::getSettings()['my_status'] ? '&stamp=true' : '&signature=true')])
                                    @endif
                                @endif

                                @if ($data['bill']->save_bill && $data['bill']->bill)
                                    @include('admin.blocks._docs_button_block', ['text' => 'Распечатать каст.счет', 'href' => 'saved_bill?id='.$data['bill']->id])
                                @else
                                    @include('admin.blocks._docs_button_block', ['text' => 'Распечатать счет', 'href' => 'bill?id='.$data['bill']->id])
                                    @include('admin.blocks._docs_button_block', ['text' => 'Распечатать счет с '.((int)Settings::getSettings()['my_status'] ? 'с печатью' : 'с подписью' ), 'href' => 'bill?id='.$data['bill']->id.((int)Settings::getSettings()['my_status'] ? '&stamp=true' : '&signature=true')])
                                @endif

                                @if ($data['bill']->save_additional && $data['bill']->additional)
                                    @include('admin.blocks._docs_button_block', ['text' => 'Распечатать доп.документы', 'href' => 'saved_additional?id='.$data['bill']->id])
                                @endif
                            </div>
                        </div>
                    @endif
                </div>

                <div class="col-md-8 col-sm-6 col-xs-12">
                    <div class="panel panel-flat">
                        <div class="panel-body">
                            @include('admin.blocks._select_group_block', [
                                'addClass' => 'col-md-12 col-sm-12 col-xs-12 name',
                                'label' => 'Задачи ожидающие оплаты',
                                'name' => 'task_id',
                                'groups' => $data['tasks'],
                                'disabled' => isset($data['bill']),
                                'selected' => isset($data['bill']) ? $data['bill']->task->id : 1,
                            ])

                            @include('admin.blocks._input_block', [
                                'addClass' => 'col-md-4 col-sm-12 col-xs-12',
                                'label' => 'Номер счета',
                                'name' => 'number',
                                'type' => 'number',
                                'min' => 1,
                                'placeholder' => 'Номер счета',
                                'value' => isset($data['bill']) ? $data['bill']->number : $data['last_number']+1
                            ])

                            @include('admin.blocks._input_block', [
                                'addClass' => 'col-md-4 col-sm-12 col-xs-12 bill-value',
                                'label' => 'Сумма',
                                'name' => 'value',
                                'type' => 'text',
                                'disabled' => true,
                                'value' => isset($data['bill']) ? Helper::calculateTaskValForBill($data['bill']) : Helper::calculateTaskValForBill(key(current($data['tasks'])))
                            ])

                            @include('admin.blocks._date_block', [
                                'addClass' => 'col-md-4 col-sm-12 col-xs-12',
                                'label' => 'Дата счета',
                                'name' => 'date',
                                'value' => isset($data['bill']) ? $data['bill']->date : time()
                            ])
                            @include('admin.blocks._checkbox_block', ['label' => 'Отправлять письмо всем участникам при закрытии счета', 'name' => 'send_mail','checked' => (isset($data['bill']) ? $data['bill']->send_email : true)])
                        </div>
                    </div>
                    @if (isset($data['bill']))
                        @include('admin.blocks._custom_contract_fields_block',['task' => $data['bill']->task])
                        @include('admin.blocks._custom_convention_fields_block',['task' => $data['bill']->task])

                        <div class="panel panel-flat panel-collapsed">
                            <div class="panel-heading">
                                <h4 class="panel-title">Кастомный акт</h4>
                                @include('admin.blocks._heading_elements_block')
                            </div>
                            <div class="panel-body">
                                @include('admin.blocks._textarea_block', [
                                    'name' => 'act',
                                    'value' => $data['bill']->act ? $data['bill']->act : view('docs.blocks._act_body_block',['item' => $data['bill'],'noPrint' => true])->render(),
                                    'height' => 1000
                                ])
                                @include('admin.blocks._checkbox_block', ['label' => 'Сохранить акт', 'name' => 'save_act','checked' => $data['bill']->save_act])
                            </div>
                        </div>

                        <div class="panel panel-flat panel-collapsed">
                            <div class="panel-heading">
                                <h4 class="panel-title">Кастомный счет</h4>
                                @include('admin.blocks._heading_elements_block')
                            </div>
                            <div class="panel-body">
                                @include('admin.blocks._textarea_block', [
                                    'name' => 'bill',
                                    'value' => $data['bill']->bill ? $data['bill']->bill : view('docs.blocks._bill_body_block',['item' => $data['bill'],'noPrint' => true])->render(),
                                    'height' => 1000
                                ])
                                @include('admin.blocks._checkbox_block', ['label' => 'Сохранить счет', 'name' => 'save_bill','checked' => $data['bill']->save_bill])
                            </div>
                        </div>
                    @endif
                </div>

                <div class="col-md-12 col-sm-12 col-xs-12">
                    @include('blocks._button_block', ['type' => 'submit', 'icon' => ' icon-floppy-disk', 'text' => trans('admin_content.save'), 'addClass' => 'pull-right'])
                </div>
            </form>
        </div>
    </div>

    @if (isset($data['bill']))
        @include('admin.blocks._tasks_table_block', [
            'head' => 'Связанная задача',
            'prefixAnchor' => 'user',
            'tasks' => [$data['bill']->task],
            'useAddButton' => false,
            'offset' => 1,
            'chart' => 0,
            'precision' => 'n'
        ])
    @endif
@endsection