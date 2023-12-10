@extends('layouts.admin')

@section('content')

    @include('admin.blocks._modal_delete_block',['modalId' => 'delete-modal', 'function' => 'delete-question', 'head' => 'Вы действительно хотите удалить этот вопрос?'])

    <div class="panel panel-flat">
        <div class="panel-heading">
            <h3 class="panel-title pull-left">Вопросы-ответы</h3>
            @include('admin.blocks._add_button_block',['href' => 'questions/add', 'text' => 'Добавить вопрос'])
        </div>
        <div class="panel-body">
            <table class="table datatable-basic table-items">
                <tr>
                    <th class="id">Id</th>
                    <th class="text-center">Вопрос</th>
                    <th class="text-center">Ответ</th>
                    <th class="text-center">Активен</th>
                    <th class="text-center">Дата создания</th>
                    <th class="delete">Удалить</th>
                </tr>
                @foreach ($data['questions'] as $question)
                    <tr role="row" id="{{ 'question_'.$question->id }}">
                        <td class="id">{{ $question->id }}</td>
                        <td class="text-left head"><a href="/admin/questions?id={{ $question->id }}">{{ strip_tags($question->question) }}</a></td>
                        <td class="text-left head">@include('admin.blocks._cropped_content_block',['croppingContent' => $question->answer, 'length' => 200])</td>
                        <td class="text-center">@include('admin.blocks._status_block', ['status' => $question->active, 'trueLabel' => 'Активен', 'falseLabel' => 'Не активен'])</td>
                        <td class="text-center">{{ $question->created_at->format('d.m.Y') }}</td>
                        <td class="delete"><span del-data="{{ $question->id }}" modal-data="delete-modal" class="glyphicon glyphicon-remove-circle"></span></td>
                    </tr>
                @endforeach
            </table>
            @include('admin.blocks._add_button_block',['href' => 'questions/add', 'text' => 'Добавить вопрос'])
        </div>
    </div>
@endsection