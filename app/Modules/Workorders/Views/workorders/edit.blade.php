@extends('layouts.master')

@section('javascript')

    @include('layouts._datepicker')
    @include('item_lookups._js_item_lookups')
    @include('layouts._alerts')

    {!! Html::style('plugins/timepicker/bootstrap-timepicker.min.css') !!}
    {!! Html::style('plugins/bootstrap-switch/css/bootstrap-switch.min.css') !!}
    {!! Html::script('plugins/timepicker/bootstrap-timepicker.min.js') !!}
    {!! Html::script('plugins/bootstrap-switch/js/bootstrap-switch.min.js') !!}

@endsection

@section('content')

    <div id="div-workorder-edit">

        @include('workorders.partials._edit')

    </div>

@endsection