<script>
    $(function () {
        $('#bulk-select-all').click(function () {
            if ($(this).prop('checked')) {
                $('.bulk-record').prop('checked', true);
                if ($('.bulk-record:checked').length > 0) {
                    $('.bulk-actions').show();
                    $('.std-actions').hide();
                }
            }
            else {
                $('.bulk-record').prop('checked', false);
                $('.bulk-actions').hide();
                $('.std-actions').show();
            }
        });

        $('.bulk-record').click(function () {
            if ($('.bulk-record:checked').length > 0) {
                $('.bulk-actions').show();
                $('.std-actions').hide();
            }
            else {
                $('.bulk-actions').hide();
                $('.std-actions').show();
            }
        });

        $('.bulk-actions').hide();


        $('#btn-bulk-trash').click(function () {
            const ids = [];

            $('.bulk-record:checked').each(function () {
                ids.push($(this).data('id'));
            });

            if (ids.length > 0) {
                bulkConfirm('@lang('bt.bulk_event_trash_warning')', '', '{{ route('scheduler.bulk.trash') }}', ids);
            }
        });
    });
</script>
