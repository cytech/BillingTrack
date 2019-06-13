<script type="text/javascript">

    $(function () {

        $('#modal-enter-payment').modal();

        $('#modal-enter-multi-payment').on("shown.bs.modal", function() {
            $('#create_client_name').focus();
        });

        $('#modal-enter-multi-payment').modal('show');

        $("#payment_date").datetimepicker({format: '{{ config('bt.dateFormat') }}', timepicker: false, scrollInput: false});

        $('#enter-payment-confirm').click(function () {

            const custom_fields = {};

            const $btn = $(this).button('loading');

            $('#payment-custom-fields .custom-form-field').each(function () {
                custom_fields[$(this).data('payments-field-name')] = $(this).val();
            });

            $.post('{{ route('payments.store') }}', {
                client_id: $('#client_id').val(),
                invoice_id: $('#invoice_id').val(),
                amount: $('#payment_amount').val(),
                payment_method_id: $('#payment_method_id').val(),
                paid_at: $('#payment_date').val(),
                note: $('#payment_note').val(),
                custom: custom_fields,
                email_payment_receipt: $('#email_payment_receipt').prop('checked')
            }).done(function (data) {
                if (data.success) {
                    setTimeout(function () { //give notify a chance to display before redirect
                        window.location = '{!! $redirectTo !!}';
                    }, 2000);
                    notify(data.success, 'success');
                }else {
                    notify(data.error, 'error');
                }

            }).fail(function (response) {
                $btn.button('reset');
                showErrors($.parseJSON(response.responseText).errors, '#modal-status-placeholder');
            });
        });

    });

</script>
