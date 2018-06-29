<link href="{{ asset('favicon.png') }}" rel="icon" type="image/png">
<link href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/ionicons/css/ionicons.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/dist/css/AdminLTE.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/dist/css/skins/' . $skin) }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/dist/css/skins/dataTable-style.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/style.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/plugins/datatables.net-bs/css/dataTables.bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>

@if (file_exists(base_path('custom/custom.css')))
    <link href="{{ asset('custom/custom.css') }}" rel="stylesheet" type="text/css"/>
@endif

<script src="{{ asset('assets/plugins/jQuery/jquery.min.js') }}"></script>
{{--<script src="{{ asset('assets/plugins/jQueryUI/jquery-ui-1.10.3.min.js') }}"></script>--}}
<script src="{{ asset('assets/plugins/jQueryUI/jquery-ui.min.js') }}"></script>
<script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/plugins/slimScroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
<script src='{{ asset('assets/plugins/fastclick/fastclick.min.js') }}'></script>
<script src='{{ asset('assets/plugins/sweetalert2/sweetalert2.all.js') }}'></script>

<script src="{{ asset('assets/dist/js/adminlte.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/autosize/jquery-autosize.min.js') }}" type="text/javascript"></script>