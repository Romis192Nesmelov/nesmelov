@extends('layouts.admin')

@section('content')

    @if (Auth::user()->is_admin)
        @include('admin.blocks._modal_delete_block',['modalId' => 'delete-modal', 'function' => 'delete-customer', 'head' => 'Вы действительно хотите удалить этого клиента?'])
    @endif

    <div class="panel panel-flat">
        <div class="panel-heading">
            <h3 class="panel-title pull-left">Заказчики</h3>
        </div>
        <div class="panel-body">
            <table class="table datatable-basic table-items">
                <tr>
                    <th class="text-center">Название</th>
                    <th class="text-center">E-mail</th>
                    <th class="text-center">Телефон</th>
                    <th class="text-center">Контактное лицо</th>
                    <th class="text-center">{{ Auth::user()->is_admin ? 'Статус' : 'Юр.лицо' }}</th>
                    <th class="delete">{{ Auth::user()->is_admin ? 'Удалить' : 'Описание' }}</th>
                </tr>
                @foreach ($data['customers'] as $customer)
                    <tr role="row" id="{{ 'customer_'.$customer->id }}">
                        <td class="text-center head"><a href="/admin/customers/{{ $customer->slug }}">{{ $customer->name }}</a></td>
                        <td class="text-center head">@include('admin.blocks._email_href_block',['email' => $customer->email])</td>
                        <td class="text-center">@include('admin.blocks._phone_href_block',['phone' => $customer->phone])</td>
                        <td class="text-center">{{ $customer->contact_person }}</td>
                        <td class="text-center">
                            @if (Auth::user()->is_admin)
                                @include('admin.blocks._customers_type_block',['type' => $customer->type])
                            @else
                                @include('admin.blocks._customer_form_block',['customer' => $customer])
                            @endif
                        </td>
                        @if (Auth::user()->is_admin)
                            <td class="text-center delete"><span del-data="{{ $customer->id }}" modal-data="delete-modal" class="glyphicon glyphicon-remove-circle"></span></td>
                        @else
                            <td width="15%" class="text-center">@include('admin.blocks._cropped_content_block',['croppingContent' => $customer->description, 'length' => 100])</td>
                        @endif
                    </tr>
                @endforeach
            </table>
            @include('admin.blocks._add_button_block',['href' => 'customers/add', 'text' => 'Добавить клиента'])
        </div>
    </div>
@endsection