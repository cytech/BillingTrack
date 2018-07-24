@extends('layouts.master')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">{{ trans('fi.products') }}</h1>

        <div class="pull-right">

            {{--<a href="javascript:void(0)" class="btn btn-default bulk-actions" id="btn-bulk-delete"><i--}}
                        {{--class="fa fa-trash"></i> {{ trans('fi.trash') }}</a>--}}

            {{--<div class="btn-group">--}}
                {{--<a href="{{ route('clients.index', ['status' => 'active']) }}"--}}
                   {{--class="btn btn-default @if ($status == 'active') active @endif">{{ trans('fi.active') }}</a>--}}
                {{--<a href="{{ route('clients.index', ['status' => 'inactive']) }}"--}}
                   {{--class="btn btn-default @if ($status == 'inactive') active @endif">{{ trans('fi.inactive') }}</a>--}}
                {{--<a href="{{ route('clients.index') }}"--}}
                   {{--class="btn btn-default @if ($status == 'all') active @endif">{{ trans('fi.all') }}</a>--}}
            {{--</div>--}}

            <a href="{{ route('products.create') }}" class="btn btn-primary btn-margin-left"><i
                        class="fa fa-plus"></i> {{ trans('fi.create_product') }}</a>
        </div>

        <div class="clearfix"></div>
    </section>

    {{--{!! Form::wobreadcrumbs() !!}--}}
    {{--<div class="col-lg-3">--}}
        {{--<a href="{{ route('products.create') }}" class="btn btn-primary create-product"><i--}}
                    {{--class="fa fa-plus"></i> {{ trans('fi.create_product') }}</a>--}}
    {{--</div>--}}
    <section class="content">
    @include('layouts._alerts')
    <div class="col-lg-12">
        <div class="panel panel-info" id="hidepanel1">
            {{--<div class="panel-heading">--}}
                {{--<h3 class="panel-title">--}}
                    {{--{{ trans('fi.product_table') }}--}}
                {{--</h3>--}}
            {{--</div>--}}
            <div class="panel-body">
                @include('products._table')
            </div>
        </div>
    </div>
    </section>
@stop