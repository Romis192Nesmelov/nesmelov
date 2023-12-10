@extends('layouts.admin')

@section('content')

    @include('admin.blocks._modal_delete_block',['modalId' => 'delete-modal', 'function' => 'delete-spam-word', 'head' => 'Вы действительно хотите удалить это слово?'])

    <div class="panel panel-flat">
        <div class="panel-heading">
            <h3 class="panel-title pull-left">Спам-слова</h3>
        </div>
        <div class="panel-body">
            <table class="table table-striped">
                <tr>
                    <th class="id">Id</th>
                    <th class="text-center">Слово или часть слова</th>
                    <th class="text-center hidden-xs">Дата и время создания</th>
                    <th class="delete hidden-xs">Удалить</th>
                </tr>
                @foreach ($data['words'] as $word)
                    <tr role="row" id="{{ 'word_'.$word->id }}">
                        <td class="id">{{ $word->id }}</td>
                        <td class="text-center"><a href="/admin/spam-words?id={{ $word->id }}">{{ $word->word }}</a></td>
                        <td class="text-center hidden-xs">{{ $word->created_at }}</td>
                        <td class="delete hidden-xs"><span del-data="{{ $word->id }}" modal-data="delete-modal" class="glyphicon glyphicon-remove-circle"></span></td>
                    </tr>
                @endforeach
            </table>
        </div>
        <div class="panel-body">
            {{ $data['words']->render() }}
            @include('admin.blocks._add_button_block',['href' => 'spam-words/add', 'text' => 'Добавить слово'])
        </div>
    </div>
@endsection