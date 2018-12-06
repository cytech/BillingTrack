<script type="text/javascript">
    $(function() {
        $('.invoice_filter_options').change(function () {
            $('form#filter').submit();
        });

        $('#btn-bulk-delete').click(function () {

            const ids = [];

            $('.bulk-record:checked').each(function () {
                ids.push($(this).data('id'));
            });

            if (ids.length > 0) {
                bulkConfirm('@lang('fi.bulk_trash_record_warning')', "{{ route('invoices.bulk.delete') }}", ids)
            }
        });

        $('.bulk-change-status').click(function() {
            const ids = [];

            $('.bulk-record:checked').each(function () {
                ids.push($(this).data('id'));
            });

            if (ids.length > 0) {
                bulkConfirm('@lang('fi.bulk_invoice_change_status_warning')', "{{ route('invoices.bulk.status') }}",
                            ids, $(this).data('status'))
            }
        });
    });
</script>