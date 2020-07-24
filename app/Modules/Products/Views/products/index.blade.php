@extends('layouts.master')

@section('content')
    <section class="content-header">
        <h3 class="float-left">@lang('bt.products')</h3>

        <div class="float-right">
            <div class="btn-group">
                <a href="{{ route('products.index', ['status' => 'active']) }}"
                   class="btn btn-secondary @if ($status == 'active') active @endif">@lang('bt.active')</a>
                <a href="{{ route('products.index', ['status' => 'inactive']) }}"
                   class="btn btn-secondary @if ($status == 'inactive') active @endif">@lang('bt.inactive')</a>
                <a href="{{ route('products.index') }}"
                   class="btn btn-secondary @if ($status == 'all') active @endif">@lang('bt.all')</a>

            </div>
            <a href="{{ route('products.create') }}" class="btn btn-primary "><i
                        class="fa fa-plus"></i> @lang('bt.create_product')</a>
        </div>
        <div class="clearfix"></div>
    </section>

    <section class="container-fluid">
        @include('layouts._alerts')
        <div class="card">
            <div class="card-body">
                {!! $dataTable->table(['class' => 'table table-striped display', 'width' => '100%', 'cellspacing' => '0']) !!}
            </div>
        </div>
    </section>
@stop
@push('scripts')
    {!! $dataTable->scripts() !!}
    <script>
    </script>
@endpush
