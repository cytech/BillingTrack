@extends('layouts.master')

@section('content')
    <section class="content-header">
        <h3 class="float-left">@lang('bt.employees')</h3>

        <div class="float-right">
            <div class="btn-group">
                <a href="{{ route('employees.index', ['status' => 'active']) }}"
                   class="btn btn-secondary @if ($status == 'active') active @endif">@lang('bt.active')</a>
                <a href="{{ route('employees.index', ['status' => 'inactive']) }}"
                   class="btn btn-secondary @if ($status == 'inactive') active @endif">@lang('bt.inactive')</a>
                <a href="{{ route('employees.index') }}"
                   class="btn btn-secondary @if ($status == 'all') active @endif">@lang('bt.all')</a>

            </div>
            <a href="{{ route('employees.create') }}" class="btn btn-primary "><i
                        class="fa fa-plus"></i> @lang('bt.create_employee')</a>
        </div>
        <div class="clearfix"></div>
    </section>
    <section class="content">
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
