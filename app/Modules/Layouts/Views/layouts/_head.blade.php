<link href="{{ asset('favicon.png') }}" rel="icon" type="image/png">
<link href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
{{--test bootstrap 4.1--}}
{{--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">--}}
<link href="{{ asset('assets/font-awesome/css/all.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/font-awesome/css/v4-shims.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/ionicons/css/ionicons.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/dist/css/AdminLTE.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/dist/css/skins/' . $skin) }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/dist/css/skins/dataTable-style.min.css') }}" rel="stylesheet" type="text/css"/>
{{--make sure to use from the BUILD directory...--}}
{!! Html::style('assets/plugins/jquery-datetimepicker/jquery.datetimepicker.min.css') !!}
<link href="{{ asset('assets/style.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/plugins/datatables.net-bs/css/dataTables.bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
<!-- Custom CSS -->
{!! Html::style('css/sb-admin-2.min.css') !!}
{!! Html::style('css/jquery-ui-themes/cupertino/jquery-ui-cupertino.min.css') !!}

@if (file_exists(base_path('custom/custom.css')))
    <link href="{{ asset('custom/custom.css') }}" rel="stylesheet" type="text/css"/>
@endif

<script src="{{ asset('assets/plugins/jQuery/jquery.min.js') }}"></script>
{{--<script src="{{ asset('assets/plugins/jQueryUI/jquery-ui-1.10.3.min.js') }}"></script>--}}
<script src="{{ asset('assets/plugins/jQueryUI/jquery-ui.min.js') }}"></script>
{{--make sure to use from the BUILD directory...--}}
{!! Html::script('assets/plugins/jquery-datetimepicker/jquery.datetimepicker.full.min.js') !!}
{{--test bootstrap 4.1--}}
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>--}}
{{--<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>--}}
<script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/plugins/slimScroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/angular/angular.min.js') }}" type="text/javascript"></script>
<script src='{{ asset('assets/plugins/fastclick/fastclick.min.js') }}'></script>
<script src='{{ asset('assets/plugins/sweetalert2/sweetalert2.all.js') }}'></script>

<script src="{{ asset('assets/dist/js/adminlte.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/autosize/jquery-autosize.min.js') }}" type="text/javascript"></script>