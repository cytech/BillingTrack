@extends('layouts.master')

@section('content')
    {{--{!! Form::wobreadcrumbs() !!}--}}
    <section class="content-header">
        <h3 class="float-left">@lang('fi.vendors')</h3>

        <div class="float-right">
            <a href="{{ route('vendors.create') }}" class="btn btn-primary "><i
                        class="fa fa-plus"></i> @lang('fi.create_vendor')</a>
        </div>
        <div class="clearfix"></div>
    </section>

    <section class="container-fluid">
        @include('layouts._alerts')
        <div class="card">
            <div class="card-body">
                @include('vendors._table')
            </div>
        </div>
    </section>
@stop
