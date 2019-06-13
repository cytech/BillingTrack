@extends('layouts.master')

@section('content')
    <section class="content-header">
        <h1 class="float-left">@lang('bt.categories')</h1>
        <div class="float-right">
            <a href="{!! route('scheduler.categories.create') !!}" class="btn btn-primary"><i
                        class="fa fa-fw fa-plus"></i> @lang('bt.create_category')</a>
        </div>
        <div class="clearfix"></div>
    </section>
    <section class="container-fluid">
        @include('layouts._alerts')
        <div class="card card-light">
            <div class="card-body">
                {!! $dataTable->table(['class' => 'table table-striped display', 'width' => '100%', 'cellspacing' => '0']) !!}
            </div>
        </div>
    </section>
@stop

@push('scripts')
    {!! $dataTable->scripts() !!}
@endpush
