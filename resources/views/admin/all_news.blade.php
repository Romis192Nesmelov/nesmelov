@extends('layouts.admin')

@section('content')

    @include('admin.blocks._modal_delete_block',['modalId' => 'delete-modal', 'function' => 'delete-news', 'head' => 'Вы действительно хотите удалить эту новость?'])

    <div class="panel panel-flat">
        <div class="panel-heading">
            <h3 class="panel-title pull-left">Новости</h3>
            @include('admin.blocks._add_button_block',['href' => 'chapters/news/add', 'text' => 'Добавить новость'])
        </div>
        <div class="panel-body">
            <table class="table datatable-basic table-items">
                <tr>
                    <th class="text-center">Заголовок</th>
                    <th class="text-center">Анонс</th>
                    <th class="text-center">Текст новости</th>
                    <th class="text-center">Дата</th>
                    <th class="text-center">Статус</th>
                    <th class="delete">Удалить</th>
                </tr>
                @foreach ($data['news'] as $news)
                    <tr role="row" id="{{ 'new_'.$news->id }}">
                        <td class="text-center head"><a href="/admin/chapters/news/{{ $news->slug }}">{{ $news->head }}</a></td>
                        <td class="text-left">{{ $news->short }}</td>
                        <td class="text-left">@include('admin.blocks._cropped_content_block', ['croppingContent' => $news->text, 'length' => 350])</td>
                        <td class="text-center"><b>{{ date('d.m.Y', $news->time) }}</b></td>
                        <td class="text-center">@include('admin.blocks._status_block', ['status' => $news->active, 'trueLabel' => 'Новость активна', 'falseLabel' => 'Новость не активна'])</td>
                        <td class="text-center delete"><span del-data="{{ $news->id }}" modal-data="delete-modal" class="glyphicon glyphicon-remove-circle"></span></td>
                    </tr>
                @endforeach
            </table>
            @include('admin.blocks._add_button_block',['href' => 'chapters/news/add', 'text' => 'Добавить новость'])
        </div>
    </div>
@endsection