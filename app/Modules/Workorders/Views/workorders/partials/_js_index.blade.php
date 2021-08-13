<script type="text/javascript">
    $(function () {
        $('.workorder_filter_options').change(function () {
            $('form#filter').submit();
        });

        $('#btn-bulk-delete').click(function () {
            const ids = [];

            $('.bulk-record:checked').each(function () {
                ids.push($(this).data('id'));
            });

            if (ids.length > 0) {
                bulkConfirm('@lang('bt.bulk_trash_record_warning')', '@lang('bt.bulk_trash_workorder_warning_msg')', "{{ route('workorders.bulk.delete') }}", ids)
            }
        });

        $('.bulk-change-status').click(function () {
            const ids = [];

            $('.bulk-record:checked').each(function () {
                ids.push($(this).data('id'));
            });

            if (ids.length > 0) {
                bulkConfirm('@lang('bt.bulk_workorder_change_status_warning')', '', "{{ route('workorders.bulk.status') }}",
                            ids, $(this).data('status'))
            }
        });

    });

</script>
