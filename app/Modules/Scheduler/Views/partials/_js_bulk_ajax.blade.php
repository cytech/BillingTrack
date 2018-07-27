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
            var ids = [];

            $('.bulk-record:checked').each(function () {
                ids.push($(this).data('id'));
            });

            if (ids.length > 0) {
                pconfirm_def.text = '{!! $pCnote !!}';
                new PNotify(pconfirm_def).get().on('pnotify.confirm', function () {
                    $.post('{!! route($droute) !!}', {
                        ids: ids
                    }).done(function () {
                        $('input:checkbox').prop('checked', false);
                        $(ids).each(function (index, element) {
                            $("#" + element).hide();
                        });
                        $('.bulk-actions').hide();
                        $('.std-actions').show();
                        pnotify('{!! $pnote !!}', 'success');
                    }).fail(function () {
                        pnotify('{{ trans('fi.unknown_error') }}', 'error');
                    });
                }).on('pnotify.cancel', function () {
                    //Do Nothing
                });
            }
        });

    });
</script>