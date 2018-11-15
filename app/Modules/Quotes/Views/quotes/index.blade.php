@extends('layouts.master')

@section('javascript')
    @include('quotes._js_index')
@stop

@section('content')

    <section class="content mt-3 mb-3">
        <h3 class="float-left">{{ trans('fi.quotes') }}</h3>
        <div class="float-right">
            <div class="btn-group bulk-actions">
                <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    {{ trans('fi.change_status') }}
                </button>
                <ul class="dropdown-menu">
                    @foreach ($keyedStatuses as $key => $status)
                        <li><a href="javascript:void(0)" class="bulk-change-status" data-status="{{ $key }}">{{ $status }}</a></li>
                    @endforeach
                </ul>
            </div>

            <a href="javascript:void(0)" class="btn btn-secondary bulk-actions" id="btn-bulk-delete"><i class="fa fa-trash"></i> {{ trans('fi.trash') }}</a>

            <div class="btn-group">
                {!! Form::open(['method' => 'GET', 'id' => 'filter', 'class'=>"form-inline"]) !!}
                {!! Form::select('company_profile', $companyProfiles, request('company_profile'), ['class' => 'quote_filter_options form-control ']) !!}
                {!! Form::select('status', $statuses, request('status'), ['class' => 'quote_filter_options form-control ']) !!}
                {!! Form::close() !!}
            </div>
            <a href="javascript:void(0)" class="btn btn-primary create-quote"><i class="fa fa-plus"></i> {{ trans('fi.new') }}</a>
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