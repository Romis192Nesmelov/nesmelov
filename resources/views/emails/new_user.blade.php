@extends('layouts.mail')

@section('content')
    <h3>Вы зарегистрированны в системе @include('emails._system_href_block')</h3>
    <h4>Ваш пароль: {{ $fields['password'] }}</h4>
    <p>Сменить пароль Вы можете в разделе «Профиль пользователя» после авторизации.</p>
    @include('emails._if_you_dont_do_that_block')
@endsection