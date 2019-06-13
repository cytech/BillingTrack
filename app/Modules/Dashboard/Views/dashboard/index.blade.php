@extends('layouts.master')

@section('content')

    @include('layouts._alerts')

    <section class="content-header">
        <h1>@lang('bt.dashboard')</h1>
    </section>
    <div class="container-fluid">
        <div class="row">
            @foreach ($widgets as $widget)
                @if (config('bt.widgetEnabled' . $widget))
                    <div class="col-md-{{ config('bt.widgetColumnWidth' . $widget) }} col-sm-12">
                        @include($widget . 'Widget')
                    </div>
                @endif
            @endforeach
        </div>
    </div>
@stop
