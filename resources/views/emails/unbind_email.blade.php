@extends('layouts.mail')

@section('content')
    <h3>Ваш E-mail больше не является логином в системе @include('emails._system_href_block')</h3>
    @include('emails._if_you_dont_do_that_block')
@endsection