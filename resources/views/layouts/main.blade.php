<!DOCTYPE html>
<!--  This site was created in Webflow. http://www.webflow.com  -->
<!--  Last Published: Wed Mar 21 2018 11:43:04 GMT+0000 (UTC)  -->
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="yandex-verification" content="e4261c36119b5851" />
    <meta name="google-site-verification" content="gzzatjygFT8h71fZtOvRF0DweX34Da8kJIEC5mrJSEk" />

    <title>{{ $data['seo']['title'] ? $data['seo']['title'] : 'Дизайн и айдентика, веб-технологии и полиграфия, верстка и пре-пресс, 3D-моделирование и анимация. Все в одном.' }}</title>
    @foreach($metas as $meta => $params)
        @if ($data['seo'][$meta])
            <meta {{ $params['name'] ? 'name='.$params['name'] : 'property='.$params['property'] }} content="{{ $data['seo'][$meta] }}">
        @endif
    @endforeach

    <link href="https://fonts.googleapis.com/css?family=Jura&display=swap" rel="stylesheet">
    <link href="{{ asset('css/icons/icomoon/styles.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
</head>
<body>

@include('blocks._nav_block')

@yield('content')

<footer>
    <div class="container text-center">
        <div class="logo"><img src="{{ asset('images/logo.jpg') }}"></div>
        <p class="small">©nesmelov.com {{ date('Y') }}г.<br>{{ $data['seo']['meta_description'] }}</p>
        <p>
            <a href="https://play.google.com/store/apps/details?id=nesmelov.apk" target="_blank"><i class="icon-android"></i></a>
        </p>
        {{--<p class="small"><a href="{{ Config::get('app.old_site') }}" target="_blank">Предыдущая версия сайта</a></p>--}}
    </div>
</footer>

<div id="on_top_button"><i class="glyphicon glyphicon-upload"></i></div>

</body>
</html>
