<script type="text/javascript">

    $(function () {

        $('#modal-edit-vendor').modal();

        $('#form-edit-vendor').on('submit', function (e) {

            e.preventDefault();
            $.post(this.action, $(this).serialize())
                .done(function () {
                    $('#modal-edit-vendor').modal('hide');
                    $('#col-to').load('{{ $refreshToRoute }}', {
                        id: {{ $id }}
                    });
                })
                .fail(function (response) {
                    showErrors($.parseJSON(response.responseText).errors, '#modal-status-placeholder');
                });
        });
    });

</script>
