<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('bt.headerTitleText') }}</title>
    <link rel="stylesheet" href="/css/app.css">

    <script src="/js/app.js"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

    @yield('head')

    @yield('javaScript')
</head>
<body class="layout-boxed sidebar-mini">
<div class="wrapper">
    <script src="/js/app.js"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <a href="#" class="brand-link bg-light border-bottom">
        <img src="/img/billingtrack_logo.svg" alt="BillingTrack Logo" class="brand-image img-circle elevation-3 img-sm"
             style="opacity: .8">
        <span class="brand-text font-weight-light">{{ config('bt.headerTitleText', config('app.name','BillingTrack')) }}</span>
    </a>
    @yield('header')
    <div class="content-wrapper content-wrapper-public">
        @yield('content')
    </div>
</div>
<div id="modal-placeholder"></div>
@stack('scripts')
</body>
</html>
