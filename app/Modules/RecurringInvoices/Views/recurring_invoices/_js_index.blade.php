<script type="text/javascript">
    $(function () {
        $('.recurring_invoice_filter_options').change(function () {
            $('form#filter').submit();
        });

        $('#btn-bulk-delete').click(function () {
            const ids = [];

            $('.bulk-record:checked').each(function () {
                ids.push($(this).data('id'));
            });

            if (ids.length > 0) {
                bulkConfirm('@lang('bt.bulk_trash_record_warning')', '', "{{ route('recurringInvoices.bulk.delete') }}", ids)
            }
        });
    });
</script>
