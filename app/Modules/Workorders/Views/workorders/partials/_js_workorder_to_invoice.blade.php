<script type="text/javascript">

    $(function () {
        // Display the create workorder modal
        $('#modal-workorder-to-invoice').modal('show');

        $("#to_invoice_workorder_date").datetimepicker({format: '{{ config('bt.dateFormat') }}', timepicker: false, scrollInput: false});

        // Creates the invoice
        $('#btn-workorder-to-invoice-submit').click(function () {
            $.post('{{ route('workorderToInvoice.store') }}', {
                workorder_id: {{ $workorder_id }},
                client_id: {{ $client_id }},
                workorder_date: $('#to_invoice_workorder_date').val(),
                group_id: $('#to_invoice_group_id').val(),
                user_id: {{ $user_id }}



            }).done(function (response) {
                window.location = response.redirectTo;
            }).fail(function (response) {
                if (response.status == 400) {
                    showErrors($.parseJSON(response.responseText).errors, '#modal-status-placeholder');
                } else {
                    alert('@lang('bt.unknown_error')');
                }
            });
        });
    });

</script>
