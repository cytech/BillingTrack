@extends('layouts.master')

@section('content')

    <script type="text/javascript">
        $(function () {
            $('#name').focus();
        });
    </script>

    @if ($editMode == true)
        {!! Form::model($itemLookup, ['route' => ['itemLookups.update', $itemLookup->id]]) !!}
    @else
        {!! Form::open(['route' => 'itemLookups.store']) !!}
    @endif

    @include('layouts._alerts')
    <section class="content-header">
        <div class="card card-light">
            <div class="card-header">
                <h3 class="card-title"><i
                            class="fa fa-edit fa-fw float-left"></i>
                    @lang('bt.item_lookup_form')
                </h3>
                    <a class="btn btn-warning float-right" href={!! route('itemLookups.index')  !!}><i
                                class="fa fa-ban"></i> @lang('bt.cancel')</a>
                    <button type="submit" class="btn btn-primary float-right"><i
                                class="fa fa-save"></i> @lang('bt.save') </button>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label class="">@lang('bt.name'): </label>
                    {!! Form::text('name', null, ['id' => 'name', 'class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    <label class="">@lang('bt.description'): </label>
                    {!! Form::textarea('description', null, ['id' => 'description', 'rows' => '2', 'class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    <label class="">@lang('bt.price'): </label>
                    {!! Form::text('price', (($editMode) ? $itemLookup->formatted_numeric_price: null), ['id' => 'price', 'class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    <label class="">@lang('bt.tax_1'): </label>
                    {!! Form::select('tax_rate_id', $taxRates, null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    <label class="">@lang('bt.tax_2'): </label>
                    {!! Form::select('tax_rate_2_id', $taxRates, null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    <label class="">@lang('bt.resource_table'): </label>
                    {!! Form::text('resource_table', (($editMode) ? $itemLookup->resource_table: null), ['class' => 'form-control', 'readonly' => true]) !!}
                </div>
                <div class="form-group">
                    <label class="">@lang('bt.resource_id'): </label>
                    {!! Form::text('resource_id', (($editMode) ? $itemLookup->resource_id: null), ['class' => 'form-control', 'readonly' => true]) !!}
                </div>
            </div>
        </div>
    </section>

    {!! Form::close() !!}
@stop
