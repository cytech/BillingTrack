@extends('layouts.master')

@section('javaScript')
    @include('invoices._js_index')
@stop

@section('content')

    <section class="content-header">
        <h3 class="float-left">@lang('bt.invoices')</h3>

        <div class="float-right">

            <div class="btn-group bulk-actions">
                @if (config('bt.updateInvProductsDefault'))
                <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown"
                        aria-expanded="false" disabled title="Disabled as Update Product Table Quantity is enabled">
                    @lang('bt.change_status')
                </button>
                @else
                <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown"
                        aria-expanded="false" >
                    @lang('bt.change_status')
                </button>
                @endif
                <div class="dropdown-menu dropdown-menu-right" role="menu">
                    @foreach ($keyedStatuses as $key => $status)
                        <a href="javascript:void(0)" class="bulk-change-status dropdown-item"
                               data-status="{{ $key }}">{{ $status }}</a>
                    @endforeach
                </div>
            </div>

            <a href="javascript:void(0)" class="btn btn-secondary bulk-actions" id="btn-bulk-delete"><i
                        class="fa fa-trash"></i> @lang('bt.trash')</a>

            <div class="btn-group">
                {!! Form::open(['method' => 'GET', 'id' => 'filter', 'class'=>"form-inline"]) !!}
                {!! Form::select('company_profile', $companyProfiles, request('company_profile'), ['class' => 'invoice_filter_options form-control ']) !!}
                {!! Form::select('status', $statuses, request('status'), ['class' => 'invoice_filter_options form-control ']) !!}
                {!! Form::close() !!}
            </div>
            <a href="javascript:void(0)" class="btn btn-primary create-invoice"><i
                        class="fa fa-plus"></i> @lang('bt.new')</a>
        </div>

        <div class="clearfix"></div>
    </section>

    <section class="content">

        @include('layouts._alerts')

        <div class="card ">
            <div class="card-body">
                        @include('layouts._dataTable')
                    </div>

                </div>


    </section>

@stop
