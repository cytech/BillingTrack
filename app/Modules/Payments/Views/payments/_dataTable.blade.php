
{!! $dataTable->table(['class' => 'table table-striped display', 'width' => '100%', 'cellspacing' => '0']) !!}

@push('scripts')
    {!! $dataTable->scripts() !!}
    <script>
        const htmlstr = '<input type="checkbox" id="bulk-select-all"/> ';
        $('.bulk-record').html(htmlstr)
    </script>
@endpush
