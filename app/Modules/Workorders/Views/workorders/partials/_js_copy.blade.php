<script type="text/javascript">

    $(function () {
        $('#modal-copy-workorder').modal();

        $('#modal-copy-workorder').on('shown.bs.modal', function () {
            $("#client_name").focus();
        });

        $("#copy_workorder_date").datepicker({format: '{{ config('fi.datepickerFormat') }}', autoclose: true});

        var clients = new Bloodhound({
            datumTokenizer: function (d) {
                return Bloodhound.tokenizers.whitespace(d.num);
            },
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            remote: '{{ route('clients.ajax.lookup') }}' + '?query=%QUERY'
        });

        clients.initialize();

        $('#copy_client_name').typeahead(null, {
            minLength: 3,
            source: clients.ttAdapter()
        });

        // Creates the workorder
        $('#btn-copy-workorder-submit').click(function () {
            $.post('{{ route('workorderCopy.store') }}', {
                workorder_id: {{ $workorder->id }},
                client_name: $('#copy_client_name').val(),
                company_profile_id: $('#copy_company_profile_id').val(),
                workorder_date: $('#copy_workorder_date').val(),
                group_id: $('#copy_group_id').val(),
                user_id: {{ $user_id }}



            }).done(function (response) {
                window.location = '{{ url('workorders') }}' + '/' + response.id + '/edit';
            }).fail(function (response) {
                showErrors($.parseJSON(response.responseText).errors, '#modal-status-placeholder');
            });
        });
    });

</script>