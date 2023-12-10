@extends('layouts.admin')

@section('content')
    @include('admin.blocks._modal_delete_block',['modalId' => 'delete-modal', 'function' => 'delete-user', 'head' => 'Вы действительно хотите удалить этого пользователя?'])

    <div class="panel panel-flat">
        <div class="panel-heading">
            <h3 class="panel-title">Пользователи</h3>
        </div>
        <div class="panel-body">
            <table class="table datatable-basic table-items">
                <tr>
                    <th class="text-center">Имя</th>
                    <th class="text-center">E-mail</th>
                    <th class="text-center">Телефон</th>
                    <th class="text-center">Создан</th>
                    <th class="text-center">Статус</th>
                    <th class="text-center">{{ Gate::allows('is-admin') ? 'Удалить' : '' }}</th>
                </tr>
                @foreach ($data['users'] as $user)
                    <tr role="row" id="{{ 'user_'.$user->id }}">
                        <td class="text-center head"><a href="/admin/users?id={{ $user->id }}">{{ $user->name }}</a></td>
                        <td class="text-center head">@include('admin.blocks._email_href_block',['email' => $user->email])</td>
                        <td class="text-center">@include('admin.blocks._phone_href_block',['phone' => $user->phone])</td>
                        <td class="text-center">{{ $user->created_at }}</td>
                        <td class="text-center">@include('admin.blocks._status_block', ['status' => $user->is_admin, 'trueLabel' => 'Админ', 'falseLabel' => 'Пользователь'])</td>
                        <td class="delete">
                            @if (Gate::allows('is-admin') && $user->id != 1)
                                <span del-data="{{ $user->id }}" modal-data="delete-modal" class="glyphicon glyphicon-remove-circle"></span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </table>

            @if (Gate::allows('is-admin'))
                @include('admin.blocks._add_button_block',['href' => 'users/add', 'text' => 'Добавить пользователя'])
            @endif
        </div>
    </div>
@endsection