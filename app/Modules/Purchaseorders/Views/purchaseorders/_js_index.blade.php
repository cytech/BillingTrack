<script type="text/javascript">
    $(function() {
        $('.purchaseorder_filter_options').change(function () {
            $('form#filter').submit();
        });

        $('#btn-bulk-delete').click(function () {

            const ids = [];

            $('.bulk-record:checked').each(function () {
                ids.push($(this).data('id'));
            });

            if (ids.length > 0) {
                bulkConfirm('@lang('bt.bulk_trash_record_warning')', '', "{{ route('purchaseorders.bulk.delete') }}", ids)
            }
        });

        $('.bulk-change-status').click(function() {
            const ids = [];

            $('.bulk-record:checked').each(function () {
                ids.push($(this).data('id'));
            });

            if (ids.length > 0) {
                bulkConfirm('@lang('bt.bulk_purchaseorder_change_status_warning')', '', "{{ route('purchaseorders.bulk.status') }}",
                            ids, $(this).data('status'))
            }
        });
    });
</script>
