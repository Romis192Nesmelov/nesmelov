@extends('layouts.mail')

@section('content')
    <h3>Изменен статус вашей
    @include('emails._task_or_sub_task_link_block',['fields' => $fields, 'case' => true])
    (заказчик {{ $fields['customer'] }}) в системе @include('emails._system_href_block')</h3>
    <h4>Новый статус: <b>«{{ $fields['status'] }}»</b></h4>
@endsection