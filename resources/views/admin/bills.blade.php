@extends('layouts.admin')

@section('content')
    @if (count($data['bills']))
        @include('admin.blocks._modal_delete_block',['modalId' => 'delete-modal', 'function' => 'delete-bill', 'head' => 'Вы действительно хотите удалить этот счет?'])
    @endif

    <div class="panel panel-flat">
        <div class="panel-heading">
            <h3 class="panel-title pull-left">{{ $data['head'] }}</h3>
            @if (count($data['tasks']))
                @include('admin.blocks._add_button_block',['href' => 'bills/add', 'text' => 'Добавить счет'])
            @endif
        </div>
        <div class="panel-body">
            @if (count($data['bills']))
                @include('admin.blocks._bills_table_block', ['bills' => $data['bills'], 'statuses' => $data['statuses']])
                <div class="total-line text-grey-300">Номер последнего счета: <b>{{ $data['last_number'] }}</b></div>
                @if (count($data['tasks']))
                    @include('admin.blocks._add_button_block',['href' => 'bills/add', 'text' => 'Добавить счет'])
                @endif
            @else
                <h1 class="text-center">Счетов не найдено</h1>
            @endif
        </div>
    </div>
@endsection