@extends('layouts.master')

@section('javascript')
    <script type="text/javascript">
        $(function () {
            $('#btn-bulk-delete').click(function () {

                const ids = [];

                $('.bulk-record:checked').each(function () {
                    ids.push($(this).data('id'));
                });

                if (ids.length > 0) {
                    bulkConfirm('@lang('fi.trash_clients_warning')', "{{ route('clients.bulk.delete') }}", ids)
                }
            });
        });
    </script>
@stop

@section('content')
    <section class="content-header">
        <h3 class="float-left">@lang('fi.clients')</h3>
        <div class="float-right">
            <a href="javascript:void(0)" class="btn btn-secondary bulk-actions" id="btn-bulk-delete"><i
                        class="fa fa-trash"></i> @lang('fi.trash')</a>
            <div class="btn-group">
                <a href="{{ route('clients.index', ['status' => 'active']) }}"
                   class="btn btn-secondary @if ($status == 'active') active @endif">@lang('fi.active')</a>
                <a href="{{ route('clients.index', ['status' => 'inactive']) }}"
                   class="btn btn-secondary @if ($status == 'inactive') active @endif">@lang('fi.inactive')</a>
                <a href="{{ route('clients.index') }}"
                   class="btn btn-secondary @if ($status == 'all') active @endif">@lang('fi.all')</a>
            </div>
            <a href="{{ route('clients.create') }}" class="btn btn-primary"><i
                        class="fa fa-plus"></i> @lang('fi.new')</a>
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