<link href="{{ asset('favicon.png') }}" rel="icon" type="image/png">
{{--make sure to use from the BUILD directory...--}}
{!! Html::style('plugins/jquery-datetimepicker/jquery.datetimepicker.min.css') !!}
<link href="{{ asset('plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css"/>
{!! Html::style('css/jquery-ui-themes/cupertino/jquery-ui-cupertino.min.css') !!}
@if (file_exists(base_path('custom/custom.css')))
    <link href="{{ asset('custom/custom.css') }}" rel="stylesheet" type="text/css"/>
@endif
{{--make sure to use from the BUILD directory...--}}
{!! Html::script('plugins/jquery-datetimepicker/jquery.datetimepicker.full.min.js') !!}
<script src="{{ asset('plugins/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src='{{ asset('plugins/sweetalert2/sweetalert2.all.js') }}'></script>
<script src="{{ asset('plugins/autosize/jquery.autosize.min.js') }}" type="text/javascript"></script>
