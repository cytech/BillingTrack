<script type="text/javascript">
    $(function() {
        $('.quote_filter_options').change(function () {
            $('form#filter').submit();
        });

        $('#btn-bulk-delete').click(function () {
            var ids = [];

            $('.bulk-record:checked').each(function () {
                ids.push($(this).data('id'));
            });

            if (ids.length > 0) {
                bulkConfirm('{!! trans('fi.bulk_trash_record_warning') !!}', "{{ route('quotes.bulk.delete') }}", ids)
            }
        });

        $('.bulk-change-status').click(function() {
            var ids = [];

            $('.bulk-record:checked').each(function () {
                ids.push($(this).data('id'));
            });

            if (ids.length > 0) {
                bulkConfirm('{!! trans('fi.bulk_quote_change_status_warning') !!}', "{{ route('quotes.bulk.status') }}",
                            ids, $(this).data('status'))
            }
        });
    });
</script>