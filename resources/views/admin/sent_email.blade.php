@extends('layouts.admin')

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h4 class="panel-title">Отправленное сообщение от {{ $data['email']->created_at }}</h4>
        </div>
        <div class="panel-body">
            <div class="panel panel-flat">
                <div class="panel-body">
                    <h5><b>Получатель:</b> {{ $data['email']->email }}</h5>
                    <h5><b>Отправитель:</b> @include('admin.blocks._email_user_block',['email' => $data['email']])</h5>
                </div>
            </div>
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h5 class="panel-title">Содержание:</h5>
                </div>
                <div class="panel-body">{!! $data['email']->html !!}</div>
            </div>
        </div>
    </div>
@endsection