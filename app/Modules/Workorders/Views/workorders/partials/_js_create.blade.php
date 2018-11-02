<script type="text/javascript">

    $(function () {

        $('#create-workorder').modal();

        $('#create-workorder').on('shown.bs.modal', function () {
            $("#create_client_name").focus();
            $('#create_client_name').autocomplete({
                appendTo: '#create-workorder',
                source: '{{ route('clients.ajax.lookup') }}',
                minLength: 3
            }).autocomplete("widget");
        });

        $("#create_workorder_date").datepicker({format: '{{ config('fi.datepickerFormat') }}', autoclose: true});

        $('#workorder-create-confirm').click(function () {
            $.post('{{ route('workorders.store') }}', {
                user_id: $('#user_id').val(),
                company_profile_id: $('#company_profile_id').val(),
                client_name: $('#create_client_name').val(),
                workorder_date: $('#create_workorder_date').val(),
                group_id: $('#create_group_id').val()
            }).done(function (response) {
                window.location = '{{ url('workorders') }}' + '/' + response.id + '/edit';
            }).fail(function (response) {
                showErrors($.parseJSON(response.responseText).errors, '#modal-status-placeholder');
            });
        });

    });

</script>