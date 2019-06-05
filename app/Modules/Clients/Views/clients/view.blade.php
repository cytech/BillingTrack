@extends('layouts.master')

@section('content')

    <section class="content-header">
        <h3 class="float-left">
            @lang('fi.view_client')
        </h3>
        <div class="float-right">
            <a href="javascript:void(0)" class="btn btn-secondary create-quote"
               data-unique-name="{{ $client->unique_name }}">@lang('fi.create_quote')</a>
            <a href="javascript:void(0)" class="btn btn-secondary create-workorder"
               data-unique-name="{{ $client->unique_name }}">@lang('fi.create_workorder')</a>
            <a href="javascript:void(0)" class="btn btn-secondary create-invoice"
               data-unique-name="{{ $client->unique_name }}">@lang('fi.create_invoice')</a>
            <a href="{{ route('clients.edit', [$client->id]) }}" class="btn btn-secondary">@lang('fi.edit')</a>
            <a class="btn btn-secondary" href="#"
               onclick="swalConfirm('@lang('fi.trash_client_warning')', '{{ route('clients.delete', [$client->id]) }}');"><i
                        class="fa fa-trash"></i> @lang('fi.trash')</a>
        </div>
        <div class="clearfix"></div>
    </section>

    <section class="content">

        @include('layouts._alerts')

        <div class="row">
            <div class="col-12">
                <div class="card m-2">

                    <div class="card-header d-flex p-0">
                        <ul class="nav nav-tabs p-2">
                            <li class="nav-item "><a class="nav-link active show" data-toggle="tab"
                                                     href="#tab-details">@lang('fi.details')</a></li>
                            <li class="nav-item "><a class="nav-link" data-toggle="tab"
                                                     href="#tab-quotes">@lang('fi.quotes')</a></li>
                            <li class="nav-item "><a class="nav-link" data-toggle="tab"
                                                     href="#tab-workorders">@lang('fi.workorders')</a></li>
                            <li class="nav-item "><a class="nav-link" data-toggle="tab"
                                                     href="#tab-invoices">@lang('fi.invoices')</a></li>
                            <li class="nav-item "><a class="nav-link" data-toggle="tab"
                                                     href="#tab-recurring-invoices">@lang('fi.recurring_invoices')</a>
                            </li>
                            <li class="nav-item "><a class="nav-link" data-toggle="tab"
                                                     href="#tab-payments">@lang('fi.payments')</a></li>
                            <li class="nav-item "><a class="nav-link" data-toggle="tab"
                                                     href="#tab-attachments">@lang('fi.attachments')</a></li>
                            <li class="nav-item "><a class="nav-link" data-toggle="tab"
                                                     href="#tab-notes">@lang('fi.notes')</a></li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">

                            <div id="tab-details" class="tab-pane active">

                                <div class="row">

                                    <div class="col-md-12">

                                        <div class="float-left">
                                            <h2>{!! $client->name !!}</h2>
                                                @if($client->is_company)
                                                <span class="badge badge-primary">@lang('fi.company')
                                                @else
                                                        <span class="badge badge-green">@lang('fi.individual')
                                                @endif
                                            </span>
                                        </div>

                                        <div class="float-right" style="text-align: right;">
                                            <p>
                                                <strong>@lang('fi.total_billed')
                                                    :</strong> {{ $client->formatted_total }}<br/>
                                                <strong>@lang('fi.total_paid'):</strong> {{ $client->formatted_paid }}
                                                <br/>
                                                <strong>@lang('fi.total_balance')
                                                    :</strong> {{ $client->formatted_balance }}
                                            </p>
                                        </div>

                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-12">

                                        <table class="table table-striped">
                                            <tr class="row">
                                                <td class="col-md-2">@lang('fi.billing_address')</td>
                                                <td class="table-bordered col-md-4">{!! $client->formatted_address !!}</td>
                                                <td class="col-md-2">@lang('fi.shipping_address')</td>
                                                <td class="table-bordered col-md-4">{!! $client->formatted_address2 !!}</td>
                                            </tr>
                                            <tr class="row">
                                                <td class="col-md-2">@lang('fi.email')</td>
                                                <td class="col-md-10"><a
                                                            href="mailto:{!! $client->email !!}">{!! $client->email !!}</a>
                                                </td>
                                            </tr>
                                            <tr class="row">
                                                <td class="col-md-1">@lang('fi.phone')</td>
                                                <td class="table-bordered col-md-3">{!! $client->phone !!}</td>


                                                <td class="col-md-1">@lang('fi.mobile')</td>
                                                <td class="table-bordered col-md-3">{!! $client->mobile !!}</td>


                                                <td class="col-md-1">@lang('fi.fax')</td>
                                                <td class="table-bordered col-md-3">{!! $client->fax !!}</td>
                                            </tr>
                                            <tr class="row">
                                                <td class="col-md-2">@lang('fi.web')</td>
                                                <td class="col-md-10"><a href="{!! $client->web !!}"
                                                                         target="_blank">{!! $client->web !!}</a></td>
                                            </tr>
                                            <tr class="row">
                                                <td class="col-md-2">@lang('fi.industry')</td>
                                                <td class="table-bordered col-md-4">{!! $client->industry->name !!}</td>
                                                <td class="col-md-2">@lang('fi.size')</td>
                                                <td class="table-bordered col-md-4">{!! $client->size->name !!}</td>
                                            </tr>
                                            @foreach ($customFields as $customField)
                                                <tr class="row">
                                                    <td class="col-md-2">{!! $customField->field_label !!}</td>
                                                    <td class="col-md-10">
                                                        @if (isset($client->custom->{$customField->column_name}))
                                                            {!! nl2br($client->custom->{$customField->column_name}) !!}
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </table>

                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="float-left">
                                            <h2>@lang('fi.contacts')</h2>
                                        </div>
                                    </div>
                                </div>
                                <div id="tab-contacts">
                                @include('clients._contacts', ['contacts' => $client->contacts()->orderBy('name')->get(), 'clientId' => $client->id])
                                </div>
                            </div>

                            <div id="tab-quotes" class="tab-pane">
                                <div class="card">
                                    @include('quotes._table')
                                    <div class="card-footer"><p class="text-center"><strong><a
                                                        href="{{ route('quotes.index') }}?client={{ $client->id }}">@lang('fi.view_all')</a></strong>
                                        </p></div>
                                </div>
                            </div>

                            <div id="tab-workorders" class="tab-pane">
                                <div class="card">
                                    @include('workorders.partials._table')
                                    <div class="card-footer"><p class="text-center"><strong><a
                                                        href="{{ route('workorders.index') }}?client={{ $client->id }}">@lang('fi.view_all')</a></strong>
                                        </p></div>
                                </div>
                            </div>

                            <div id="tab-invoices" class="tab-pane">
                                <div class="card">
                                    @include('invoices._table')
                                    <div class="card-footer"><p class="text-center"><strong><a
                                                        href="{{ route('invoices.index') }}?client={{ $client->id }}">@lang('fi.view_all')</a></strong>
                                        </p></div>
                                </div>
                            </div>

                            <div id="tab-recurring-invoices" class="tab-pane">
                                <div class="card">
                                    @include('recurring_invoices._table')
                                    <div class="card-footer"><p class="text-center"><strong><a
                                                        href="{{ route('recurringInvoices.index') }}?client={{ $client->id }}">@lang('fi.view_all')</a></strong>
                                        </p></div>
                                </div>
                            </div>

                            <div id="tab-payments" class="tab-pane">
                                <div class="card">
                                    @include('payments._table')
                                    <div class="card-footer"><p class="text-center"><strong><a
                                                        href="{{ route('payments.index') }}?client={{ $client->id }}">@lang('fi.view_all')</a></strong>
                                        </p></div>
                                </div>
                            </div>

                            <div class="tab-pane" id="tab-attachments">
                                @include('attachments._table', ['object' => $client, 'model' => 'FI\Modules\Clients\Models\Client'])
                            </div>

                            <div id="tab-notes" class="tab-pane">
                                @include('notes._notes', ['object' => $client, 'model' => 'FI\Modules\Clients\Models\Client', 'hideHeader' => true])
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </section>

@stop
