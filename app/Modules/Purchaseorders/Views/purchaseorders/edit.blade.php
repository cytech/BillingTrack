@extends('layouts.master')

@section('javaScript')


    @include('products._js_products')

@stop

@section('content')

    <div id="div-purchaseorder-edit">

        @include('purchaseorders._edit')

    </div>

@stop
