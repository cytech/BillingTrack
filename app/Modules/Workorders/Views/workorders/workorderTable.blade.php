@extends('Workorders::partials._master')

@section('javascript')
    @include('Workorders::workorders.partials._js_index')
    {{--@include('Workorders::partials._alerts')--}}
@stop

@section('content')
    <section class="content-header">
        {{--<h1 class="pull-left">{{ trans('Workorders::texts.workorders') }}</h1>--}}
        <div class="pull-left">{!! Form::wobreadcrumbs() !!}</div>
        <div class="pull-right">
            <div class="btn-group bulk-actions">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"
                        aria-expanded="false">
                    {{ trans('fi.change_status') }} <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    @foreach ($keyedStatuses as $key => $status)
                        <li><a href="javascript:void(0)" class="bulk-change-status"
                               data-status="{{ $key }}">{{ $status }}</a></li>
                    @endforeach
                </ul>
            </div>
            <a href="javascript:void(0)" class="btn btn-default bulk-actions" id="btn-bulk-delete"><i
                        class="fa fa-trash"></i> {{ trans('Workorders::texts.trash') }}</a>
            <div class="btn-group">
                {!! Form::open(['method' => 'GET', 'id' => 'filter']) !!}
                {!! Form::select('company_profile', $companyProfiles, request('company_profile'), ['class' => 'workorder_filter_options form-control inline']) !!}
                {!! Form::select('status', $statuses, request('status'), ['class' => 'workorder_filter_options form-control inline']) !!}
                {!! Form::close() !!}
            </div>
            <a href="javascript:void(0)" class="btn btn-primary create-workorder"><i class="fa fa-plus"></i> {{ trans('Workorders::texts.create_workorder') }}</a>
        </div>
        <div class="clearfix"></div>
    </section>
    <section class="content">
        {{--@include('Workorders::partials._alerts')--}}
        <div class="col-lg-12">
            <div class="panel panel-info" id="hidepanel1">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        {{ trans('Workorders::texts.workorder_table') }}
                    </h3>
                </div>
                <div class="panel-body">
                    @include('Workorders::workorders.partials._table')
                </div>
            </div>
            {{--<div class="pull-right">
                {!! $workorders->appends(Input::except('page'))->render() !!}
            </div>--}}
        </div>
    </section>

@stop