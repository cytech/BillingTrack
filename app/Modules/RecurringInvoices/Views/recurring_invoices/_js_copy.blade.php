<script type="text/javascript">

    $(function () {
        $('#modal-copy-recurring-invoice').modal();

        $('#modal-copy-recurring-invoice').on('shown.bs.modal', function () {
            $("#client_name").focus();
        });

        $('#copy_next_date').datetimepicker({format: '{{ config('bt.dateFormat') }}', timepicker: false, scrollInput: false});
        $('#copy_stop_date').datetimepicker({format: '{{ config('bt.dateFormat') }}', timepicker: false, scrollInput: false});

        $('#copy_client_name').autocomplete({
            appendTo: '#modal-copy-recurring-invoice',
            source: '{{ route('clients.ajax.lookup') }}',
            minLength: 3
        }).autocomplete("widget");

        // Creates the recurringInvoice
        $('#btn-copy-recurring-invoice-submit').click(function () {
            $.post('{{ route('recurringInvoiceCopy.store') }}', {
                recurring_invoice_id: {{ $recurringInvoice->id }},
                client_name: $('#copy_client_name').val(),
                company_profile_id: $('#copy_company_profile_id').val(),
                group_id: $('#copy_group_id').val(),
                user_id: {{ auth()->user()->id }},
                next_date: $('#copy_next_date').val(),
                recurring_frequency: $('#copy_recurring_frequency').val(),
                recurring_period: $('#copy_recurring_period').val(),
                stop_date: $('#copy_stop_date').val()
            }).done(function (response) {
                window.location = response.url;
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
