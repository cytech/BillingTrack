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
                bulkConfirm('@lang('bt.bulk_trash_invoice_warning')', '@lang('bt.bulk_trash_invoice_warning_msg')', "{{ route('invoices.bulk.delete') }}", ids)
            }
        });

        $('.bulk-change-status').click(function() {
            const ids = [];

            $('.bulk-record:checked').each(function () {
                ids.push($(this).data('id'));
            });

            if (ids.length > 0) {
                bulkConfirm('@lang('bt.bulk_invoice_change_status_warning')', '', "{{ route('invoices.bulk.status') }}",
                            ids, $(this).data('status'))
            }
        });
    });
</script>
