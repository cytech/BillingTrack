@extends('client_center.layouts.logged_in')

@section('content')

    <section class="content-header">
        <h1>@lang('bt.dashboard')</h1>
    </section>

    <section class="content">

        <div class="row">
            <div class="col-md-12">
                <div class=" card card-light">
                    <div class="box-header">
                        <h3 class="box-title">@lang('bt.recent_quotes')</h3>
                    </div>
                    @if (count($quotes))
                        <div class="card-body">
                            @include('client_center.quotes._table')
                            <p style="text-align: center;"><a href="{{ route('clientCenter.quotes') }}" class="btn btn-secondary">@lang('bt.view_all')</a></p>
                        </div>
                    @else
                        <div class="card-body">
                            <p>@lang('bt.no_records_found')</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class=" card card-light">
                    <div class="box-header">
                        <h3 class="box-title">@lang('bt.recent_workorders')</h3>
                    </div>
                    @if (count($workorders))
                        <div class="card-body">
                            @include('client_center.workorders._table')
                            <p style="text-align: center;"><a href="{{ route('clientCenter.workorders') }}" class="btn btn-secondary">@lang('bt.view_all')</a></p>
                        </div>
                    @else
                        <div class="card-body">
                            <p>@lang('bt.no_records_found')</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class=" card card-light">
                    <div class="box-header">
                        <h3 class="box-title">@lang('bt.recent_invoices')</h3>
                    </div>
                    @if (count($invoices))
                        <div class="card-body">
                            @include('client_center.invoices._table')
                            <p style="text-align: center;"><a href="{{ route('clientCenter.invoices') }}" class="btn btn-secondary">@lang('bt.view_all')</a></p>
                        </div>
                    @else
                        <div class="card-body">
                            <p>@lang('bt.no_records_found')</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class=" card card-light">
                    <div class="box-header">
                        <h3 class="box-title">@lang('bt.recent_payments')</h3>
                    </div>
                    @if (count($payments))
                        <div class="card-body">
                            @include('client_center.payments._table')
                            <p style="text-align: center;"><a href="{{ route('clientCenter.payments') }}" class="btn btn-secondary">@lang('bt.view_all')</a></p>
                        </div>
                    @else
                        <div class="card-body">
                            <p>@lang('bt.no_records_found')</p>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </section>

@stop
