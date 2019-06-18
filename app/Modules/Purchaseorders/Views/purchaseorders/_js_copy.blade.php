<script type="text/javascript">

    $(function () {
        $('#modal-copy-purchaseorder').modal();

        $('#modal-copy-purchaseorder').on('shown.bs.modal', function () {
            $("#vendor_name").focus();
        });

        $("#copy_purchaseorder_date").datetimepicker({format: '{{ config('bt.dateFormat') }}', timepicker: false, scrollInput: false});

        $('#copy_vendor_name').autocomplete({
            appendTo: '#modal-copy-purchaseorder',
            source: '{{ route('vendors.ajax.lookup') }}',
            minLength: 3
        }).autocomplete("widget");

        // Creates the purchaseorder
        $('#btn-copy-purchaseorder-submit').click(function () {
            $.post('{{ route('purchaseorderCopy.store') }}', {
                purchaseorder_id: {{ $purchaseorder->id }},
                vendor_name: $('#copy_vendor_name').val(),
                company_profile_id: $('#copy_company_profile_id').val(),
                purchaseorder_date: $('#copy_purchaseorder_date').val(),
                group_id: $('#copy_group_id').val(),
                user_id: {{ $user_id }}
            }).done(function (response) {
                window.location = '{{ url('purchaseorders') }}' + '/' + response.id + '/edit';
            }).fail(function (response) {
                showErrors($.parseJSON(response.responseText).errors, '#modal-status-placeholder');
            });
        });
    });

</script>
