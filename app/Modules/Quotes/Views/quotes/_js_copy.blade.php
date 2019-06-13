<script type="text/javascript">

    $(function () {
        $('#modal-copy-quote').modal();

        $('#modal-copy-quote').on('shown.bs.modal', function () {
            $("#client_name").focus();
        });

        $("#copy_quote_date").datetimepicker({format: '{{ config('bt.dateFormat') }}', timepicker: false, scrollInput: false});

        $('#copy_client_name').autocomplete({
            appendTo: '#modal-copy-quote',
            source: '{{ route('clients.ajax.lookup') }}',
            minLength: 3
        }).autocomplete("widget");

        // Creates the quote
        $('#btn-copy-quote-submit').click(function () {
            $.post('{{ route('quoteCopy.store') }}', {
                quote_id: {{ $quote->id }},
                client_name: $('#copy_client_name').val(),
                company_profile_id: $('#copy_company_profile_id').val(),
                quote_date: $('#copy_quote_date').val(),
                group_id: $('#copy_group_id').val(),
                user_id: {{ $user_id }}
            }).done(function (response) {
                window.location = '{{ url('quotes') }}' + '/' + response.id + '/edit';
            }).fail(function (response) {
                showErrors($.parseJSON(response.responseText).errors, '#modal-status-placeholder');
            });
        });
    });

</script>
