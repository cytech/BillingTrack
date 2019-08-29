<script type="text/javascript">

    $(function () {

        $('#create-purchaseorder').modal();

        $('#create-purchaseorder').on('shown.bs.modal', function () {
            $("#create_vendor_name").focus();
            $("#create_vendor_name").val(vendorName);
            $('#create_vendor_name').autocomplete({
                appendTo: '#create-purchaseorder',
                source: '{{ route('vendors.ajax.lookup') }}',
                minLength: 3
            }).autocomplete("widget");
            $("#productid").val(productid);
        });

        $('#create_purchaseorder_date').datetimepicker({format: '{{ config('bt.dateFormat') }}', timepicker: false, scrollInput: false});

        $('#purchaseorder-create-confirm').click(function () {

            $.post('{{ route('purchaseorders.store') }}', {
                user_id: $('#user_id').val(),
                productid: $('#productid').val(),
                company_profile_id: $('#company_profile_id').val(),
                vendor_name: $('#create_vendor_name').val(),
                purchaseorder_date: $('#create_purchaseorder_date').val(),
                group_id: $('#create_group_id').val()
            }).done(function (response) {
                window.location = '{{ url('purchaseorders') }}' + '/' + response.id + '/edit';
            }).fail(function (response) {
                showErrors($.parseJSON(response.responseText).errors, '#modal-status-placeholder');
            });
        });

    });

</script>
