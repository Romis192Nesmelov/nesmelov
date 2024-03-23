<tr role="row" class="tasks-row" id="{{ 'task_'.$task->id }}">
    <td class="text-left head">
        @if (date('Y') == $data['year'])
            <a href="/admin/tasks{{ isset($suffix) ? '/'.$suffix : '' }}?id={{ $task->id }}">{{ $task->name }}</a>
        @else
            {{ $task->name }}
        @endif
    </td>
    <td class="text-center value">
        <nobr>
            {{ Helper::moneyFormat(Helper::calculateOverTaskVal($task)) }}₽
            @include('admin.blocks._percents_label_block',['task' => $task])
        </nobr>
    </td>
    <td class="text-center">{{ date('d.m.Y',$task->start_time) }}</td>
    <td class="text-center
        @if ($task->status == 2 || $task->status == 3 || $task->status == 5)
            @if (($task->status == 3 || $task->status == 5) && $task->completion_time-time() < (60*60*24))
                {{ ' text-warning-700' }}
            @elseif ( (($task->status == 3 || $task->status == 5) && $task->completion_time-time() < (60*60*24)) || ($task->status == 2 && ($task->payment_time && $task->payment_time < time())) )
                {{ ' text-danger-800' }}
            @endif
        @endif
            ">
        {{ date('d.m.Y',$task->completion_time) }}
    </td>
    <td class="text-center">
        @include('admin.blocks._extended_status_block',[
            'status' => $task->status,
            'descriptions' => $data['statuses_simple']
        ])
    </td>
    <td class="text-center delete">
        @if (
                Auth::user()->is_admin ||
                (isset($task->owner) && $task->owner->id == Auth::user()->id) ||
                (isset($task->task) && ($task->task->owner->id == Auth::user()->id || $task->task->user->id == Auth::user()->id))
            )
            <span del-data="{{ $task->id }}" modal-data="delete-modal" class="glyphicon glyphicon-remove-circle"></span>
        @endif
    </td>
</tr>