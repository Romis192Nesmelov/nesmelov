@extends('layouts.mail')

@section('content')
    <h3>Новое сообщение в чате <a href="{{ Config::get('app.url').'/admin/tasks?id='.$fields['task_id'].'#message'.$fields['chat_id'] }}">задачи</a> {{ $fields['customer'] }} - «{{ $fields['name'] }}» в системе @include('emails._system_href_block')</h3>
    <h4>Сообщение от {{ $fields['time'] }}:</h4>
    {!! $fields['text'] !!}
@endsection