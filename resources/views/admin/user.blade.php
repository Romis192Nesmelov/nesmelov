@extends('layouts.admin')

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h4 class="panel-title">{{ isset($data['user']) ? 'Редактирование пользователя '.$data['user']->email : 'Добавление пользователя' }}</h4>
        </div>
        <div class="panel-body">
            <form class="form-horizontal" enctype="multipart/form-data" action="{{ url('/admin/user') }}" method="post">
                {{ csrf_field() }}
                @if (isset($data['user']))
                    <input type="hidden" name="id" value="{{ $data['user']->id }}">
                @endif

                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="panel panel-flat">
                        <div class="panel-body">
                            @include('admin.blocks._input_block', [
                                'label' => 'Имя',
                                'name' => 'name',
                                'type' => 'text',
                                'max' => 255,
                                'placeholder' => 'Имя пользователя',
                                'value' => isset($data['user']) ? $data['user']->name : ''
                            ])

                            @include('admin.blocks._input_block', [
                                'label' => 'E-mail',
                                'name' => 'email',
                                'type' => 'email',
                                'max' => 100,
                                'placeholder' => 'E-mail пользователя',
                                'value' => isset($data['user']) ? $data['user']->email : ''
                            ])

                            @include('admin.blocks._input_block', [
                                'label' => 'Телефон',
                                'name' => 'phone',
                                'type' => 'tel',
                                'placeholder' => '+7(___)__-__-__',
                                'value' => isset($data['user']) ? $data['user']->phone : ''
                            ])

                            @if (isset($data['user']) && !Auth::user()->is_admin)
                                @include('admin.blocks._input_block', [
                                    'label' => 'Старый пароль',
                                    'name' => 'old_password',
                                    'type' => 'password',
                                    'max' => 50,
                                    'placeholder' => 'Старый пароль пользователя',
                                    'value' => ''
                                ])
                            @endif

                            <div class="panel panel-flat">
                                @if (isset($data['user']))
                                    <div class="panel-heading">
                                        <h4 class="text-grey-300">Если вы не хотите менять пароль, то оставьте эти поля пустыми</h4>
                                    </div>
                                @endif

                                <div class="panel-body">
                                    @include('admin.blocks._input_block', [
                                        'label' => 'Новый пароль',
                                        'name' => 'password',
                                        'type' => 'password',
                                        'max' => 50,
                                        'placeholder' => 'Пароль пользователя',
                                        'value' => ''
                                    ])

                                    @include('admin.blocks._input_block', [
                                        'label' => 'Подтверждение пароля',
                                        'name' => 'password_confirmation',
                                        'type' => 'password',
                                        'max' => 50,
                                        'placeholder' => 'Подтверждение пароля',
                                        'value' => ''
                                    ])

                                </div>
                            </div>
                        </div>
                    </div>

                    @if (Gate::allows('is-admin'))
                        <div class="panel panel-flat">
                            <div class="panel-body">
                                @include('admin.blocks._radio_button_block', [
                                    'name' => 'is_admin',
                                    'values' => [
                                        ['val' => 1, 'descript' => 'Администратор'],
                                        ['val' => 0, 'descript' => 'Пользователь']
                                    ],
                                    'activeValue' => isset($data['user']) ? $data['user']->is_admin : 0
                                ])
                            </div>
                        </div>
                    @endif

                    <div class="panel panel-flat">
                        <div class="panel-body">
                            @include('admin.blocks._checkbox_block', [
                                'label' => 'Отправлять оповещения по почте',
                                'name' => 'send_email',
                                'checked' => isset($data['user']) ? $data['user']->send_email : 1
                            ])
                        </div>
                    </div>
                </div>

                <div class="col-md-12 col-sm-12 col-xs-12">
                    @include('admin.blocks._button_block', ['type' => 'submit', 'icon' => ' icon-floppy-disk', 'text' => trans('admin_content.save'), 'addClass' => 'pull-right'])
                </div>
            </form>
        </div>
    </div>
@endsection