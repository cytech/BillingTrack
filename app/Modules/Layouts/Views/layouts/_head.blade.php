
<link href="{{ asset('favicon.png') }}" rel="icon" type="image/png">
{!! Html::style('css/jquery-ui-themes/'.config('bt.jquiTheme').'/jquery-ui.min.css') !!}

@if (file_exists(base_path('custom/custom.css')))
    <link href="{{ asset('custom/custom.css') }}" rel="stylesheet" type="text/css"/>
@endif

