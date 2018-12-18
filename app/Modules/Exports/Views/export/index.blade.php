@extends('layouts.master')

@section('content')

    <section class="content-header">
        <h3>@lang('fi.export_data')</h3>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card m-2">

                    <div class="card-header d-flex p-0">
                        <ul class="nav nav-tabs" id="setting-tabs">
                            <li class="nav-item"><a class="nav-link active show" data-toggle="tab"
                                                    href="#tab-clients">@lang('fi.clients')</a></li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab"
                                                    href="#tab-quotes">@lang('fi.quotes')</a></li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab"
                                                    href="#tab-quote-items">@lang('fi.quote_items')</a></li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab"
                                                    href="#tab-invoices">@lang('fi.invoices')</a></li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab"
                                                    href="#tab-invoice-items">@lang('fi.invoice_items')</a></li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab"
                                                    href="#tab-payments">@lang('fi.payments')</a></li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab"
                                                    href="#tab-expenses">@lang('fi.expenses')</a></li>
                        </ul>
                    </div>
                    <div class="tab-content m-2">
                        <div id="tab-clients" class="tab-pane active">
                            {!! Form::open(['route' => ['export.export', 'Clients'], 'id' => 'client-export-form', 'target' => '_blank']) !!}
                            <div class="form-group">
                                <label>@lang('fi.format'):</label>
                                {!! Form::select('writer', $writers, null, ['class' => 'form-control']) !!}
                            </div>
                            <button class="btn btn-primary"><i
                                        class="fa fa-download"></i> @lang('fi.export_clients')</button>
                            {!! Form::close() !!}
                        </div>
                        <div id="tab-quotes" class="tab-pane">
                            {!! Form::open(['route' => ['export.export', 'Quotes'], 'id' => 'quote-export-form', 'target' => '_blank']) !!}
                            <div class="form-group">
                                <label>@lang('fi.format'):</label>
                                {!! Form::select('writer', $writers, null, ['class' => 'form-control']) !!}
                            </div>
                            <button class="btn btn-primary"><i
                                        class="fa fa-download"></i> @lang('fi.export_quotes')</button>
                            {!! Form::close() !!}
                        </div>
                        <div id="tab-quote-items" class="tab-pane">
                            {!! Form::open(['route' => ['export.export', 'QuoteItems'], 'id' => 'quote-item-export-form', 'target' => '_blank']) !!}
                            <div class="form-group">
                                <label>@lang('fi.format'):</label>
                                {!! Form::select('writer', $writers, null, ['class' => 'form-control']) !!}
                            </div>
                            <button class="btn btn-primary"><i
                                        class="fa fa-download"></i> @lang('fi.export_quote_items')</button>
                            {!! Form::close() !!}
                        </div>
                        <div id="tab-invoices" class="tab-pane">
                            {!! Form::open(['route' => ['export.export', 'Invoices'], 'id' => 'invoice-export-form', 'target' => '_blank']) !!}
                            <div class="form-group">
                                <label>@lang('fi.format'):</label>
                                {!! Form::select('writer', $writers, null, ['class' => 'form-control']) !!}
                            </div>
                            <button class="btn btn-primary"><i
                                        class="fa fa-download"></i> @lang('fi.export_invoices')</button>
                            {!! Form::close() !!}
                        </div>
                        <div id="tab-invoice-items" class="tab-pane">
                            {!! Form::open(['route' => ['export.export', 'InvoiceItems'], 'id' => 'invoice-item-export-form', 'target' => '_blank']) !!}
                            <div class="form-group">
                                <label>@lang('fi.format'):</label>
                                {!! Form::select('writer', $writers, null, ['class' => 'form-control']) !!}
                            </div>
                            <button class="btn btn-primary"><i
                                        class="fa fa-download"></i> @lang('fi.export_invoice_items')</button>
                            {!! Form::close() !!}
                        </div>
                        <div id="tab-payments" class="tab-pane">
                            {!! Form::open(['route' => ['export.export', 'Payments'], 'id' => 'payment-export-form', 'target' => '_blank']) !!}
                            <div class="form-group">
                                <label>@lang('fi.format'):</label>
                                {!! Form::select('writer', $writers, null, ['class' => 'form-control']) !!}
                            </div>
                            <button class="btn btn-primary"><i
                                        class="fa fa-download"></i> @lang('fi.export_payments')</button>
                            {!! Form::close() !!}
                        </div>
                        <div id="tab-expenses" class="tab-pane">
                            {!! Form::open(['route' => ['export.export', 'Expenses'], 'id' => 'export-export-form', 'target' => '_blank']) !!}
                            <div class="form-group">
                                <label>@lang('fi.format'):</label>
                                {!! Form::select('writer', $writers, null, ['class' => 'form-control']) !!}
                            </div>
                            <button class="btn btn-primary"><i
                                        class="fa fa-download"></i> @lang('fi.export_expenses')</button>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@stop