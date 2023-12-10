@if ($task->paid_off && !$fullVal)
    {{ Helper::moneyFormat((int)$task->paid_off) }}
@else
    {{ Helper::moneyFormat(Helper::calculateOverTaskVal($task,(isset($billMode) && $billMode ? false : $fullVal))) }}
@endif