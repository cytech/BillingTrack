@extends('layouts.master')

@section('content')
    {{--{!! Form::wobreadcrumbs() !!}--}}
    {{--@include('partials._alerts')--}}
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i
                            class="fa fa-fw fa-table"></i>{{ trans('fi.workorder_settings') }}
                </h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>{{ trans('fi.version') }}</label>
                            {!! Form::text('Version', config('workorder_settings.version'), ['class' => 'form-control' , 'readonly' => 'true']) !!}
                        </div>
                    </div>
                </div>
                {!! Form::open(['route' => 'workorders.settings.update']) !!}
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>{{ trans('fi.enable_scheduler') }}</label>
                            {!! Form::select('scheduler', [0=>trans('fi.no'),1=>trans('fi.yes')], config('workorder_settings.scheduler'),
                                            ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>{{ trans('fi.restolup') }} </label>
                            {!! Form::select('restolup', [0=>trans('fi.no'),1=>trans('fi.yes')], config('workorder_settings.restolup'),
                                            ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>{{ trans('fi.emptolup') }} </label>
                            {!! Form::select('emptolup', [0=>trans('fi.no'),1=>trans('fi.yes')], config('workorder_settings.emptolup'),
                                            ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <a href="{{action('FI\Modules\Workorders\Controllers\ResourceController@forceLUTupdate',['ret' => 0])}}"
                               class="btn btn-warning">{{ trans('fi.force_resource_update') }}</a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <a href="{{action('FI\Modules\Workorders\Controllers\EmployeeController@forceLUTupdate',['ret' => 0])}}"
                               class="btn btn-warning">{{ trans('fi.force_employee_update') }}</a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>{{ trans('fi.legacycal') }}</label>
                            {!! Form::select('enableLegacyCalendar', [0=>trans('fi.no'),1=>trans('fi.yes')], config('workorder_settings.enableLegacyCalendar'),
                                            ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>{{ trans('fi.legacyscript') }} </label>
                            {!! Form::text('legacyCalendarScript', config('workorder_settings.legacyCalendarScript'),
                                            ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>{{ trans('fi.wotemplate') }}: </label>
                            {!! Form::select('workorderTemplate', $workorderTemplates,  config('workorder_settings.workorderTemplate'), ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>{{ trans('fi.wogroup') }}: </label>
                            {!! Form::select('workorderGroup', $groups, config('workorder_settings.workorderGroup'), ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>{{ trans('fi.woexpires') }}: </label>
                            {!! Form::text('workorderExpires', config('workorder_settings.workorderExpires'), ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>{{ trans('fi.wodefaultstatusfilter') }}: </label>
                            {!! Form::select('statusFilter', $workorderStatuses, config('workorder_settings.statusFilter'), ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>{{ trans('fi.convwosetting') }}: </label>
                    {!! Form::select('convertWorkorderTerms', $convertWorkorderOptions, config('workorder_settings.convertWorkorderTerms'), ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    <label>{{ trans('fi.default_terms') }}: </label>
                    {!! Form::textarea('workorderTerms', config('workorder_settings.workorderTerms'), ['class' => 'form-control', 'rows' => 5]) !!}
                </div>

                <div class="form-group">
                    <label>{{ trans('fi.default_footer') }}: </label>
                    {!! Form::textarea('workorderFooter', config('workorder_settings.workorderFooter'), ['class' => 'form-control', 'rows' => 5]) !!}
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>{{ trans('fi.wo_timesheet_companyname') }}</label>
                            {!! Form::text('tsCompanyName', config('workorder_settings.tsCompanyName'),
                                            ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>{{ trans('fi.wo_timesheet_companycreatetime') }} </label>
                            {!! Form::text('tsCompanyCreate', config('workorder_settings.tsCompanyCreate'),
                                            ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div style="text-align:center" class="buttons">
            <a class="btn btn-warning btn-lg" href={!! route('workorders.dashboard')  !!}>{{ trans('fi.cancel') }} <span
                        class="glyphicon glyphicon-remove-circle"></span></a>
            <button type="submit" class="btn btn-success btn-lg">{{ trans('fi.save') }} <span
                        class="glyphicon glyphicon-floppy-disk"></span></button>
            {{--{!! Button::normal(trans('texts.cancel'))
                    ->large()
                    ->asLinkTo(URL::previous())
                    ->appendIcon(Icon::create('remove-circle')) !!}

            {!! Button::success('Save')
                    ->submit()
                    ->large()
                    ->appendIcon(Icon::create('floppy-disk')) !!}--}}
        </div>
        {!! Form::close() !!}
    </div>

@stop