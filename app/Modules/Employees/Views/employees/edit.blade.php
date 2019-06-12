@extends('layouts.master')

@section('content')
    <!--basic form starts-->
    {{--{!! Form::wobreadcrumbs() !!}--}}
    @include('layouts._alerts')
    <section class="content-header">
        {!! Form::model($employees, array('route' => array('employees.update', $employees->id),
                                                        'id'=>'employees_form','action'=>'#','method' => 'PUT', 'class'=>'form-horizontal')) !!}

        <div class="card card-light">
            <div class="card-header">
                <h3 class="card-title"><i
                            class="fa fa-edit fa-fw"></i>
                    @lang('fi.edit_employee')
                    <a class="btn btn-warning float-right" href={!! route('employees.index')  !!}><i
                                class="fa fa-ban"></i> @lang('fi.cancel')</a>
                    <button type="submit" class="btn btn-primary float-right"><i
                                class="fa fa-save"></i> @lang('fi.save') </button>
                </h3>
            </div>
            <div class="card-body">
                <!-- Employee Number input-->
                <div class="form-group d-flex align-items-center">
                    <label class="col-sm-1 text-right text"
                           for="number">@lang('fi.employee_number')</label>
                    <div class="col-md-4">
                        {!! Form::text('number',$employees->number,['id'=>'number', 'class'=>'form-control']) !!}
                    </div>
                </div>
                <!-- First Name input-->
                <div class="form-group d-flex align-items-center">
                    <label class="col-sm-1 text-right text"
                           for="first_name">@lang('fi.employee_first_name')</label>
                    <div class="col-md-4">
                        {!! Form::text('first_name',$employees->first_name,['id'=>'first_name', 'class'=>'form-control']) !!}
                    </div>
                </div>
                <!-- Last Name input-->
                <div class="form-group d-flex align-items-center">
                    <label class="col-sm-1 text-right text"
                           for="last_name">@lang('fi.employee_last_name')</label>
                    <div class="col-md-4">
                        {!! Form::text('last_name',$employees->last_name,['id'=>'last_name', 'class'=>'form-control']) !!}
                    </div>
                </div>
                <!-- Title input-->
                <div class="form-group d-flex align-items-center">
                    <label class="col-sm-1 text-right text"
                           for="title">@lang('fi.employee_title')</label>
                    <div class="col-md-4">
                        {!! Form::text('title',$employees->title,['id'=>'title', 'class'=>'form-control',
                        'list'=>'listid']) !!}
                        <datalist id='listid'>
                            @foreach($titles as $title)
                                <option>{!! $title !!}</option>
                            @endforeach

                        </datalist>
                    </div>
                </div>
                <!-- Billing Rate input-->
                <div class="form-group d-flex align-items-center">
                    <label class="col-sm-1 text-right text"
                           for="billing_rate">@lang('fi.employee_billing_rate')</label>
                    <div class="col-md-4">
                        {!! Form::text('billing_rate',$employees->billing_rate,['id'=>'billing_rate', 'class'=>'form-control']) !!}
                    </div>
                </div>
                <!-- Schedule Checkbox-->
                <div class="form-group d-flex align-items-center">
                    <label class="col-sm-1 text-right text"
                           for="schedule">@lang('fi.scheduleable')</label>
                    <div class="col-md-4">
                        {!! Form::checkbox('schedule',1,$employees->schedule,['id'=>'schedule', 'class'=>'checkbox']) !!}
                    </div>
                </div>
                <!-- Active Checkbox-->
                <div class="form-group d-flex align-items-center">
                    <label class="col-sm-1 text-right text"
                           for="active">@lang('fi.employee_active')</label>
                    <div class="col-md-4">
                        {!! Form::checkbox('active',1,$employees->active,['id'=>'active', 'class'=>'checkbox']) !!}
                    </div>
                </div>
                <!-- Driver Checkbox-->
                <div class="form-group d-flex align-items-center">
                    <label class="col-sm-1 text-right text"
                           for="driver">@lang('fi.employee_driver')</label>
                    <div class="col-md-4">
                        {!! Form::checkbox('driver',1,$employees->driver,['id'=>'driver', 'class'=>'checkbox']) !!}
                    </div>
                </div>
            </div>
        </div>

        {!! Form::close() !!}
    </section>
@stop
