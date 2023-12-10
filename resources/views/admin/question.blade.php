@extends('layouts.admin')

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h4 class="panel-title">{!! isset($data['question']) ? $data['question']->question : 'Добавление вопроса' !!}</h4>
        </div>
        <div class="panel-body">
            <form class="form-horizontal" enctype="multipart/form-data" action="{{ url('/admin/question') }}" method="post">
                {{ csrf_field() }}
                @if (isset($data['question']))
                    <input type="hidden" name="id" value="{{ $data['question']->id }}">
                @endif

                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="panel panel-flat">
                        <div class="panel-body">
                            @include('admin.blocks._input_block', [
                                'label' => 'Вопрос',
                                'name' => 'question',
                                'type' => 'text',
                                'max' => 255,
                                'placeholder' => 'Вопрос',
                                'value' => isset($data['question']) ? $data['question']->question : ''
                            ])

                            @include('admin.blocks._textarea_block', [
                                'label' => 'Ответ',
                                'name' => 'answer',
                                'value' => isset($data['question']) ? $data['question']->answer : '',
                                'max' => 2000
                            ])
                        </div>
                    </div>
                </div>

                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="panel-body">
                        @include('admin.blocks._checkbox_block', ['name' => 'active', 'checked' => isset($data['question']) ? $data['question']->active : true, 'label' => 'Вопрос активен'])
                    </div>
                </div>

                <div class="col-md-12 col-sm-12 col-xs-12">
                    @include('admin.blocks._button_block', ['type' => 'submit', 'icon' => ' icon-floppy-disk', 'text' => trans('admin_content.save'), 'addClass' => 'pull-right'])
                </div>
            </form>
        </div>
    </div>
@endsection