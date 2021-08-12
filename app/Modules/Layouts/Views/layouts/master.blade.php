<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('bt.headerTitleText') }}</title>

    <link rel="stylesheet" href="/css/app.css">

    @include('layouts._head')

    <script src="/js/app.js"></script>

    @include('layouts._js_global')

    @yield('javaScript')

</head>
<body class=" hold-transition sidebar-mini sidebar-{{$sidebarMode}}">

<div class="wrapper">

    @include('layouts._header')

    @include('layouts.sidebar')

    <div class="content-wrapper">
        @yield('content')
    </div>

</div>

<div id="modal-placeholder"></div>

<a href="#" class="back-to-top" >
    <i class="fa fa-chevron-circle-up"></i>
</a>

@stack('scripts')

</body>
</html>
