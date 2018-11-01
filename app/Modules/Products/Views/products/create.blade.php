@extends('layouts.master')

@section('content')
    <!--basic form starts-->
    {{--{!! Form::wobreadcrumbs() !!}--}}
    @include('layouts._alerts')
    <div class="container-fluid mt-2">
        {!! Form::open(['route' => 'products.store', 'class'=>'form-horizontal']) !!}
        
        <div class="card card-light">
            <div class="card-header">
                <h3 class="card-title">
                    {{ trans('fi.create_product') }}
                    <a class="btn btn-warning float-right" href={!! route('products.index')  !!}><i
                                class="fa fa-ban"></i> {{ trans('fi.cancel') }}</a>
                    <button type="submit" class="btn btn-primary float-right"><i
                                class="fa fa-save"></i> {{ trans('fi.save') }} </button>
                </h3>

            </div>
            <div class="card-body">
            <!-- Name input-->
                <div class="form-group d-flex align-items-center">
                    <label class="col-md-2 text-right text"
                           for="name">{{ trans('fi.product_name') }}</label>
                    <div class="col-md-4">
                        {!! Form::text('name',old('name'),['id'=>'name', 'class'=>'form-control']) !!}
                    </div>
                </div>
                <!-- Description input-->
                <div class="form-group d-flex align-items-center">
                    <label class="col-md-2 text-right text"
                           for="description">{{ trans('fi.product_description') }}</label>
                    <div class="col-md-4">
                        {!! Form::text('description',old('description'),['id'=>'description','class'=>'form-control']) !!}
                    </div>
                </div>
                <!-- Serial Number input-->
                <div class="form-group d-flex align-items-center">
                    <label class="col-md-2 text-right text"
                           for="serialnum">{{ trans('fi.product_serialnum') }}</label>
                    <div class="col-md-4">
                        {!! Form::text('serialnum',old('serialnum'),['id'=>'serialnum', 'class'=>'form-control']) !!}
                    </div>
                </div>
                <!-- Active Checkbox-->
                <div class="form-group d-flex align-items-center">
                    <label class="col-md-2 text-right text"
                           for="active">{{ trans('fi.product_active') }}</label>
                    <div class="col-md-4">
                        {!! Form::checkbox('active',1,old('active'),['id'=>'active', 'class'=>'checkbox']) !!}
                    </div>
                </div>
                <!-- Cost input-->
                <div class="form-group d-flex align-items-center">
                    <label class="col-md-2 text-right text"
                           for="cost">{{ trans('fi.product_cost') }}</label>
                    <div class="col-md-4">
                        {!! Form::text('cost',old('cost'),['id'=>'cost', 'class'=>'form-control']) !!}
                    </div>
                </div>
                <!-- Category input-->
                <div class="form-group d-flex align-items-center">
                    <label class="col-md-2 text-right text"
                           for="category">{{ trans('fi.product_category') }}</label>
                    <div class="col-md-4">
                        {!! Form::text('category',old('category'),['id'=>'category','class'=>'form-control']) !!}
                    </div>
                </div>
                <!-- Type input-->
                <div class="form-group d-flex align-items-center">
                    <label class="col-md-2 text-right text"
                           for="type">{{ trans('fi.product_type') }}</label>
                    <div class="col-md-4">
                        {!! Form::text('type',old('type'),['id'=>'type', 'class'=>'form-control']) !!}
                    </div>
                </div>
                <!-- Numstock input-->
                <div class="form-group d-flex align-items-center">
                    <label class="col-md-2 text-right text"
                           for="numstock">{{ trans('fi.product_numstock') }}</label>
                    <div class="col-md-4">
                        {!! Form::text('numstock',old('numstock'),['id'=>'numstock','class'=>'form-control']) !!}
                    </div>
                </div>
            </div>
        </div>
     
        {!! Form::close() !!}
    </div>
@stop