@extends('layouts.master')

@section('javaScript')


    {{--@include('layouts._typeahead')--}}
    @include('item_lookups._js_item_lookups')

@stop

@section('content')

    <div id="div-recurring-invoice-edit">

        @include('recurring_invoices._edit')

    </div>

@stop
