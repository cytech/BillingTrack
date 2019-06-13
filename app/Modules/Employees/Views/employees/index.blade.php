@extends('layouts.master')

@section('content')
    {{--{!! Form::wobreadcrumbs() !!}--}}
    <section class="content-header">
        <h3 class="float-left">@lang('bt.employees')</h3>

        <div class="float-right">
            <a href="{{ route('employees.create') }}" class="btn btn-primary "><i
                        class="fa fa-plus"></i> @lang('bt.create_employee')</a>
        </div>
        <div class="clearfix"></div>
    </section>
    <section class="container-fluid">
        @include('layouts._alerts')
        <div class="card">
            <div class="card-body">
                @include('employees._table')
            </div>
        </div>
    </section>
@stop
