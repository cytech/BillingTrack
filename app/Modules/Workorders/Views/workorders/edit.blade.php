@extends('layouts.master')

@section('javascript')


    @include('item_lookups._js_item_lookups')
    @include('layouts._alerts')

    {!! Html::style('plugins/bootstrap-switch/css/bootstrap-switch.min.css') !!}
    {!! Html::script('plugins/bootstrap-switch/js/bootstrap-switch.min.js') !!}

@endsection

@section('content')

    <div id="div-workorder-edit">

        @include('workorders.partials._edit')

    </div>

@endsection