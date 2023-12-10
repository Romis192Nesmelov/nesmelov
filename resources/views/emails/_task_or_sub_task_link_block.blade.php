@if (isset($fields['parent_id']) && $fields['parent_id'])
    подзада{{ $case ? 'чи' : 'ча' }} <a href="{{ Config::get('app.url').'/admin/tasks/sub_task?id='.$fields['id'] }}">{{ $fields['name'] }}</a> в составе данной задачи <a href="{{ Config::get('app.url').'/admin/tasks?id='.$fields['parent_id'] }}">{{ $fields['parent_name'] }}</a>
@else
    задачи <a href="{{ Config::get('app.url').'/admin/tasks?id='.$fields['id'] }}">«{{ $fields['name'] }}»</a>
@endif