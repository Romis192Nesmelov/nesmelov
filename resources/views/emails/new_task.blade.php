@extends('layouts.mail')

@section('content')
    <h3>Cоздана новая
        @include('emails._task_or_sub_task_link_block',['fields' => $fields, 'case' => false])
        в системе @include('emails._system_href_block')</h3>
    <p>
        Заказчик: <b>{{ $fields['customer'] }}</b><br>
        Название задачи: <b>{{ $fields['name'] }}</b><br>
        Контактный E-mail: <b>{{ $fields['email'] }}</b><br>
        Контактный телефон: <b>{{ $fields['phone'] }}</b><br>
        Контактное лицо: <b>{{ $fields['contact_person'] }}</b><br>
        Цена вопроса: <b>{{ $fields['value'] }}р.</b><br>

        @if (!isset($fields['parent_id']) || !$fields['parent_id'])
            Предоплата: <b>{{ $fields['paid_off'] }}р.</b><br>
            Процент исполнителю: <b>{{ $fields['percents'] }}%</b><br>
            Ответственный за исполнение: <b>{{ $fields['owner'] }}</b><br>
            Исполнитель: <b>{{ $fields['user'] }}</b><br>
        @endif

        Статус: <b>«{{ $fields['status'] }}»</b><br>
        Начало работы: <b>{{ date('d.m.Y',$fields['start_time']) }}</b><br>
        Предполагаемое время завершения: <b>{{ date('d.m.Y',$fields['completion_time']) }}</b>
    </p>
@endsection