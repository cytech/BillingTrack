<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>@lang('bt.welcome')</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

    <link rel="stylesheet" href="/css/app.css">

    <script src="/js/app.js"></script>

    <link href="{{ asset('favicon.png') }}" rel="icon" type="image/png">

    @if (file_exists(base_path('custom/custom.css')))
        <link href="{{ asset('custom/custom.css') }}" rel="stylesheet" type="text/css"/>
    @endif

</head>
<body class="login-page">
        @if(!config('app.demo'))
            <div class="brand-link">
                <img src="/img/billingtrack_logo.svg" alt="BillingTrack Logo" class="brand-image img-circle elevation-3 img-sm"
                     style="opacity: .8">
                <span class="brand-text font-weight-light h2"> {{ config('bt.headerTitleText', config('app.name','BillingTrack')) }}</span>
            </div>
        @else
            <div class="brand-link bg-purple ">
                <img src="/img/billingtrack_logo.svg" alt="BillingTrack Logo" class="brand-image img-circle elevation-3 img-sm"
                     style="opacity: .8">
                <span class="brand-text font-weight-light h2"> {{ config('bt.headerTitleText', config('app.name','BillingTrack')) }} Live Demo</span>
            </div>
        @endif
<div class="login-box">
    <div class="login-box-body">
        @include('layouts._alerts')
        <h2 class="text-center">
            Account Login
        </h2>
        <hr class="bg-green">
        {!! Form::open() !!}
        <div class="form-group has-feedback">
            <input type="email" name="email" id="email" class="form-control" placeholder="@lang('bt.email')">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
            <input type="password" name="password" class="form-control" placeholder="@lang('bt.password')">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="row">
            <div class="col-8">
                <div class="form-check">
                    <label>
                        <input type="hidden" name="remember_me" value="0">
                        @if(!config('app.demo'))
                        <input type="checkbox" name="remember_me" value="1"> @lang('bt.remember_me')
                        @endif
                    </label>
                </div>
            </div>
            <div class="col-4">
                <button type="submit" class="btn btn-primary btn-block btn-flat">@lang('bt.sign_in')</button>
            </div>
        </div>
        {!! Form::close() !!}
        @if(config('app.demo'))
            <div class="row text-center ml-5">
                <br><br>
                Demo Login
                <br>
                Email = admin@example.com
                <br>
                Password = secret
            </div>
        @endif

    </div>
</div>

<script type="text/javascript">
    $(function () {
        $('#email').focus();
    });
</script>

</body>
</html>
