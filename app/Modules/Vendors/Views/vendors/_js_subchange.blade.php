<script type="text/javascript">

    $(function () {

        $('#modal-lookup-vendor').modal();

        $('#btn-submit-change-vendor').click(function () {

            $.post('{{ route('vendors.ajax.checkName') }}', {
                vendor_name: $('#change_vendor_name').val()
            }).done(function (response) {
                $('#modal-lookup-vendor').modal('hide');
                $.post('{{ $updateVendorIdRoute }}', {
                    vendor_id: response.vendor_id,
                    id: {{ $id }}
                }).done(function () {
                    $('#col-to').load('{{ $refreshToRoute }}', {
                        id: {{ $id }}
                    });
                });
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
