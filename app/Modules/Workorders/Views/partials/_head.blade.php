{!! Html::style('assets/addons/Workorders/Assets/jquery-ui-dist/jquery-ui.min.css') !!}
{!! Html::style('assets/addons/Workorders/Assets/datatables.net-dt/css/jquery.dataTables.css') !!}
{!! Html::style('assets/addons/Workorders/Assets/pnotify/dist/pnotify.css') !!}
{!! Html::style('assets/addons/Workorders/Assets/pnotify/dist/pnotify.brighttheme.css') !!}
{!! Html::style('assets/addons/Workorders/Assets/pnotify/dist/pnotify.buttons.css') !!}
{!! Html::style('assets/addons/Workorders/Assets/pnotify/dist/pnotify.history.css') !!}
{{--*********--}}
{!! Html::script('assets/addons/Workorders/Assets/jquery-ui-dist/jquery-ui.min.js') !!}
{{-- line below causing conflict with layouts.master which is using 2.2.4   BELOW is 3.2.1--}}
{{--{!! Html::script('assets/addons/Workorders/Assets/jquery/dist/jquery.min.js') !!}--}}
{!! Html::script('assets/addons/Workorders/Assets/pnotify/dist/pnotify.js') !!}
{!! Html::script('assets/addons/Workorders/Assets/pnotify/dist/pnotify.buttons.js') !!}
{{--{!! Html::script('assets/addons/Workorders/Assets/pnotify/dist/pnotify.confirm.js') !!}--}}
{!! Html::script('assets/addons/Workorders/Assets/pnotify/dist/pnotify.history.js') !!}
{!! Html::script('assets/addons/Workorders/Assets/angular/angular.min.js') !!}
{!! Html::script('assets/addons/Workorders/Assets/datatables.net/js/jquery.dataTables.js') !!}
{!! Html::script('assets/addons/Workorders/Assets/datatables.net-bs/js/dataTables.bootstrap.js') !!}

{{--_foot--}}
@include('Workorders::partials._js_datatables')
@include('Workorders::partials._alerts')

