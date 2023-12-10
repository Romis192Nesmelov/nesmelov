@extends('layouts.admin')

@section('content')

    @include('admin.blocks._modal_delete_block',['modalId' => 'delete-modal', 'function' => 'delete-sent-email', 'head' => 'Вы действительно хотите удалить это письмо?'])

    <div class="panel panel-flat">
        <div class="panel-heading">
            <h3 class="panel-title pull-left">Отправленные письма</h3>
        </div>
        <div class="panel-body">
            <table class="table datatable-basic table-items">
                <tr>
                    <th class="text-center">id</th>
                    <th class="text-center">Кому</th>
                    <th class="text-center">От кого</th>
                    <th class="text-center">Контент</th>
                    <th class="text-center">Время отправления</th>
                    <th class="delete">Удалить</th>
                </tr>
                @foreach ($data['emails'] as $email)
                    <tr role="row" id="{{ 'email_'.$email->id }}">
                        <td class="id">{{ $email->id }}</td>
                        <td class="text-center"><a href="/admin/sent-emails?id={{ $email->id }}">{{ $email->email }}</a></td>
                        <td class="text-center">@include('admin.blocks._cropped_content_block',['croppingContent' => $email->html, 'length' => 100])</td>
                        <td class="text-center">@include('admin.blocks._email_user_block',['email' => $email])</td>
                        <td class="text-center">{{ $email->created_at }}</td>
                        <td class="delete"><span del-data="{{ $email->id }}" modal-data="delete-modal" class="glyphicon glyphicon-remove-circle"></span></td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection