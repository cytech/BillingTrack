<script type="text/javascript">
    $(function() {
        $('#btn-edit-client').click(function () {
            $('#modal-placeholder').load('{{ route('clients.ajax.modalEdit') }}', {
                client_id: $(this).data('client-id'),
                refresh_to_route: '{{ route('workorders.workorderEdit.refreshTo') }}',
                id: {{ $workorder->id }}
            });
        });

        $('#btn-change-client').click(function () {
            $('#modal-placeholder').load('{{ route('clients.ajax.modalLookup') }}', {
                id: {{ $workorder->id }},
                update_client_id_route: '{{ route('workorders.workorderEdit.updateClient') }}',
                refresh_to_route: '{{ route('workorders.workorderEdit.refreshTo') }}'
            });
        });
    });
</script>
