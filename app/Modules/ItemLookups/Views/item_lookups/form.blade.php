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
    <div class="container-fluid mt-2">
        <div class="card card-light">
            <div class="card-header">
                <h3 class="card-title">
                    @lang('fi.item_lookup_form')
                    <a class="btn btn-warning float-right" href={!! route('itemLookups.index')  !!}><i
                                class="fa fa-ban"></i> @lang('fi.cancel')</a>
                    <button type="submit" class="btn btn-primary float-right"><i
                                class="fa fa-save"></i> @lang('fi.save') </button>
                </h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label class="">@lang('fi.name'): </label>
                    {!! Form::text('name', null, ['id' => 'name', 'class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    <label class="">@lang('fi.description'): </label>
                    {!! Form::textarea('description', null, ['id' => 'description', 'rows' => '2', 'class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    <label class="">@lang('fi.price'): </label>
                    {!! Form::text('price', (($editMode) ? $itemLookup->formatted_numeric_price: null), ['id' => 'price', 'class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    <label class="">@lang('fi.tax_1'): </label>
                    {!! Form::select('tax_rate_id', $taxRates, null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    <label class="">@lang('fi.tax_2'): </label>
                    {!! Form::select('tax_rate_2_id', $taxRates, null, ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>
    </div>

    {!! Form::close() !!}
@stop