@extends('layouts.master')

@section('javaScript')
    <script type="text/javascript">
        $(function () {
            $('#btn-bulk-delete').click(function () {

                const ids = [];

                $('.bulk-record:checked').each(function () {
                    ids.push($(this).data('id'));
                });

                if (ids.length > 0) {
                    bulkConfirm('@lang('bt.trash_clients_warning')', '', "{{ route('clients.bulk.delete') }}", ids)
                }
            });
        });
    </script>
@stop

@section('content')
    <section class="content-header">
        <h3 class="float-left">@lang('bt.clients')</h3>
        <div class="float-right">
            <a href="javascript:void(0)" class="btn btn-secondary bulk-actions" id="btn-bulk-delete"><i
                        class="fa fa-trash"></i> @lang('bt.trash')</a>
            <div class="btn-group">
                <a href="{{ route('clients.index', ['status' => 'active']) }}"
                   class="btn btn-secondary @if ($status == 'active') active @endif">@lang('bt.active')</a>
                <a href="{{ route('clients.index', ['status' => 'inactive']) }}"
                   class="btn btn-secondary @if ($status == 'inactive') active @endif">@lang('bt.inactive')</a>
                <a href="{{ route('clients.index') }}"
                   class="btn btn-secondary @if ($status == 'all') active @endif">@lang('bt.all')</a>
                <a href="{{ route('clients.index', ['status' => 'company']) }}"
                   class="btn btn-secondary @if ($status == 'company') active @endif">@lang('bt.company')</a>
                <a href="{{ route('clients.index', ['status' => 'individual']) }}"
                   class="btn btn-secondary @if ($status == 'individual') active @endif">@lang('bt.individual')</a>
            </div>
            <a href="{{ route('clients.create') }}" class="btn btn-primary"><i
                        class="fa fa-plus"></i> @lang('bt.new')</a>
        </div>
        <div class="clearfix"></div>
    </section>

    <section class="content">
        @include('layouts._alerts')
        <div class="card ">
            <div class="card-body">
                {!! $dataTable->table(['class' => 'table table-striped display', 'width' => '100%', 'cellspacing' => '0']) !!}
            </div>
        </div>
    </section>

@stop

@push('scripts')
    {!! $dataTable->scripts() !!}
    <script>
        const htmlstr = '<input type="checkbox" class="btn-group" id="bulk-select-all"/> ';
        $('.bulk-record').html(htmlstr)
    </script>
@endpush
