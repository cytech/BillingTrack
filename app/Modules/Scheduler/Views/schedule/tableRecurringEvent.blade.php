@extends('layouts.master')

@section('content')
    {{--@if(config('app.name') == 'FusionInvoice') {!! Form::breadcrumbs() !!} @endif--}}
    <section class="content-header">
        <h3 class="float-left">@lang('fi.recurring_events')</h3>
        <div class="float-right">

            <a href="javascript:void(0)" class="btn btn-secondary bulk-actions" id="btn-bulk-trash"><i
                        class="fa fa-trash"></i> @lang('fi.bulk_event_trash')</a>

            <a href="{!! route('scheduler.createrecurringevent') !!}" class="btn btn-primary "><i
                        class="fa fa-fw fa-plus"></i> @lang('fi.create_recurring_event')</a>
        </div>

        <div class="clearfix"></div>

    </section>
    <section class="content">
        @include('layouts._alerts')
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-light">

                    <div class="card-body">
                        @include('layouts._dataTable')
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
@section('javascript')
    @include('partials._js_bulk_ajax')
@stop