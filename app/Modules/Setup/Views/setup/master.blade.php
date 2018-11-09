<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('fi.headerTitleText') }}</title>

    <link rel="stylesheet" href="/css/app.css">

    <script src="/js/app.js"></script>


    @include('layouts._head')

    @include('layouts._js_global')

    @yield('head')

    @yield('javascript')

</head>
<body class="layout-boxed sidebar-mini">

<div class="wrapper">

    <header class="main-header">

        <a href="#" class="logo">
            <span class="logo-lg">FusionInvoiceFOSS</span>
        </a>

        <nav class="navbar navbar-static-top" role="navigation">

            @yield('header')

        </nav>
    </header>

    <div class="content-wrapper content-wrapper-public">
        @yield('content')
    </div>

</div>

<div id="modal-placeholder"></div>
@stack('scripts')

</body>
</html>