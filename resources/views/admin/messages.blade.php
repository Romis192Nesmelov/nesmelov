@extends('layouts.admin')

@section('content')

    @include('admin.blocks._modal_delete_block',['modalId' => 'delete-modal', 'function' => 'delete-message', 'head' => 'Вы действительно хотите удалить это сообщение?'])

    <div class="panel panel-flat">
        <div class="panel-heading">
            <h3 class="panel-title pull-left">Сообщения</h3>
        </div>
        <div class="panel-body">
            <table class="table datatable-basic table-items">
                <tr>
                    <th class="text-center">Ответственный/Исполнитель</th>
                    <th class="text-center">Сообщение</th>
                    <th class="text-center">Клиент-задача</th>
                    <th class="text-center">Статус</th>
                    <th class="text-center">Прочитано</th>
                    <th class="delete">Удалить</th>
                </tr>
                @foreach ($data['messages_list'] as $message)
                    @if (Auth::user()->is_admin || ($message->owner->id == Auth::user()->id && $message->active_to_owner != 2) || ($message->user->id == Auth::user()->id && $message->active_to_user != 2))
                        <tr role="row" id="{{ 'message_'.$message->id }}">
                            <td class="text-center head">{!! $message->owner->name.'/<br>'.$message->user->name !!}</td>
                            <td class="text-center">{!! $message->message !!}</td>
                            <td class="text-center"><a href="/admin/tasks?id={{ $message->task->id }}">{!! $message->task->customer->name.'<br> - «'.$message->task->name.'»' !!}</a></td>
                            <td class="text-center">@include('admin.blocks._message_status_block', ['status' => $message->status])</td>
                            <td class="text-center">@include('admin.blocks._message_active_block', ['active_to_owner' => $message->active_to_owner,'active_to_user' => $message->active_to_user])</td>
                            <td class="text-center delete"><span del-data="{{ $message->id }}" modal-data="delete-modal" class="glyphicon glyphicon-remove-circle"></span></td>
                        </tr>
                    @endif
                @endforeach
            </table>
        </div>
    </div>
@endsection