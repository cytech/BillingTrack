<script type="text/javascript">
    $(function () {
        $('.workorder_filter_options').change(function () {
            $('form#filter').submit();
        });

        $('#btn-bulk-delete').click(function () {
            var ids = [];

            $('.bulk-record:checked').each(function () {
                ids.push($(this).data('id'));
            });

            if (ids.length > 0) {
                pconfirm_def.text = '{{ trans('Workorders::texts.bulk_workorder_trash_warning') }}';
                new PNotify(pconfirm_def).get().on('pnotify.confirm', function () {
                    $.post("{{ route('workorders.bulk.trash') }}", {
                        ids: ids
                    }).done(function () {
                        $('input:checkbox').prop('checked', false);
                        $(ids).each(function (index, element) {
                            $("#" + element).hide();
                        });
                        $('.bulk-actions').hide();
                        pnotify('{{ trans('Workorders::texts.bulk_workorder_trash_success') }}', 'success');
                    }).fail(function () {
                        pnotify('{{ trans('Workorders::texts.unknown_error') }}', 'error');
                    });

                }).on('pnotify.cancel', function () {
                    //Do Nothing
                });
            }
        });

        $('.bulk-change-status').click(function () {
            var ids = [];

            $('.bulk-record:checked').each(function () {
                ids.push($(this).data('id'));
            });

            if (ids.length > 0) {
                var statusid = $(this).data('status');
                pconfirm_def.text = '{{ trans('Workorders::texts.bulk_workorder_change_status_warning') }}';
                new PNotify(pconfirm_def).get().on('pnotify.confirm', function () {
                    $.post("{{ route('workorders.bulk.status') }}", {
                        ids: ids,
                        status: statusid
                    }).done(function () {
                        $('input:checkbox').prop('checked', false);
                        window.location = decodeURIComponent("{{ urlencode(request()->fullUrl()) }}");
                    });
                }).on('pnotify.cancel', function () {
                    //Do Nothing
                });
            }
        });

    });

    $(function () {
        $('.create-workorder').click(function () {
            clientName = $(this).data('unique-name');
            $('#modal-placeholder').load('{{ route('workorders.create') }}');
        });
    });
</script>