@extends('layouts.master')

@section('content')
    {{--{!! Form::wobreadcrumbs() !!}--}}
    <section class="content-header">
        <h3 class="float-left">@lang('fi.categories')</h3>

        <div class="float-right">
            <a href="{{ route('categories.create') }}" class="btn btn-primary "><i
                        class="fa fa-plus"></i> @lang('fi.create_category')</a>
        </div>
        <div class="clearfix"></div>
    </section>

    <section class="container-fluid">
        @include('layouts._alerts')
        <div class="card">
            <div class="card-body">
                @include('categories._table')
            </div>
        </div>
    </section>
@stop
