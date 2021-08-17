<script type="text/javascript">

    function notify(message, type) {
        if (type === 'error') {
            sbutton = true;
            stimer = 0;
        } else {
            sbutton = false;
            stimer = 2000;
        }

        Swal.fire({
            title: message,
            icon: type,
            showConfirmButton: sbutton,
            timer: stimer
        });
    }

    function swalSaving() {
        Swal.fire({
            toast: true,
            title: '@lang('bt.saving')',
            icon: 'info',
            showConfirmButton: false,
            allowOutsideClick: false,
            allowEscapeKey: false

        });
    }

    function swalConfirm(title, message, link, target = "body") {
        Swal.fire({
            target: document.getElementById(target),
            title: title,
            html: message,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d68500',
            confirmButtonText: '@lang('bt.yes_sure')'
        }).then((result) => {
                if (result.value) {
                    window.location.href = link;
                } else if (result.dismiss === Swal.DismissReason.cancel) {

                }
            });
    }

    function deleteConfirm(message, route, id, totalsRoute, entityID) {

        Swal.fire({
            title: message,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d68500',
            confirmButtonText: '@lang('bt.yes_sure')'
        }).then((result) => {
            if (result.value) {
                if (id){
                $.post(route, {
                    id: id
                }).done(function () {
                    $('#tr-item-' + id).remove();
                    $('#div-totals').load(totalsRoute, {
                        id: entityID
                    });

                }).fail(function (response) {
                    let msg = '';
                    $.each($.parseJSON(response.responseText).errors, function (id, message) {
                        msg += message + '\n';
                    });
                    notify(msg, 'error');
                });
            }else{$.post(route
                ).done(function (data) {
                    if (data.success) {
                        setTimeout(function () { //give notify a chance to display before redirect
                            window.location.href = "{!! URL::current() !!}";
                        }, 2000);
                        notify(data.success, 'success');
                    }else {
                        notify(data.error, 'error');
                    }
                }).fail(function (data) {
                    //below not displaying in notify with 422 so above...
                    //notify(data.error, 'error');
                    notify('@lang('bt.unknown_error')', 'error');
                });}

            } else if (result.dismiss === Swal.DismissReason.cancel) {

            }
        });
    }

    function bulkConfirm(title, message, route, ids, status) {

        Swal.fire({
            title: title,
            html: message,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d68500',
            confirmButtonText: '@lang('bt.yes_sure')'
        }).then((result) => {
            if (result.value) {
                $.post(route, {
                    ids: ids,
                    status: status
                }).done(function (data) {
                    setTimeout(function () { //give notify a chance to display before redirect
                        window.location.href = "{!! URL::current() !!}";
                    }, 2000);
                    notify(data.success, 'success');
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

        $(document).on('click','.create-quote', function () {
            clientName = $(this).data('unique-name');
            $('#modal-placeholder').load('{{ route('quotes.create') }}');
        });

        $(document).on('click','.create-workorder',function () {
            clientName = $(this).data('unique-name');
            $('#modal-placeholder').load('{{ route('workorders.create') }}');
        });

        $(document).on('click','.create-invoice',function () {
            clientName = $(this).data('unique-name');
            $('#modal-placeholder').load('{{ route('invoices.create') }}');
        });

        $(document).on('click','.create-purchaseorder',function () {
            vendorName = $(this).data('name');
            productid = $(this).data('productid');
            $('#modal-placeholder').load('{{ route('purchaseorders.create') }}');
        });

        $(document).on('click','.receive-purchaseorder',function () {
            $('#modal-placeholder').load('{{ route('purchaseorders.receive') }} ', {
                purchaseorder_id: $(this).data('purchaseorder-id')
                //redirectTo: $(this).data('redirect-to')
            });
        });


        $(document).on('click','.create-recurring-invoice',function () {
            clientName = $(this).data('unique-name');
            $('#modal-placeholder').load('{{ route('recurringInvoices.create') }}');
        });

        $(document).on('click', '.email-quote', function () {
            $('#modal-placeholder').load('{{ route('quoteMail.create') }}', {
                quote_id: $(this).data('quote-id'),
                redirectTo: $(this).data('redirect-to')
            }, function (response, status, xhr) {
                if (status == 'error') {
                    notify('@lang('bt.problem_with_email_template')','error');
                }
            });
        });

        $(document).on('click', '.email-invoice', function () {
            $('#modal-placeholder').load('{{ route('invoiceMail.create') }}', {
                invoice_id: $(this).data('invoice-id'),
                redirectTo: $(this).data('redirect-to')
            }, function (response, status, xhr) {
                if (status == 'error') {
                    notify('@lang('bt.problem_with_email_template')','error');
                }
            });
        });

        $(document).on('click', '.email-purchaseorder', function () {
            $('#modal-placeholder').load('{{ route('purchaseorderMail.create') }}', {
                purchaseorder_id: $(this).data('purchaseorder-id'),
                redirectTo: $(this).data('redirect-to')
            }, function (response, status, xhr) {
                if (status == 'error') {
                    notify('@lang('bt.problem_with_email_template')','error');
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

        $(document).on('click', '.enter-multi-payment', function () {
            $('#modal-placeholder').load('{{ route('payments.create') }}', {
                redirectTo: $(this).data('redirect-to')
            });
        });

        $(document).on('click','#bulk-select-all', function() {
            if ($(this).prop('checked')) {
                $(this).closest('table').find('.bulk-record').prop('checked', true);
                if ($('.bulk-record:checked').length > 0) {
                    $('.bulk-actions').show();
                }
            }
            else {
                $(this).closest('table').find('.bulk-record').prop('checked', false);
                $('.bulk-actions').hide();
            }
        });

        $(document).on('click','.bulk-record', function() {
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
        const height = obj.contentWindow.document.body.scrollHeight;

        if (height < minHeight) {
            obj.style.height = minHeight + 'px';
        }
        else {
            obj.style.height = (height + 50) + 'px';
        }
    }

    jQuery(document).ready(function() {
        var offset = 30;
        var duration = 300;
        jQuery(window).scroll(function() {
            if (jQuery(this).scrollTop() > offset) {
                jQuery('.back-to-top').fadeIn(duration);
            } else {
                jQuery('.back-to-top').fadeOut(duration);
            }
        });
        jQuery('.back-to-top').click(function(event) {
            event.preventDefault();
            jQuery('html, body').animate({scrollTop: 0}, duration);
            return false;
        })
    });
</script>
