@extends('layouts.master')

@section('content')
    <!--basic form starts-->
    {{--{!! Form::wobreadcrumbs() !!}--}}
    @include('layouts._alerts')
    <section class="content-header">
        {!! Form::open(['route' => 'employees.store', 'class'=>'form-horizontal']) !!}

        <div class="card card-light">
            <div class="card-header">
                <h3 class="card-title"><i
                            class="fa fa-edit fa-fw float-left"></i>
                    @lang('bt.create_employee')
                </h3>
                    <a class="btn btn-warning float-right" href="{{ $returnUrl }}"><i
                                class="fa fa-ban"></i> @lang('bt.cancel')</a>
                    <button type="submit" class="btn btn-primary float-right"><i
                                class="fa fa-save"></i> @lang('bt.save') </button>
            </div>
            <div class="card-body">
                <!-- Employee Number input-->
                <div class="form-group d-flex align-items-center">
                    <label class="col-sm-2 text-right text"
                           for="number">@lang('bt.employee_number')</label>
                    <div class="col-md-4">
                        {!! Form::text('number',old('number'),['id'=>'number', 'class'=>'form-control']) !!}
                    </div>
                </div>
                <!-- First Name input-->
                <div class="form-group d-flex align-items-center">
                    <label class="col-sm-2 text-right text"
                           for="first_name">@lang('bt.employee_first_name')</label>
                    <div class="col-md-4">
                        {!! Form::text('first_name',old('first_name'),['id'=>'first_name', 'class'=>'form-control']) !!}
                    </div>
                </div>
                <!-- Last Name input-->
                <div class="form-group d-flex align-items-center">
                    <label class="col-sm-2 text-right text"
                           for="last_name">@lang('bt.employee_last_name')</label>
                    <div class="col-md-4">
                        {!! Form::text('last_name',old('last_name'),['id'=>'last_name', 'class'=>'form-control']) !!}
                    </div>
                </div>
                <!-- Title input-->
                <div class="form-group d-flex align-items-center">
                    <label class="col-sm-2 text-right text"
                           for="title">@lang('bt.employee_title')</label>
                    <div class="col-md-4">
                        {!! Form::text('title',old('title'),['id'=>'title', 'class'=>'form-control','list'=>'listid']) !!}
                        <datalist id='listid'>
                            @foreach($titles as $title)
                                <option>{!! $title !!}</option>
                            @endforeach
                        </datalist>
                    </div>
                </div>
                <!-- Billing Rate input-->
                <div class="form-group d-flex align-items-center">
                    <label class="col-sm-2 text-right text"
                           for="billing_rate">@lang('bt.employee_billing_rate')</label>
                    <div class="col-md-4">
                        {!! Form::text('billing_rate',old('billing_rate'),['id'=>'billing_rate', 'class'=>'form-control']) !!}
                    </div>
                </div>
                <!-- Schedule Checkbox-->
                <div class="form-group d-flex align-items-center">
                    <label class="col-sm-2 text-right text"
                           for="schedule">@lang('bt.scheduleable')</label>
                    <div class="col-md-4">
                        {!! Form::checkbox('schedule',1,old('schedule'),['id'=>'schedule', 'class'=>'checkbox']) !!}
                    </div>
                </div>
                <!-- Active Checkbox-->
                <div class="form-group d-flex align-items-center">
                    <label class="col-sm-2 text-right text"
                           for="active">@lang('bt.employee_active')</label>
                    <div class="col-md-4">
                        {!! Form::checkbox('active',1,old('active'),['id'=>'active', 'class'=>'checkbox']) !!}
                    </div>
                </div>
                <!-- Driver Checkbox-->
                <div class="form-group d-flex align-items-center">
                    <label class="col-sm-2 text-right text"
                           for="driver">@lang('bt.employee_driver')</label>
                    <div class="col-md-4">
                        {!! Form::checkbox('driver',1,old('driver'),['id'=>'driver', 'class'=>'checkbox']) !!}
                    </div>
                </div>
            </div>
        </div>

        {!! Form::close() !!}
    </section>
@stop
