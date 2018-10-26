<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>

    <title>{{ config('fi.headerTitleText') }}</title>

    @include('layouts._head')
    <script src="{{ asset('plugins/jQuery/jquery.min.js') }}"></script>
    @include('layouts._js_global')

    @yield('head')

    @yield('javascript')

</head>
<body class="skin-fusioninvoice layout-boxed sidebar-mini">

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