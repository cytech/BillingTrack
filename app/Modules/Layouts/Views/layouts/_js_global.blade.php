<style>
.swal2-popup {
font-size: 1.6rem !important;
}
</style>

<script type="text/javascript">

    function notify(message, type) {
        if (type === 'error') {
            sbutton = true;
            stimer = 0;
        } else {
            sbutton = false;
            stimer = 3000;
        }

        Swal({
            title: message,
            type: type,
            showConfirmButton: sbutton,
            timer: stimer
        });
    }

    function swalConfirm(message, link) {
        swal({
            title: message,
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#d68500',
            confirmButtonText: '{!! trans('fi.yes_sure') !!}'
        }).then((result) => {
                if (result.value) {
                    window.location.href = link;
                } else if (result.dismiss === Swal.DismissReason.cancel) {

                }
            });
    }

    function deleteConfirm(message, route, id, totalsRoute, entityID) {

        Swal({
            title: message,
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d68500',
            confirmButtonText: '{!! trans('fi.yes_sure') !!}'
        }).then((result) => {
            if (result.value) {
                $.post(route, {
                    id: id
                }).done(function () {
                    $('#tr-item-' + id).remove();
                    $('#div-totals').load(totalsRoute, {
                        id:  entityID
                    });
                })
            } else if (result.dismiss === Swal.DismissReason.cancel) {

            }
        });
    }

    function bulkConfirm(message, route, ids, status) {

        Swal({
            title: message,
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d68500',
            confirmButtonText: '{!! trans('fi.yes_sure') !!}'
        }).then((result) => {
            if (result.value) {
                $.post(route, {
                    ids: ids,
                    status: status
                }).done(function () {
                    window.location = decodeURIComponent("{{ urlencode(request()->fullUrl()) }}");
                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {

            }
        });
    }

    function showErrors(errors, placeholder) {

        $('.input-group.has-error').removeClass('has-error');
        $(placeholder).html('');
        if (errors == null && placeholder) {
            return;
        }

        $.each(errors, function (id, message) {
            if (id) $('#' + id).parents('.input-group').addClass('has-error');
            if (placeholder) $(placeholder).append('<div class="alert alert-danger">' + message[0] + '</div>');
        });

    }

    function clearErrors() {
        $('.input-group.has-error').removeClass('has-error');
    }

    $(function () {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.create-quote').click(function () {
            clientName = $(this).data('unique-name');
            $('#modal-placeholder').load('{{ route('quotes.create') }}');
        });

        $('.create-invoice').click(function () {
            clientName = $(this).data('unique-name');
            $('#modal-placeholder').load('{{ route('invoices.create') }}');
        });

        $('.create-recurring-invoice').click(function () {
            clientName = $(this).data('unique-name');
            $('#modal-placeholder').load('{{ route('recurringInvoices.create') }}');
        });

        $(document).on('click', '.email-quote', function () {
            $('#modal-placeholder').load('{{ route('quoteMail.create') }}', {
                quote_id: $(this).data('quote-id'),
                redirectTo: $(this).data('redirect-to')
            }, function (response, status, xhr) {
                if (status == 'error') {
                    notify('{{ trans('fi.problem_with_email_template') }}','error');
                }
            });
        });

        $(document).on('click', '.email-invoice', function () {
            $('#modal-placeholder').load('{{ route('invoiceMail.create') }}', {
                invoice_id: $(this).data('invoice-id'),
                redirectTo: $(this).data('redirect-to')
            }, function (response, status, xhr) {
                if (status == 'error') {
                    notify('{{ trans('fi.problem_with_email_template') }}','error');
                }
            });
        });

        $(document).on('click', '.enter-payment', function () {
            $('#modal-placeholder').load('{{ route('payments.create') }}', {
                invoice_id: $(this).data('invoice-id'),
                invoice_balance: $(this).data('invoice-balance'),
                redirectTo: $(this).data('redirect-to')
            });
        });

        $('#bulk-select-all').click(function() {
            if ($(this).prop('checked')) {
                $('.bulk-record').prop('checked', true);
                if ($('.bulk-record:checked').length > 0) {
                    $('.bulk-actions').show();
                }
            }
            else {
                $('.bulk-record').prop('checked', false);
                $('.bulk-actions').hide();
            }
        });

        $('.bulk-record').click(function() {
            if ($('.bulk-record:checked').length > 0) {
                $('.bulk-actions').show();
            }
            else {
                $('.bulk-actions').hide();
            }
        });

        $('.bulk-actions').hide();

    });

    function resizeIframe(obj, minHeight) {
        obj.style.height = '';
        var height = obj.contentWindow.document.body.scrollHeight;

        if (height < minHeight) {
            obj.style.height = minHeight + 'px';
        }
        else {
            obj.style.height = (height + 50) + 'px';
        }
    }
</script>