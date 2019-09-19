<script type="text/javascript">
    $(function () {
        $('#btn-edit-client').click(function () {
            $('#modal-placeholder').load('{{ route('clients.ajax.modalEdit') }}', {
                client_id: $(this).data('client-id'),
                refresh_to_route: '{{ route('quotes.quoteEdit.refreshTo') }}',
                id: {{ $quote->id }}
            });
        });

        $('#btn-change-client').click(function () {
            $('#modal-placeholder').load('{{ route('clients.ajax.modalLookup') }}', {
                id: {{ $quote->id }},
                update_client_id_route: '{{ route('quotes.quoteEdit.updateClient') }}',
                refresh_to_route: '{{ route('quotes.quoteEdit.refreshTo') }}'
            });
        });
    });
</script>
