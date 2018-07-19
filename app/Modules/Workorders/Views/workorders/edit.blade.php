@extends('Workorders::partials._master')

@section('javascript')

    @include('layouts._datepicker')
    @include('layouts._typeahead')
    @include('Workorders::itemlookups._js_item_lookups')
    {{--@include('Workorders::partials._alerts')--}}

    {!! Html::style('assets/addons/Workorders/Assets/bootstrap-timepicker/css/bootstrap-timepicker.min.css') !!}
    {!! Html::style('assets/addons/Workorders/Assets/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css') !!}
    {!! Html::script('assets/addons/Workorders/Assets/bootstrap-timepicker/js/bootstrap-timepicker.min.js') !!}
    {!! Html::script('assets/addons/Workorders/Assets/bootstrap-switch/dist/js/bootstrap-switch.min.js') !!}

@endsection

@section('content')

    <div id="div-workorder-edit">

        @include('Workorders::workorders.partials._edit')

    </div>

@endsection