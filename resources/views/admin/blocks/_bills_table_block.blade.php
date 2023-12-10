<table class="table datatable-basic">
    <tr>
        <th class="text-center">№</th>
        <th class="text-center">Задача</th>
        <th class="text-center">Дата выставления</th>
        {{--<th class="text-center">Создан</th>--}}
        <th class="text-center">Подписан</th>
        <th class="text-center">Статус</th>
        <th class="delete">Удалить</th>
    </tr>
    @foreach ($bills as $bill)
        @if (
            (
                $bill->task->status <= 2 ||
                $bill->task->status >= 6 ||
                ($bill->task->status == 3 && $bill->task->paid_off && $bill->task->bills[0]->id == $bill->id)
            )
            &&
            (
            $bill->task->customer->ltd < 2 ||
            $bill->task->customer->ltd == 3
            )
        )
            <tr role="row" id="{{ 'bill_'.$bill->id }}">
                <td class="id">{{ $bill->number }}</td>
                <td class="text-center"><a href="/admin/bills?id={{ $bill->id }}">{{ $bill->task->customer->name.' - '.$bill->task->name }}</a></td>
                <td class="text-center">{{ date('d.m.Y',$bill->date) }}</td>
                {{--<td class="text-center">{{ $bill->user->name }}</td>--}}
                <td class="text-center">
                    @include('admin.blocks._bills_status_block',['bill' => $bill])
                </td>
                <td class="text-center">
                    @include('admin.blocks._extended_status_block',[
                        'status' => $bill->status,
                        'descriptions' => $statuses
                    ])
                </td>
                <td class="delete"><span del-data="{{ $bill->id }}" modal-data="delete-modal" class="glyphicon glyphicon-remove-circle"></span></td>
            </tr>
        @endif
    @endforeach
</table>