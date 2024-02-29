@extends('layouts.admin')

@section('content')
    <form class="form-horizontal" action="{{ url('/admin/settings') }}" method="post">
        {{ csrf_field() }}
        <div class="panel panel-flat">
            <div class="panel-body">
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h4 class="panel-title">Настройки</h4>
                    </div>
                    <div class="panel-body">
                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <div class="panel panel-flat">
                                <div class="panel-heading">
                                    <h5 class="panel-title">Тип налогооблажения</h5>
                                </div>
                                <div class="panel-body">
                                    @include('admin.blocks._radio_button_block', [
                                        'name' => 'my_status',
                                        'values' => [
                                            ['val' => 1, 'descript' => 'ИП'],
                                            ['val' => 0, 'descript' => 'СЗН'],
                                        ],
                                        'activeValue' => (int)Settings::getSettings()['my_status']
                                    ])
                                </div>
                            </div>
                        </div>
                        <div class="ie-block {{ !(int)Settings::getSettings()['my_status'] ? 'hidden' : '' }}" >
                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                <div class="panel panel-flat">
                                    <div class="panel-body">
                                        @include('admin.blocks._input_block', [
                                            'label' => 'Налог ИП',
                                            'name' => 'tax',
                                            'type' => 'number',
                                            'placeholder' => 'Налог ИП',
                                            'min' => 1,
                                            'max' => 90,
                                            'value' => $data['settings']['tax']
                                        ])
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                <div class="panel panel-flat">
                                    <div class="panel-body">
                                        @include('admin.blocks._input_block', [
                                            'label' => 'Мой процент',
                                            'name' => 'my_percent',
                                            'type' => 'number',
                                            'placeholder' => 'Мой процент на фейк',
                                            'min' => 10,
                                            'max' => 90,
                                            'value' => $data['settings']['my_percent']
                                        ])
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                <div class="panel panel-flat">
                                    <div class="panel-body">
                                        @include('admin.blocks._input_block', [
                                            'label' => 'Фикс.взносы в ПФРФ',
                                            'name' => 'fix_tax',
                                            'type' => 'number',
                                            'placeholder' => 'Фикс.взносы в ПФРФ',
                                            'min' => 0,
                                            'max' => 100000,
                                            'value' => $data['settings']['fix_tax']
                                        ])
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="se-block col-lg-9 col-md-9 col-sm-12 col-xs-12 {{ (int)Settings::getSettings()['my_status'] ? 'hidden' : '' }}">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="panel panel-flat">
                                    <div class="panel-body">
                                        @include('admin.blocks._input_block', [
                                            'label' => 'Налог для юр.лиц',
                                            'name' => 'tax1',
                                            'type' => 'number',
                                            'placeholder' => 'Налог для юр.лиц',
                                            'min' => 0,
                                            'max' => 90,
                                            'value' => $data['settings']['tax1']
                                        ])
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="panel panel-flat">
                                    <div class="panel-body">
                                        @include('admin.blocks._input_block', [
                                            'label' => 'Налог для физ.лиц',
                                            'name' => 'tax2',
                                            'type' => 'number',
                                            'placeholder' => 'Налог СЗН',
                                            'min' => 1,
                                            'max' => 90,
                                            'value' => $data['settings']['tax2']
                                        ])
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="panel panel-flat">
                                <div class="panel-body">
                                    @include('admin.blocks._checkbox_block', [
                                        'name' => 'show_text',
                                        'checked' => $data['settings']['show_text'],
                                        'label' => 'Показывать текст'
                                    ])
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h4 class="panel-title">Реквизиты</h4>
                    </div>
                    <div class="panel-body">
                        @include('admin.blocks._input_block', [
                            'addClass' => 'col-md-6 col-sm-6 col-xs-12',
                            'label' => 'Адрес',
                            'name' => 'address',
                            'type' => 'text',
                            'max' => 255,
                            'placeholder' => 'Адрес',
                            'value' => $data['requisites']['address']
                        ])
                        @include('admin.blocks._input_block', [
                            'addClass' => 'col-md-6 col-sm-6 col-xs-12',
                            'label' => 'ИНН',
                            'name' => 'tin',
                            'type' => 'text',
                            'max' => 12,
                            'placeholder' => 'ИНН',
                            'value' => $data['requisites']['tin']
                        ])
                        <div class="ie-block {{ !(int)Settings::getSettings()['my_status'] ? 'hidden' : '' }}">
                            @include('admin.blocks._input_block', [
                                'addClass' => 'col-md-3 col-sm-6 col-xs-12',
                                'label' => 'Банк',
                                'name' => 'bank_ie',
                                'type' => 'text',
                                'max' => 255,
                                'placeholder' => 'Банк',
                                'value' => $data['requisites']['bank_ie']
                            ])
                            @include('admin.blocks._input_block', [
                                'addClass' => 'col-md-3 col-sm-6 col-xs-12',
                                'label' => 'БИК',
                                'name' => 'bank_id_ie',
                                'type' => 'text',
                                'max' => 9,
                                'placeholder' => 'БИК',
                                'value' => $data['requisites']['bank_id_se']
                            ])
                            @include('admin.blocks._input_block', [
                                'addClass' => 'col-md-3 col-sm-6 col-xs-12',
                                'label' => 'Р/С',
                                'name' => 'checking_account_ie',
                                'type' => 'text',
                                'max' => 24,
                                'placeholder' => 'Р/С',
                                'value' => $data['requisites']['checking_account_ie']
                            ])
                            @include('admin.blocks._input_block', [
                                'addClass' => 'col-md-3 col-sm-6 col-xs-12',
                                'label' => 'К/С',
                                'name' => 'correspondent_account_ie',
                                'type' => 'text',
                                'max' => 20,
                                'placeholder' => 'К/С',
                                'value' => $data['requisites']['correspondent_account_ie']
                            ])
                        </div>
                        <div class="se-block {{ (int)Settings::getSettings()['my_status'] ? 'hidden' : '' }}">
                            @include('admin.blocks._input_block', [
                                'addClass' => 'col-md-3 col-sm-6 col-xs-12',
                                'label' => 'Банк',
                                'name' => 'bank_se',
                                'type' => 'text',
                                'max' => 255,
                                'placeholder' => 'Банк',
                                'value' => $data['requisites']['bank_se']
                            ])
                            @include('admin.blocks._input_block', [
                                'addClass' => 'col-md-3 col-sm-6 col-xs-12',
                                'label' => 'БИК',
                                'name' => 'bank_id_se',
                                'type' => 'text',
                                'max' => 9,
                                'placeholder' => 'БИК',
                                'value' => $data['requisites']['bank_id_se']
                            ])
                            @include('admin.blocks._input_block', [
                                'addClass' => 'col-md-3 col-sm-6 col-xs-12',
                                'label' => 'Р/С',
                                'name' => 'checking_account_se',
                                'type' => 'text',
                                'max' => 24,
                                'placeholder' => 'Р/С',
                                'value' => $data['requisites']['checking_account_se']
                            ])
                            @include('admin.blocks._input_block', [
                                'addClass' => 'col-md-3 col-sm-6 col-xs-12',
                                'label' => 'К/С',
                                'name' => 'correspondent_account_se',
                                'type' => 'text',
                                'max' => 20,
                                'placeholder' => 'К/С',
                                'value' => $data['requisites']['correspondent_account_se']
                            ])
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    @include('admin.blocks._button_block', ['type' => 'submit', 'icon' => ' icon-floppy-disk', 'text' => trans('admin_content.save'), 'addClass' => 'pull-right'])
                </div>
            </div>
        </div>
    </form>
@endsection