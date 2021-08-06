@extends('layouts.master')

@section('content')
    <!--basic form starts-->
    {{--{!! Form::wobreadcrumbs() !!}--}}
    @include('layouts._alerts')
    <section class="content-header">
        {!! Form::model($products, array('route' => array('products.update', $products->id),
                                                       'id'=>'products_form','action'=>'#','method' => 'PUT', 'class'=>'form-horizontal', 'autocomplete'=>'off')) !!}

        <div class="card card-light">
            <div class="card-header">
                <h3 class="card-title"><i
                            class="fa fa-edit fa-fw float-left"></i>
                    @lang('bt.edit_product')
                </h3>
                    <a class="btn btn-warning float-right" href="{{ $returnUrl }}"><i
                                class="fa fa-ban"></i> @lang('bt.cancel')</a>
                    <button type="submit" class="btn btn-primary float-right"><i
                                class="fa fa-save"></i> @lang('bt.save') </button>
            </div>
            <div class="card-body">

                <!-- Name input-->
                <div class="form-group d-flex align-items-center">
                    <label class="col-sm-2 text-right text"
                           for="name">@lang('bt.product_name')</label>
                    <div class="col-md-4">
                        {!! Form::text('name',$products->name,['id'=>'name', 'class'=>'form-control']) !!}
                    </div>
                </div>

                <!-- Description input-->
                <div class="form-group d-flex align-items-center">
                    <label class="col-sm-2 text-right text"
                           for="description">@lang('bt.product_description')</label>
                    <div class="col-md-4">
                        {!! Form::text('description',$products->description,['id'=>'description', 'class'=>'form-control']) !!}
                    </div>
                </div>
                <!-- Serial Number input-->
                <div class="form-group d-flex align-items-center">
                    <label class="col-sm-2 text-right text"
                           for="serialnum">@lang('bt.product_partnum')</label>
                    <div class="col-md-4">
                        {!! Form::text('serialnum',$products->serialnum,['id'=>'serialnum', 'class'=>'form-control']) !!}
                    </div>
                </div>
                <!-- Sales Price input-->
                <div class="form-group d-flex align-items-center">
                    <label class="col-sm-2 text-right text"
                           for="price">@lang('bt.price_sales')</label>
                    <div class="col-md-4">
                        {!! Form::text('price',$products->price,['id'=>'price', 'class'=>'form-control']) !!}
                    </div>
                </div>
                <!-- Active Checkbox-->
                <div class="form-group d-flex align-items-center">
                    <label class="col-sm-2 text-right text"
                           for="active">@lang('bt.product_active')</label>
                    <div class="col-md-4">
                        {!! Form::checkbox('active',1,$products->active,['id'=>'active', 'class'=>'checkbox']) !!}
                    </div>
                </div>
                <!-- Preferred Vendor input-->
                <div class="form-group d-flex align-items-center">
                    <label class="col-sm-2 text-right text"
                           for="vendor">@lang('bt.vendor_preferred')</label>
                    <div class="col-md-4">
                        {!! Form::text('vendor',($products->vendor) ? $products->vendor->name : '',['id'=>'vendor', 'class'=>'form-control','list'=>'vendlistid']) !!}
                        <datalist id='vendlistid'>
                            @foreach($vendors as $vendor)
                                <option>{!! $vendor !!}</option>
                            @endforeach
                        </datalist>
                    </div>
                </div>
                <!-- Cost input-->
                <div class="form-group d-flex align-items-center">
                    <label class="col-sm-2 text-right text"
                           for="cost">@lang('bt.product_cost')</label>
                    <div class="col-md-4">
                        {!! Form::text('cost',$products->cost,['id'=>'cost', 'class'=>'form-control']) !!}
                    </div>
                </div>
                <!-- Category input-->
                <div class="form-group d-flex align-items-center">
                    <label class="col-sm-2 text-right text"
                           for="category">@lang('bt.product_category')</label>
                    <div class="col-md-4">
                        {!! Form::text('category',($products->category) ? $products->category->name : '',['id'=>'category', 'class'=>'form-control','list'=>'prodlistid' ]) !!}
                        <datalist id='prodlistid'>
                            @foreach($categories as $category)
                                <option>{!! $category !!}</option>
                            @endforeach
                        </datalist>
                    </div>
                </div>
                <!-- Type input-->
                <div class="form-group d-flex align-items-center">
                    <label class="col-sm-2 text-right text"
                           for="type">@lang('bt.product_type')</label>
                    <div class="col-md-4">
                        {!! Form::select('type', $inventorytypes, $products->inventorytype ? $products->inventorytype->id : 1,
                                        ['id'=>'type', 'class'=>'form-control'], $optionAttributes) !!}
                    </div>
                </div>
                <!-- Numstock input-->
                <div class="form-group d-flex align-items-center">
                    <label class="col-sm-2 text-right text"
                           for="numstock">@lang('bt.product_numstock')</label>
                    <div class="col-md-4">
                        {!! Form::text('numstock',$products->numstock,['id'=>'numstock', 'class'=>'form-control']) !!}
                    </div>
                </div>
                <!-- taxrate inputs-->
                <div class="form-group d-flex align-items-center">
                    <label class="col-md-2 text-right text">@lang('bt.tax_1'): </label>
                    <div class="col-md-4">
                        {!! Form::select('tax_rate_id', $taxRates, null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group d-flex align-items-center">
                    <label class="col-md-2 text-right text">@lang('bt.tax_2'): </label>
                    <div class="col-md-4">
                        {!! Form::select('tax_rate_2_id', $taxRates, null, ['class' => 'form-control']) !!}
                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </section>
@stop
