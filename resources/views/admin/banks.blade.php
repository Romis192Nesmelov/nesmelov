@extends('layouts.admin')

@section('content')

    @include('admin.blocks._modal_delete_block',['modalId' => 'delete-modal', 'function' => 'delete-bank', 'head' => 'Вы действительно хотите удалить этот банк?'])

    <div class="panel panel-flat">
        <div class="panel-heading">
            <h3 class="panel-title pull-left">Банки</h3>
        </div>
        <div class="panel-body">
            <table class="table table-striped">
                <tr>
                    <th class="id">Id</th>
                    <th class="text-center">Назвние</th>
                    <th class="text-center hidden-xs">Дата и время создания</th>
                    <th class="delete hidden-xs">Удалить</th>
                </tr>
                @foreach ($data['banks'] as $bank)
                    <tr role="row" id="{{ 'bank_'.$bank->id }}">
                        <td class="id">{{ $bank->id }}</td>
                        <td class="text-center"><a href="/admin/banks?id={{ $bank->id }}">{{ $bank->name }}</a></td>
                        <td class="text-center hidden-xs">{{ $bank->created_at }}</td>
                        <td class="delete hidden-xs"><span del-data="{{ $bank->id }}" modal-data="delete-modal" class="glyphicon glyphicon-remove-circle"></span></td>
                    </tr>
                @endforeach
            </table>
            @include('admin.blocks._add_button_block',['href' => 'banks/add', 'text' => 'Добавить банк'])
        </div>
    </div>
@endsection