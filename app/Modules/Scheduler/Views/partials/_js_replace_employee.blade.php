<script type="text/javascript">

    $(function () {

        $('#replace-employee').modal();

        $('#replace-employee-confirm').click(function () {
            $.post('{{ route('scheduler.setreplace.employee') }}', {
                id: $('#item_id').val(),
                resource_id: $('#aemployee option:selected').val(),
                name:$('#aemployee option:selected').text(),
            }).done(function (response) {
                if (response.success) {
                    setTimeout(function () { //give notify a chance to display before redirect
                        window.location.href = "{{ url('scheduler/checkschedule') }}";
                    }, 2000);
                    notify(response.success, 'success');
                }else {
                    notify(response.error, 'error');
                }
            }).fail(function (response) {
                if (response.status == 422) {
                    showErrors($.parseJSON(response.responseText).errors, '#modal-status-placeholder');
                } else {
                    notify('@lang('bt.unknown_error')','error');
                }
            });
        });

    });

</script>
