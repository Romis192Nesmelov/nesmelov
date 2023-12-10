@extends('layouts.admin')

@section('content')
    @include('admin.blocks._modal_delete_block',['modalId' => 'delete-modal', 'function' => 'delete-task', 'head' => 'Вы действительно хотите удалить эту задачу?'])
    <div class="container-detached">
        <div class="content-detached">
            <div id="tasks-chart-container" class="panel panel-flat">
                <div class="panel-heading">
                    <h3>Статистика по задачам</h3>
                    @include('admin.blocks._heading_elements_block')
                </div>

                @include('admin.blocks._chart_container_block', [
                    'startPos' => 1,
                    'endPos' => ($data['year'] != date('Y') ? 12 : date('n')),
                    'legend' => $data['statuses_simple'],
                    'chartId' => 'tasks-chart'
                ])
            </div>
            @if (Gate::allows('is-admin'))
                @include('admin.blocks._tasks_table_block', [
                    'head' => 'Задачи',
                    'prefixAnchor' => 'user',
                    'tasks' => $data['tasks'],
                    'useAddButton' => true,
                    'offset' => 1,
                    'chart' => 0,
                    'precision' => 'n'
                ])
            @elseif (count($data['tasks']) || count($data['own_tasks']))

                @if (count($data['tasks']))
                    @include('admin.blocks._tasks_table_block', [
                        'head' => count($data['own_tasks']) ? 'Выполняемые вами задачи' : 'Задачи',
                        'prefixAnchor' => 'user',
                        'tasks' => $data['tasks'],
                        'useAddButton' => true,
                        'offset' => 1,
                        'chart' => 0,
                        'precision' => 'n'
                    ])
                @endif

                @if (count($data['own_tasks']))
                    @include('admin.blocks._tasks_table_block', [
                        'head' => count($data['tasks']) ? 'Задачи поставленные Вами' : 'Задачи',
                        'prefixAnchor' => 'owner',
                        'tasks' => $data['own_tasks'],
                        'useAddButton' => false,
                        'offset' => 1,
                        'chart' => 0,
                        'precision' => 'n'
                    ])
                @endif

                <div class="panel-heading">
                    @include('admin.blocks._add_button_block',['href' => 'tasks/add', 'text' => 'Добавить задачу'])
                </div>
            @else
                <div class="panel-body">
                    <div class="panel-heading">
                        @include('admin.blocks._add_button_block',['href' => 'tasks/add', 'text' => 'Добавить задачу'])
                    </div>
                    <h1 class="text-center text-grey-300">Задач нет</h1>
                </div>
            @endif
        </div>
        @include('admin.blocks._years_block')
    </div>

    @if (count($data['tasks']) || (isset($data['own_tasks']) && count($data['own_tasks'])))
        <div class="sidebar-detached">
            <div class="sidebar sidebar-default">
                <div class="sidebar-content">
                    @if (Gate::allows('is-admin'))
                        @include('admin.blocks._customers_sidebar_block', ['head' => 'Заказчики', 'prefixAnchor' => 'user', 'tasks' => $data['tasks']])
                    @else
                        @if (count($data['tasks']))
                            @include('admin.blocks._customers_sidebar_block', ['head' => count($data['own_tasks']) ? 'Заказчики выполняемых Вами задач' : 'Заказчики', 'prefixAnchor' => 'user', 'tasks' => $data['tasks']])
                        @endif

                        @if (count($data['own_tasks']))
                            @include('admin.blocks._customers_sidebar_block', ['head' => count($data['tasks']) ? 'Заказчики поставленных Вами задач' : 'Заказчики', 'prefixAnchor' => 'owner', 'tasks' => $data['own_tasks']])
                        @endif
                    @endif
                </div>
            </div>
        </div>
    @endif
@endsection