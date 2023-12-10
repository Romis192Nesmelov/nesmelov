@extends('layouts.admin')

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h4 class="panel-title">{!! isset($data['word']) ? $data['word']->word : 'Добавление спам-слова' !!}</h4>
        </div>
        <div class="panel-body">
            <form class="form-horizontal" enctype="multipart/form-data" action="{{ url('/admin/spam-word') }}" method="post">
                {{ csrf_field() }}
                @if (isset($data['word']))
                    <input type="hidden" name="id" value="{{ $data['word']->id }}">
                @endif

                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="panel panel-flat">
                        <div class="panel-body">
                            @include('admin.blocks._input_block', [
                                'label' => 'Слово',
                                'name' => 'word',
                                'type' => 'text',
                                'max' => 255,
                                'placeholder' => 'Слово',
                                'value' => isset($data['word']) ? $data['word']->word : ''
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