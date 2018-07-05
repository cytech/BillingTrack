@extends('layouts.master')

@section('javascript')
    <script type="text/javascript">
        $(function () {
            $('#btn-bulk-delete').click(function () {

                var ids = [];

                $('.bulk-record:checked').each(function () {
                    ids.push($(this).data('id'));
                });

                if (ids.length > 0) {
                    bulkConfirm('{!! trans('fi.trash_clients_warning') !!}', "{{ route('clients.bulk.delete') }}", ids)
                }
            });
        });
    </script>
@stop

@section('content')

    <section class="content-header">
        <h1 class="pull-left">{{ trans('fi.clients') }}</h1>

        <div class="pull-right">

            <a href="javascript:void(0)" class="btn btn-default bulk-actions" id="btn-bulk-delete"><i
                        class="fa fa-trash"></i> {{ trans('fi.trash') }}</a>

            <div class="btn-group">
                <a href="{{ route('clients.index', ['status' => 'active']) }}"
                   class="btn btn-default @if ($status == 'active') active @endif">{{ trans('fi.active') }}</a>
                <a href="{{ route('clients.index', ['status' => 'inactive']) }}"
                   class="btn btn-default @if ($status == 'inactive') active @endif">{{ trans('fi.inactive') }}</a>
                <a href="{{ route('clients.index') }}"
                   class="btn btn-default @if ($status == 'all') active @endif">{{ trans('fi.all') }}</a>
            </div>

            <a href="{{ route('clients.create') }}" class="btn btn-primary btn-margin-left"><i
                        class="fa fa-plus"></i> {{ trans('fi.new') }}</a>
        </div>

        <div class="clearfix"></div>
    </section>

    <section class="content">

        @include('layouts._alerts')

        <div class="row">

            <div class="col-xs-12">

                <div class="box box-primary">

                    <div class="box-body no-padding">
                        {!! $dataTable->table() !!}
                    </div>

                </div>

            </div>

        </div>

    </section>

@stop

@push('scripts')
    <link rel="stylesheet" href="/assets/plugins/datatables.net-buttons-bs/css/buttons.bootstrap.min.css">
    <script src="/assets/plugins/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="/vendor/datatables/buttons.server-side.js"></script>
    {!! $dataTable->scripts() !!}
    <script>
        var htmlstr = '<input type="checkbox" class="btn-group" id="bulk-select-all"/> ';
        $('.bulk-record').html(htmlstr)
    </script>
@endpush