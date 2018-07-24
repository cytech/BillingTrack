@extends('layouts.master')

@section('content')
    {{--{!! Form::wobreadcrumbs() !!}--}}
    <section class="content">
        {{--@include('partials._alerts')--}}
        <div class="col-lg-12">
            <div class="panel panel-info" id="hidepanel1">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        {{ trans('fi.timesheettable') }}
                    </h3>
                </div>
                <div class="panel-body">
                    @include('timesheets._table')
                </div>

            </div>
        </div>
    </section>
@stop