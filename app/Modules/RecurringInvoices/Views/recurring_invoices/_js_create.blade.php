<script type="text/javascript">

    $(function () {

        $('#create-recurring-invoice').modal();

        $('#create-recurring-invoice').on('shown.bs.modal', function () {
            $("#create_client_name").focus();
            $("#create_client_name").val(clientName);
            $('#create_client_name').autocomplete({
                appendTo: '#create-recurring-invoice',
                source: '{{ route('clients.ajax.lookup') }}',
                minLength: 3
            }).autocomplete("widget");
        });

        $('#create_next_date').datetimepicker({format: '{{ config('bt.dateFormat') }}', timepicker: false, scrollInput: false});
        $('#create_stop_date').datetimepicker({format: '{{ config('bt.dateFormat') }}', timepicker: false, scrollInput: false});

        $('#recurring-invoice-create-confirm').click(function () {

            $.post('{{ route('recurringInvoices.store') }}', {
                user_id: $('#user_id').val(),
                company_profile_id: $('#company_profile_id').val(),
                client_name: $('#create_client_name').val(),
                group_id: $('#create_group_id').val(),
                next_date: $('#create_next_date').val(),
                stop_date: $('#create_stop_date').val(),
                recurring_frequency: $('#recurring_frequency').val(),
                recurring_period: $('#recurring_period').val()
            }).done(function (response) {
                window.location = response.url;
            }).fail(function (response) {
                showErrors($.parseJSON(response.responseText).errors, '#modal-status-placeholder');
            });
        });

    });

</script>
