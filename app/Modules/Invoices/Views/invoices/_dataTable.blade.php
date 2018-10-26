
{!! $dataTable->table(['class' => 'table table-striped display', 'width' => '100%', 'cellspacing' => '0']) !!}

@push('scripts')
    {!! $dataTable->scripts() !!}
    <script>
        var htmlstr = '<input type="checkbox" id="bulk-select-all"/> ';
        $('.bulk-record').html(htmlstr)
    </script>
@endpush