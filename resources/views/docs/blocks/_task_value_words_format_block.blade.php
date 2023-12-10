@if ($task->paid_off && !$fullVal)
    {{ Helper::ruNumScript($task->paid_off) }}
@else
    {{ Helper::ruNumScript(Helper::calculateOverTaskVal($task, $fullVal)) }}
@endif
рублей, 00 копеек
