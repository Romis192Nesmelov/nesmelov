<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ count($data['messages']) ? '('.count($data['messages']).') ' : '' }}{{ Settings::getSeoTags()['title'] ? Settings::getSeoTags()['title'] : '' }}. Админка</title>

    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/icons/icomoon/styles.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/icons/fontawesome/styles.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet" type="text/css">

    <script type="text/javascript" src="{{ asset('js/admin.js') }}"></script>
    @if (isset($data['sidebar']) && $data['sidebar'])
        <script type="text/javascript" src="{{ asset('js/pages/sidebar_detached_sticky_custom.js') }}"></script>
    @endif
    <script type="text/javascript" src="{{ asset('js/plugins/visualization/echarts/echarts.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/echarts/lines_areas.js') }}"></script>
    <script type="text/javascript" src="{{ asset('ckeditor/ckeditor.js') }}"></script>
</head>

<body {!! isset($data['sidebar']) && $data['sidebar'] ? 'class="has-detached-right"' : '' !!}>
{{ csrf_field() }}

@include('admin.blocks._message_modal_block')

<!-- Main navbar -->
<div class="navbar navbar-inverse">
    <div class="navbar-header">
        <ul class="nav navbar-nav visible-xs-block">
            <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
            <li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
        </ul>
    </div>

    <div class="navbar-collapse collapse" id="navbar-mobile">
        <ul class="nav navbar-nav">
            <li><a class="sidebar-control sidebar-main-toggle hidden-xs"><i class="icon-paragraph-justify3"></i></a></li>
        </ul>

        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
                <a href="#" id="message-counter-container" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="icon-bubbles4"></i>
                    <span class="visible-xs-inline-block position-right">Сообщения</span>
                    @if (count($data['messages']))
                        <span id="message-counter" class="badge bg-warning-400">{{ count($data['messages']) }}</span>
                    @endif
                </a>

                <div id="messages" class="dropdown-menu dropdown-content width-350">
                    @include('blocks._messages_block',['messages' => $data['messages']])
                </div>
            </li>

            <li class="dropdown dropdown-user">
                <a class="dropdown-toggle" data-toggle="dropdown">
                    <span>{{ Auth::user()->email }} </span>
                    <i class="caret"></i>
                </a>

                <ul class="dropdown-menu dropdown-menu-right">
                    <li><a href="{{ url('admin/users?id='.Auth::user()->id) }}"><i class="icon-user"></i> Профиль пользователя</a></li>
                    <li class="divider"></li>
                    <li><a href="{{ url('/logout') }}"><i class="icon-switch2"></i> {{ trans('auth.logout') }}</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>
<!-- /main navbar -->

<!-- Page container -->
<div class="page-container">

<!-- Page content -->
<div class="page-content">

<!-- Main sidebar -->
<div class="sidebar sidebar-main">
<div class="sidebar-content">

<!-- User menu -->
<div class="sidebar-user">
    <div class="category-content">
        <div class="media">
            <div class="media-body">
                <div class="text-size-mini text-muted">
                    <i class="glyphicon glyphicon-user text-size-small"></i> Добро пожаловать<br>{{ Auth::user()->email }}
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /user menu -->

<!-- Main navigation -->
<div class="sidebar-category sidebar-category-visible">
    <div class="category-content no-padding">
        <ul class="navigation navigation-main navigation-accordion">
            <!-- Main -->
            @foreach ($menus as $menu)
                <li {{ preg_match('/^(admin\/'.str_replace('/','\/',$menu['href']).')/', Request::path()) ? 'class=active' : '' }}>
                    <a href="{{ url('/admin/'.$menu['href']) }}"><i class="{{ $menu['icon'] }}"></i> <span>{{ str_limit($menu['name'], 20) }}</span></a>
                    @if (isset($menu['submenu']) && count($menu['submenu']))
                        <ul>
                            @foreach ($menu['submenu'] as $submenu)
                                <?php
                                $addAttrStr = '';
                                if (isset($submenu['addAttr']) && count($submenu['addAttr']) ) {
                                    foreach ($submenu['addAttr'] as $attr => $val) {
                                        $addAttrStr .= $attr.'="'.$val.'"';
                                    }
                                }
                                ?>
                                <li {{ preg_match('/^(admin\/'.str_replace('/','\/',$menu['href'].'/'.$submenu['href']).')/', Request::path()) || (Request::has('id') && Request::path() == 'admin/'.$menu['href'] && str_replace('?id=','',$submenu['href']) == Request::input('id')) ? 'class=active' : '' }}>
                                    <a href="{{ url('/admin/'.$menu['href'].'/'.$submenu['href']) }}" {!! $addAttrStr !!}>{{ str_limit($submenu['name'], 20) }}</a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>
</div>
<!-- /main navigation -->

</div>
</div>
<!-- /main sidebar -->


<!-- Main content -->
<div class="content-wrapper">

    <!-- Page header -->
    <div class="page-header page-header-default">
        <div class="page-header-content">
            <div class="page-title">
                <h4>
                    <i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Home</span>
                    @foreach ($breadcrumbs as $href => $crumb)
                        @include('admin.blocks._cropped_content_block',[
                            'croppingContent' => '- '.$crumb,
                            'length' => 40
                        ])
                    @endforeach
                 </h4>
            </div>
        </div>

        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                <li><a href="{{ url('/admin') }}"><i class="icon-home2 position-left"></i>Home</a></li>
                @foreach ($breadcrumbs as $href => $crumb)
                    <li><a href="{{ url('/admin/'.$href) }}">
                            @include('admin.blocks._cropped_content_block',[
                            'croppingContent' => $crumb,
                            'length' => 40
                        ])
                        </a></li>
                @endforeach
            </ul>
        </div>
    </div>
    <!-- /page header -->


    <!-- Content area -->
    <div class="content">@yield('content')</div>
    <!-- /content area -->

</div>
<!-- /main content -->

</div>
<!-- /page content -->

</div>
<!-- /page container -->

</body>
</html>