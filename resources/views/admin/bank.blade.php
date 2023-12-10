@extends('layouts.admin')

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h4 class="panel-title">{!! isset($data['bank']) ? $data['bank']->name : 'Добавление банка' !!}</h4>
        </div>
        <div class="panel-body">
            <form class="form-horizontal" enctype="multipart/form-data" action="{{ url('/admin/bank') }}" method="post">
                {{ csrf_field() }}
                @if (isset($data['bank']))
                    <input type="hidden" name="id" value="{{ $data['bank']->id }}">
                @endif

                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="panel panel-flat">
                        <div class="panel-body">
                            @include('admin.blocks._input_block', [
                                'addClass' => 'col-md-6 col-sm-12 col-xs-12',
                                'label' => 'Название',
                                'name' => 'name',
                                'type' => 'text',
                                'max' => 255,
                                'placeholder' => 'Название банка',
                                'value' => isset($data['bank']) ? $data['bank']->name : ''
                            ])

                            @include('admin.blocks._input_block', [
                                'addClass' => 'col-md-6 col-sm-12 col-xs-12',
                                'label' => 'БИК',
                                'name' => 'bank_id',
                                'type' => 'text',
                                'max' => 9,
                                'placeholder' => 'БИК банка',
                                'value' => isset($data['bank']) ? $data['bank']->bank_id : ''
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