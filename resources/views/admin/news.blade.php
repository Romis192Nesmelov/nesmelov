@extends('layouts.admin')

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h4 class="panel-title">{!! isset($data['news']) ? $data['news']->head : 'Добавление новости' !!}</h4>
        </div>
        <div class="panel-body">
            <form class="form-horizontal" enctype="multipart/form-data" action="{{ url('/admin/news') }}" method="post">
                {{ csrf_field() }}
                @if (isset($data['news']))
                    <input type="hidden" name="id" value="{{ $data['news']->id }}">
                @endif

                @include('admin.blocks._image_block', ['full' => isset($data['news']) ? asset($data['news']->image) : null, 'preview' => isset($data['news']) ? asset($data['news']->image) : null])

                <div class="col-md-9 col-sm-12 col-xs-12">
                    <div class="panel panel-flat">
                        <div class="panel-body">@include('admin.blocks._input_block', [
                                'label' => trans('admin_content.head'),
                                'name' => 'head',
                                'type' => 'text',
                                'placeholder' => trans('admin_content.head'),
                                'max' => 200,
                                'value' => isset($data['news']) ? $data['news']->head : ''
                            ])

                            @include('admin.blocks._date_block', [
                                'label' => trans('admin_content.date'),
                                'name' => 'time',
                                'value' => isset($data['news']) ? $data['news']->time : time()
                            ])

                            @include('admin.blocks._textarea_block', [
                                'label' => 'Анонс',
                                'name' => 'short',
                                'value' => isset($data['news']) ? $data['news']->short : '',
                                'max' => 200,
                                'simple' => true
                            ])
                        </div>
                    </div>
                </div>

                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <div class="panel-title">{{ trans('admin_content.content') }}</div>
                        </div>
                        <div class="panel-body">
                            @include('admin.blocks._textarea_block', [
                                'label' => '',
                                'name' => 'text',
                                'value' => isset($data['news']) ? $data['news']->text : '',
                            ])
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="panel-body">
                        @include('admin.blocks._checkbox_block', ['name' => 'active', 'checked' => isset($data['news']) ? $data['news']->active : true, 'label' => 'Новость активна'])
                        @include('admin.blocks._checkbox_block', ['name' => 'important', 'checked' => isset($data['news']) ? $data['news']->important : false, 'label' => 'Важная новость'])
                    </div>
                </div>

                <div class="col-md-12 col-sm-12 col-xs-12">
                    @include('admin.blocks._button_block', ['type' => 'submit', 'icon' => ' icon-floppy-disk', 'text' => trans('admin_content.save'), 'addClass' => 'pull-right'])
                </div>
            </form>
        </div>
    </div>
@endsection