@extends('Workorders::partials._master')

@section('content')
    {!! Form::wobreadcrumbs() !!}
    <section class="content">
        {{--@include('Workorders::partials._alerts')--}}
        <div class="col-lg-12">
            <div class="panel panel-info" id="hidepanel1">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        {{ trans('Workorders::texts.timesheettable') }}
                    </h3>
                </div>
                <div class="panel-body">
                    @include('Workorders::timesheets._table')
                </div>

            </div>
        </div>
    </section>
@stop