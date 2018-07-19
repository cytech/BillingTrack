@extends('layouts.master')

@section('content')
    <!--basic form starts-->
    {{--{!! Form::wobreadcrumbs() !!}--}}
    @include('layouts._alerts')
    <div class="col-lg-12">
        <div class="panel panel-info" id="hidepanel1">
            <div class="panel-heading">
                <h3 class="panel-title">
                    {{ trans('fi.edit_employee') }}
                </h3>
            </div>
            <div class="panel-body">
            {!! Form::model($employees, array('route' => array('employees.update', $employees->id),
                                                        'id'=>'employees_form','action'=>'#','method' => 'PUT', 'class'=>'form-horizontal')) !!}
            <!-- Employee Number input-->
                <div class="form-group">
                    <label class="col-md-3 control-label"
                           for="number">{{ trans('fi.employee_number') }}</label>
                    <div class="col-md-3">
                        {!! Form::text('number',$employees->number,['id'=>'number', 'class'=>'form-control']) !!}
                    </div>
                </div>
                <!-- First Name input-->
                <div class="form-group">
                    <label class="col-md-3 control-label"
                           for="first_name">{{ trans('fi.employee_first_name') }}</label>
                    <div class="col-md-3">
                        {!! Form::text('first_name',$employees->first_name,['id'=>'first_name', 'class'=>'form-control']) !!}
                    </div>
                </div>
                <!-- Last Name input-->
                <div class="form-group">
                    <label class="col-md-3 control-label"
                           for="last_name">{{ trans('fi.employee_last_name') }}</label>
                    <div class="col-md-3">
                        {!! Form::text('last_name',$employees->last_name,['id'=>'last_name', 'class'=>'form-control']) !!}
                    </div>
                </div>
                <!-- Title input-->
                <div class="form-group">
                    <label class="col-md-3 control-label"
                           for="title">{{ trans('fi.employee_title') }}</label>
                    <div class="col-md-3">
                        {!! Form::text('title',$employees->title,['id'=>'title', 'class'=>'form-control',
                        'list'=>'listid']) !!}
                        <datalist id='listid'>
                            <option value='{{ trans('fi.worker') }}'>
                            <option value='{{ trans('fi.manager') }}'>
                            <option value='{{ trans('fi.director') }}'>
                            <option value='{{ trans('fi.driver') }}'>
                            <option value='{{ trans('fi.consultant') }}'>
                            <option value='{{ trans('fi.accountant') }}'>
                            <option value='{{ trans('fi.sales') }}'>
                            <option value='{{ trans('fi.technician') }}'>
                        </datalist>
                    </div>
                </div>
                <!-- Billing Rate input-->
                <div class="form-group">
                    <label class="col-md-3 control-label"
                           for="billing_rate">{{ trans('fi.employee_billing_rate') }}</label>
                    <div class="col-md-3">
                        {!! Form::text('billing_rate',$employees->billing_rate,['id'=>'billing_rate', 'class'=>'form-control']) !!}
                    </div>
                </div>
                <!-- Schedule Checkbox-->
                <div class="form-group">
                    <label class="col-md-3 control-label"
                           for="schedule">{{ trans('fi.scheduleable') }}</label>
                    <div class="col-md-3">
                        {!! Form::checkbox('schedule',1,$employees->schedule,['id'=>'schedule', 'class'=>'checkbox']) !!}
                    </div>
                </div>
                <!-- Active Checkbox-->
                <div class="form-group">
                    <label class="col-md-3 control-label"
                           for="active">{{ trans('fi.employee_active') }}</label>
                    <div class="col-md-3">
                        {!! Form::checkbox('active',1,$employees->active,['id'=>'active', 'class'=>'checkbox']) !!}
                    </div>
                </div>
                <!-- Driver Checkbox-->
                <div class="form-group">
                    <label class="col-md-3 control-label"
                           for="driver">{{ trans('fi.employee_driver') }}</label>
                    <div class="col-md-3">
                        {!! Form::checkbox('driver',1,$employees->driver,['id'=>'driver', 'class'=>'checkbox']) !!}
                    </div>
                </div>
            </div>
        </div>
        <div style="text-align:center" class="buttons">
            <a class="btn btn-warning btn-lg" href={!! route('employees.index')  !!}>{{ trans('fi.cancel') }} <span
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