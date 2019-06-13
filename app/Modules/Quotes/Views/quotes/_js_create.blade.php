<script type="text/javascript">

    $(function () {

        $('#create-quote').modal();

        $('#create-quote').on('shown.bs.modal', function () {
            $("#create_client_name").focus();
            $("#create_client_name").val(clientName);
            $('#create_client_name').autocomplete({
                appendTo: '#create-quote',
                source: '{{ route('clients.ajax.lookup') }}',
                minLength: 3
            }).autocomplete("widget");
        });

        $("#create_quote_date").datetimepicker({format: '{{ config('bt.dateFormat') }}', timepicker: false, scrollInput: false});

        $('#quote-create-confirm').click(function () {

            $.post('{{ route('quotes.store') }}', {
                user_id: $('#user_id').val(),
                company_profile_id: $('#company_profile_id').val(),
                client_name: $('#create_client_name').val(),
                quote_date: $('#create_quote_date').val(),
                group_id: $('#create_group_id').val()
            }).done(function (response) {
                window.location = '{{ url('quotes') }}' + '/' + response.id + '/edit';
            }).fail(function (response) {
                showErrors($.parseJSON(response.responseText).errors, '#modal-status-placeholder');
            });
        });

    });

</script>
