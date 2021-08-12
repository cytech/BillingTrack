@extends('layouts.master')

@section('javaScript')


    @include('item_lookups._js_item_lookups')
    @include('layouts._alerts')

@endsection

@section('content')

    <div id="div-workorder-edit">

        @include('workorders.partials._edit')

    </div>

@endsection
