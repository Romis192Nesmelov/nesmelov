@extends('layouts.mail')

@section('content')
    <h3>Изменение вашего статуса в системе @include('emails._system_href_block')</h3>
    <h4>Новый статус: {{ $fields['status'] ? 'Администратор' : 'Пользователь' }}</h4>
    @include('emails._if_you_dont_do_that_block')
@endsection