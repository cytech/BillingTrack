@extends('layouts.master')

@section('content')
    {{--@include('partials._alerts')--}}
{{--{!! Form::wobreadcrumbs() !!}--}}
    <div class="col-lg-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    {{ trans('fi.getdates',['name' => $title]) }}
                </h3>
            </div>
            <div class="panel-body">
                <div class="modal-body">
                    <div id="modal-status-placeholder"></div>
                    @if($title == 'BatchPrint')
                        {!! Form::open(['route' => 'workorders.batchprint', 'class'=>'form-horizontal']) !!}
                        <div class="form-group">
                            <label class="col-sm-4 control-label">{{ trans('fi.start_date') }}</label>
                            <div class="col-sm-4">
                                {!! Form::date('start_date', date('Y-m-d') , ['id' => 'start_date', 'class' => 'form-control input-sm']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">{{ trans('fi.end_date') }}</label>
                            <div class="col-sm-4">
                                {!! Form::date('end_date', date('Y-m-d'), ['id' => 'end_date', 'class' => 'form-control']) !!}
                            </div>
                        </div>
                    @else
                        {!! Form::open(['route' => 'timesheets.index', 'class'=>'form-horizontal']) !!}
                        <div class="form-group">
                            <label class="col-sm-4 control-label">{{ trans('fi.start_date') }}</label>
                            <div class="col-sm-4">
                                {!! Form::date('start_date', $start_date , ['id' => 'start_date', 'class' => 'form-control input-sm']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">{{ trans('fi.end_date') }}</label>
                            <div class="col-sm-4">
                                {!! Form::date('end_date', $end_date, ['id' => 'end_date', 'class' => 'form-control']) !!}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div style="text-align:center" class="buttons">
            <div class="col-md-12 text-center">
                <a class="btn btn-warning btn-lg" href={!! route('workorders.dashboard')  !!}>{{ trans('fi.cancel') }} <span
                            class="glyphicon glyphicon-remove-circle"></span></a>
                <button type="submit" class="btn btn-success btn-lg">{{ trans('fi.process') }} <span
                            class="glyphicon glyphicon-floppy-disk"></span></button>
            </div>
        </div>

        {!! Form::close() !!}
    </div>
@stop
