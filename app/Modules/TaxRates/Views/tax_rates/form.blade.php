@extends('layouts.master')

@section('content')

    <script type="text/javascript">
        $(function () {
            $('#name').focus();
        });
    </script>

    @if ($editMode == true)
        {!! Form::model($taxRate, ['route' => ['taxRates.update', $taxRate->id]]) !!}
    @else
        {!! Form::open(['route' => 'taxRates.store']) !!}
    @endif

    <section class="content-header">
        <h3 class="float-left">
            @lang('bt.tax_rate_form')
        </h3>
        <a class="btn btn-warning float-right" href={!! route('taxRates.index')  !!}><i
                    class="fa fa-ban"></i> @lang('bt.cancel')</a>
        <button type="submit" class="btn btn-primary float-right"><i
                    class="fa fa-save"></i> @lang('bt.save') </button>
        <div class="clearfix"></div>
    </section>

    <section class="container-fluid">

        @include('layouts._alerts')
        @if ($editMode and $taxRate->in_use)
            <div class="alert alert-warning">@lang('bt.cannot_edit_record_in_use')</div>
        @endif

        <div class=" card card-light">
            <div class="card-body">
                <div class="form-group">
                    <label>@lang('bt.tax_rate_name'): </label>
                    {!! Form::text('name', null, ['id' => 'name', 'class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    <label>@lang('bt.tax_rate_percent'): </label>
                    @if ($editMode and $taxRate->in_use)
                        {!! Form::text('percent', (($editMode) ? $taxRate->formatted_numeric_percent : null),
                        ['id' => 'percent', 'class' => 'form-control', 'readonly' => 'readonly']) !!}
                    @else
                        {!! Form::text('percent', (($editMode) ? $taxRate->formatted_numeric_percent : null),
                        ['id' => 'percent', 'class' => 'form-control']) !!}
                    @endif
                </div>
                <div class="form-group">
                    <label>@lang('bt.calculate_as_vat_gst'):</label>
                    @if ($editMode and $taxRate->in_use)
                        {!! Form::select('calculate_vat', ['0' => trans('bt.no'), '1' => trans('bt.yes')],
                        null, ['class' => 'form-control', 'readonly' => 'readonly', 'disabled' =>
                        'disabled']) !!}
                    @else
                        {!! Form::select('calculate_vat', ['0' => trans('bt.no'), '1' => trans('bt.yes')],
                        null, ['class' => 'form-control']) !!}
                    @endif
                </div>
                <div class="form-group">
                    <label>@lang('bt.compound'):</label>
                    @if ($editMode and $taxRate->in_use)
                        {!! Form::select('is_compound', ['0' => trans('bt.no'), '1' => trans('bt.yes')],
                        null, ['class' => 'form-control', 'readonly' => 'readonly', 'disabled' =>
                        'disabled']) !!}
                    @else
                        {!! Form::select('is_compound', ['0' => trans('bt.no'), '1' => trans('bt.yes')],
                        null, ['class' => 'form-control']) !!}
                    @endif
                    <span class="form-text text-muted">@lang('bt.compound_tax_note')</span>
                </div>
            </div>
        </div>
    </section>

    {!! Form::close() !!}
@stop
