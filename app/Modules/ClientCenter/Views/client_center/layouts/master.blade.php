<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>

    <link rel="stylesheet" href="/css/app.css">

    <script src="/js/app.js"></script>

    <title>{{ config('bt.headerTitleText') }}</title>

    @include('layouts._head')

    @include('layouts._js_global')

    @yield('javaScript')

</head>
<body class="hold-transition sidebar-mini ">

<div class="wrapper">

    <nav class="main-header navbar navbar-expand navbar-{{ $headClass }} bg-{{ $headBackground }} border-bottom">
        <div class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"
                    ></i></a>
            </li>
        </div>

        @yield('header')

    </nav>

    <aside class="main-sidebar">

        <section class="sidebar">

            @yield('sidebar')

        </section>

    </aside>

    <div class="content-wrapper">
        @yield('content')
    </div>

</div>

<div id="modal-placeholder"></div>

</body>
</html>
