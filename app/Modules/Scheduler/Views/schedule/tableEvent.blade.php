@extends('layouts.master')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">{{ trans('fi.events') }}</h1>
        <div class="pull-right">

            <a href="javascript:void(0)" class="btn btn-default bulk-actions" id="btn-bulk-trash"><i
                        class="fa fa-trash"></i> {{ trans('fi.bulk_event_trash') }}</a>
            <a href="{!! route('scheduler.tableeventcreate') !!}" class="btn btn-primary "><i
                        class="fa fa-fw fa-plus"></i> {{ trans('fi.create_event') }}</a>
        </div>

        <div class="clearfix"></div>

    </section>
    <section class="content">
        @include('layouts._alerts')
        <div class="row">
            <div class="col-lg-12">
                <div class="box box-primary">

                    <div class="box-body no-padding">
                        @include('partials._dataTable')
                    </div>
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