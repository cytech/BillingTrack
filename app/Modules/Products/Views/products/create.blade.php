@extends('layouts.master')

@section('content')
    <!--basic form starts-->
    {{--{!! Form::wobreadcrumbs() !!}--}}
    @include('layouts._alerts')
    <section class="content-header">
        {!! Form::open(['route' => 'products.store', 'class'=>'form-horizontal', 'autocomplete'=>'off']) !!}

        <div class="card card-light">
            <div class="card-header">
                <h3 class="card-title"><i
                            class="fa fa-edit fa-fw"></i>
                    @lang('fi.create_product')
                    <a class="btn btn-warning float-right" href={!! route('products.index')  !!}><i
                                class="fa fa-ban"></i> @lang('fi.cancel')</a>
                    <button type="submit" class="btn btn-primary float-right"><i
                                class="fa fa-save"></i> @lang('fi.save') </button>
                </h3>

            </div>
            <div class="card-body">
            <!-- Name input-->
                <div class="form-group d-flex align-items-center">
                    <label class="col-md-2 text-right text"
                           for="name">@lang('fi.product_name')</label>
                    <div class="col-md-4">
                        {!! Form::text('name',old('name'),['id'=>'name', 'class'=>'form-control']) !!}
                    </div>
                </div>
                <!-- Description input-->
                <div class="form-group d-flex align-items-center">
                    <label class="col-md-2 text-right text"
                           for="description">@lang('fi.product_description')</label>
                    <div class="col-md-4">
                        {!! Form::text('description',old('description'),['id'=>'description','class'=>'form-control']) !!}
                    </div>
                </div>
                <!-- Serial Number input-->
                <div class="form-group d-flex align-items-center">
                    <label class="col-md-2 text-right text"
                           for="serialnum">@lang('fi.product_partnum')</label>
                    <div class="col-md-4">
                        {!! Form::text('serialnum',old('serialnum'),['id'=>'serialnum', 'class'=>'form-control']) !!}
                    </div>
                </div>
                <!-- Sales Price input-->
                <div class="form-group d-flex align-items-center">
                    <label class="col-sm-2 text-right text"
                           for="price">@lang('fi.price_sales')</label>
                    <div class="col-md-4">
                        {!! Form::text('price',old('price'),['id'=>'price', 'class'=>'form-control']) !!}
                    </div>
                </div>
                <!-- Active Checkbox-->
                <div class="form-group d-flex align-items-center">
                    <label class="col-md-2 text-right text"
                           for="active">@lang('fi.product_active')</label>
                    <div class="col-md-4">
                        {!! Form::checkbox('active',1,old('active'),['id'=>'active', 'class'=>'checkbox']) !!}
                    </div>
                </div>
                <!-- Vendor input-->
                <div class="form-group d-flex align-items-center">
                    <label class="col-md-2 text-right text"
                           for="vendor">@lang('fi.vendor_preferred')</label>
                    <div class="col-md-4">
                        {!! Form::text('vendor',old('vendor'),['id'=>'vendor','class'=>'form-control','list'=>'vendlistid']) !!}
                        <datalist id='vendlistid'>
                            @foreach($vendors as $vendor)
                                <option>{!! $vendor !!}</option>
                            @endforeach
                        </datalist>
                    </div>
                </div>
                <!-- Cost input-->
                <div class="form-group d-flex align-items-center">
                    <label class="col-md-2 text-right text"
                           for="cost">@lang('fi.product_cost')</label>
                    <div class="col-md-4">
                        {!! Form::text('cost',old('cost'),['id'=>'cost', 'class'=>'form-control']) !!}
                    </div>
                </div>
                <!-- Category input-->
                <div class="form-group d-flex align-items-center">
                    <label class="col-md-2 text-right text"
                           for="category">@lang('fi.product_category')</label>
                    <div class="col-md-4">
                        {!! Form::text('category',old('category'),['id'=>'category','class'=>'form-control','list'=>'prodlistid']) !!}
                        <datalist id='prodlistid'>
                            @foreach($categories as $category)
                                <option>{!! $category !!}</option>
                            @endforeach
                        </datalist>
                    </div>
                </div>
                <!-- Type input-->
                <div class="form-group d-flex align-items-center">
                    <label class="col-md-2 text-right text"
                           for="type">@lang('fi.product_type')</label>
                    <div class="col-md-4">
                        {!! Form::text('type',old('type'),['id'=>'type', 'class'=>'form-control']) !!}
                    </div>
                </div>
                <!-- Numstock input-->
                <div class="form-group d-flex align-items-center">
                    <label class="col-md-2 text-right text"
                           for="numstock">@lang('fi.product_numstock')</label>
                    <div class="col-md-4">
                        {!! Form::text('numstock',old('numstock'),['id'=>'numstock','class'=>'form-control']) !!}
                    </div>
                </div>
            </div>
        </div>

        {!! Form::close() !!}
    </section>
@stop
