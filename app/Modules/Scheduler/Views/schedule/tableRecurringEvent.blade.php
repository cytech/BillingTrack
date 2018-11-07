@extends('layouts.master')

@section('content')
    {{--@if(config('app.name') == 'FusionInvoice') {!! Form::breadcrumbs() !!} @endif--}}
    <section class="container-fluid m-2">
        <h3 class="float-left">{{ trans('fi.recurring_events') }}</h3>
        <div class="float-right">

            <a href="javascript:void(0)" class="btn btn-secondary bulk-actions" id="btn-bulk-trash"><i
                        class="fa fa-trash"></i> {{ trans('fi.bulk_event_trash') }}</a>
            {{--<div class="btn-group">--}}
            {{--{!! Form::open(['method' => 'GET', 'id' => 'filter', 'class'=>"form-inline"]) !!}--}}
            {{--{!! Form::select('company_profile', $companyProfiles, request('company_profile'), ['class' => 'workorder_filter_options form-control ']) !!}--}}
            {{--{!! Form::close() !!}--}}
            {{--</div>--}}
            <a href="{!! route('scheduler.createrecurringevent') !!}" class="btn btn-primary "><i
                        class="fa fa-fw fa-plus"></i> {{ trans('fi.create_recurring_event') }}</a>
        </div>

        <div class="clearfix"></div>

    </section>
    <section class="content">
        @include('layouts._alerts')
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-light">

                    <div class="card-body">
                        @include('partials._dataTable')
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
@section('javascript')
    @include('partials._js_bulk_ajax')
    {{--@include('partials._js_datatables')--}}
@stop