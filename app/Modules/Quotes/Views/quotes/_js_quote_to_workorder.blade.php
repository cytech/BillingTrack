<script type="text/javascript">

    $(function () {
        // Display the create quote modal
        $('#modal-quote-to-workorder').modal('show');

        $("#to_workorder_date").datetimepicker({format: '{{ config('bt.dateFormat') }}', timepicker: false, scrollInput: false});

        // Creates the workorder
        $('#btn-quote-to-workorder-submit').click(function () {
            $.post('{{ route('quoteToWorkorder.store') }}', {
                quote_id: {{ $quote_id }},
                client_id: {{ $client_id }},
                workorder_date: $('#to_workorder_date').val(),
                group_id: $('#to_workorder_group_id').val(),
                user_id: {{ $user_id }}



            }).done(function (response) {
                window.location = response.redirectTo;
            }).fail(function (response) {
                if (response.status == 400) {
                    showErrors($.parseJSON(response.responseText).errors, '#modal-status-placeholder');
                } else {
                    notify('@lang('bt.unknown_error')','error');
                }
            });
        });
    });

</script>
