@extends('layouts.mail')

@section('content')
    <h3>Время {{ $fields['time_type'] }}
        @include('emails._task_or_sub_task_link_block',['fields' => $fields, 'case' => true])
        в системе @include('emails._system_href_block') {{ $fields['time_status'] }}.</h3>
@endsection