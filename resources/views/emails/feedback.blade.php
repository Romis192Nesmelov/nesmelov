@extends('layouts.mail')

@section('content')
    <h4>Телефон: {{ $fields['phone'] }}</h4>
    <h4>Имя: {{ $fields['name'] }}</h4>
    <h4>Сообщение:</h4>
    <p>{{ $fields['message'] }}</p>
@endsection