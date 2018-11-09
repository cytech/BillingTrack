<!DOCTYPE html>
<html class="public-layout">
<head>
    <meta charset="UTF-8">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>

    <link rel="stylesheet" href="/css/app.css">

    <script src="/js/app.js"></script>

    <title>{{ config('fi.headerTitleText') }}</title>

    @include('layouts._head')

    @include('layouts._js_global')

    @yield('head')

    @yield('javascript')

</head>
<body class="layout-boxed sidebar-mini ">

<div class="wrapper">

    <header class="navbar-{{ $headClass }} bg-{{ $headBackground }} border-bottom">

        <a href="{{ auth()->check() ? route('dashboard.index') : '#' }}" class="brand-link bg-{{ $headBackground }} border-bottom ">
            <img src="/img/fi_logo2.png" alt="FusionInvoiceFOSS Logo" class="brand-image img-circle elevation-3 img-sm"
                 style="opacity: .8">
            <span class="brand-text font-weight-light">{{ config('app.name', 'FusionInvoiceFOSS') }}</span>
        </a>

        @yield('header')

    </header>


    <div class="content-wrapper content-wrapper-public mt-2">
        @yield('content')
    </div>

</div>

<div id="modal-placeholder"></div>

</body>
</html>