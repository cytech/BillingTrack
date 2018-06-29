
{!! $dataTable->table() !!}

@push('scripts')
    <link rel="stylesheet" href="/assets/plugins/datatables.net-buttons-bs/css/buttons.bootstrap.min.css">
    <script src="/assets/plugins/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="/vendor/datatables/buttons.server-side.js"></script>
    {!! $dataTable->scripts() !!}
    <script>
        var htmlstr = '<input type="checkbox" id="bulk-select-all"/> ';
        $('.bulk-record').html(htmlstr)
    </script>
@endpush
