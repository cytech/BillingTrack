<script type="text/javascript">
    $(function () {
        $('#btn-edit-vendor').click(function () {
            $('#modal-placeholder').load('{{ route('vendors.ajax.modalEdit') }}', {
                vendor_id: $(this).data('vendor-id'),
                refresh_to_route: '{{ route('purchaseorders.purchaseorderEdit.refreshTo') }}',
                id: {{ $purchaseorder->id }}
            });
        });

        $('#btn-change-vendor').click(function () {
            $('#modal-placeholder').load('{{ route('vendors.ajax.modalLookup') }}', {
                id: {{ $purchaseorder->id }},
                update_vendor_id_route: '{{ route('purchaseorders.purchaseorderEdit.updateVendor') }}',
                refresh_to_route: '{{ route('purchaseorders.purchaseorderEdit.refreshTo') }}'
            });
        });
    });
</script>
