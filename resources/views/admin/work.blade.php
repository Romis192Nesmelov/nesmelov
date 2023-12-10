@extends('layouts.admin')

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h4 class="panel-title">{{ isset($data['work']) ? $data['work']->name : 'Добавление работы' }}</h4>
        </div>
        <div class="panel-body">
            <form class="form-horizontal" enctype="multipart/form-data" action="{{ url('/admin/work') }}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="branch_id" value="{{ $data['chapter']->id }}">
                @if (isset($data['work']))
                    <input type="hidden" name="id" value="{{ $data['work']->id }}">
                @endif

                <div class="col-md-12 col-sm-12 col-xs-12">
                    @include('admin.blocks._image_block', [
                        'name' => 'preview',
                        'head' => 'Предпоказ',
                        'preview' => isset($data['work']) ? asset($data['work']->preview) : null,
                        'full' => isset($data['work']) ? asset($data['work']->preview) : null
                    ])

                    @if ($data['chapter']->id == 2 || $data['chapter']->id == 5)
                        <div class="col-md-8 col-sm-12 col-xs-12">
                            @include('admin.blocks._input_block', [
                                'label' => 'URL',
                                'name' => 'url',
                                'type' => 'text',
                                'max' => 500,
                                'placeholder' => 'Ссылка',
                                'value' => isset($data['work']) ? $data['work']->url : ''
                            ])
                        </div>
                    @else
                        @include('admin.blocks._image_block', [
                            'name' => 'full',
                            'head' => 'Полная картинка',
                            'preview' => isset($data['work']) ? asset($data['work']->full) : null,
                            'full' => isset($data['work']) ? asset($data['work']->full) : null
                        ])
                    @endif
                </div>

                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="panel panel-flat">
                        <div class="panel-body">
                            <div class="panel-body">
                                @include('admin.blocks._input_block', [
                                    'label' => 'Название',
                                    'name' => 'name',
                                    'type' => 'text',
                                    'max' => 100,
                                    'placeholder' => 'Название работы',
                                    'value' => isset($data['work']) ? $data['work']->name : ''
                                ])

                                @include('admin.blocks._input_block', [
                                    'label' => 'Описание',
                                    'name' => 'description',
                                    'type' => 'text',
                                    'max' => 300,
                                    'placeholder' => 'Описание работы',
                                    'value' => isset($data['work']) ? $data['work']->description : ''
                                ])
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="panel-body">
                        @include('admin.blocks._checkbox_block', ['name' => 'active', 'checked' => isset($data['work']) ? $data['work']->active : true, 'label' => 'Работа активна'])
                    </div>
                </div>

                <div class="col-md-12 col-sm-12 col-xs-12">
                    @include('admin.blocks._button_block', ['type' => 'submit', 'icon' => ' icon-floppy-disk', 'text' => trans('admin_content.save'), 'addClass' => 'pull-right'])
                </div>
            </form>
        </div>
    </div>
@endsection