@extends('layouts.master')

@section('javascript')

    @include('layouts._datepicker')
    @include('layouts._typeahead')
    @include('item_lookups._js_item_lookups')
    @include('layouts._alerts')

    {!! Html::style('assets/plugins/timepicker/bootstrap-timepicker.min.css') !!}
    {!! Html::style('assets/plugins/bootstrap-switch/css/bootstrap-switch.min.css') !!}
    {!! Html::script('assets/plugins/timepicker/bootstrap-timepicker.min.js') !!}
    {!! Html::script('assets/plugins/bootstrap-switch/js/bootstrap-switch.min.js') !!}

@endsection

@section('content')

    <div id="div-workorder-edit">

        @include('workorders.partials._edit')

    </div>

@endsection