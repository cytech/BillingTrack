@extends('layouts.master')

@section('content')

    <script type="text/javascript">
        $(function () {
            $('#name').focus();
        });
    </script>

    @if ($editMode == true)
        {!! Form::model($currency, ['route' => ['currencies.update', $currency->id]]) !!}
    @else
        {!! Form::open(['route' => 'currencies.store']) !!}
    @endif

    <section class="content m-3">
        <h3 class="float-left">
            {{ trans('fi.currency_form') }}
        </h3>
            <a class="btn btn-warning float-right" href={!! route('currencies.index')  !!}><i
                        class="fa fa-ban"></i> {{ trans('fi.cancel') }}</a>
            <button type="submit" class="btn btn-primary float-right"><i
                        class="fa fa-save"></i> {{ trans('fi.save') }} </button>
        <div class="clearfix"></div>
    </section>

    <section class="container-fluid">

        @include('layouts._alerts')


        <div class="card card-light">

            <div class="card-body">

                <div class="form-group">
                    <label>{{ trans('fi.name') }}: </label>
                    {!! Form::text('name', null, ['id' => 'name', 'class' => 'form-control']) !!}
                    <p class="form-text text-muted">{{ trans('fi.help_currency_name') }}</p>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>{{ trans('fi.code') }}: </label>
                            @if ($editMode and $currency->in_use)
                                {!! Form::text('code', null, ['id' => 'code', 'class' => 'form-control',
                                'readonly' => 'readonly']) !!}
                            @else
                                {!! Form::text('code', null, ['id' => 'code', 'class' => 'form-control'])
                                !!}
                            @endif

                            <p class="form-text text-muted">{{ trans('fi.help_currency_code') }}</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>{{ trans('fi.symbol') }}: </label>
                            {!! Form::text('symbol', null, ['id' => 'symbol', 'class' => 'form-control'])
                            !!}
                            <p class="form-text text-muted">{{ trans('fi.help_currency_symbol') }}</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>{{ trans('fi.symbol_placement') }}: </label>
                            {!! Form::select('placement', ['before' => trans('fi.before_amount'), 'after'
                            => trans('fi.after_amount')], null, ['class' => 'form-control']) !!}
                            <p class="form-text text-muted">{{ trans('fi.help_currency_symbol_placement') }}</p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ trans('fi.decimal_point') }}: </label>
                            {!! Form::text('decimal', null, ['id' => 'decimal', 'class' => 'form-control'])
                            !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ trans('fi.thousands_separator') }}: </label>
                            {!! Form::text('thousands', null, ['id' => 'thousands', 'class' =>
                            'form-control']) !!}
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </section>

    {!! Form::close() !!}
@stop