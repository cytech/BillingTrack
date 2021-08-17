<script type="text/javascript">

    $(function () {

        $("#next_date").datetimepicker({format: '{{ config('bt.dateFormat') }}', timepicker: false, scrollInput: false});
        $("#stop_date").datetimepicker({format: '{{ config('bt.dateFormat') }}', timepicker: false, scrollInput: false});

        $('#btn-add-product').click(function() {
            $('#modal-placeholder').load('{{ route( 'products.ajax.getProduct', 0) }}');// vendorid 0 for all except purchase order
        });

        $('#btn-add-employee').click(function() {
            $('#modal-placeholder').load('{{ route( 'employees.ajax.getEmployee') }}');
        });

        $('#btn-add-lookup').click(function() {
            $('#modal-placeholder').load('{{ route( 'itemLookups.ajax.getItemLookup') }}');
        });

        $('textarea').autosize();

        $('#btn-copy-recurring-invoice').click(function () {
            $('#modal-placeholder').load('{{ route('recurringInvoiceCopy.create') }}', {
                recurring_invoice_id: {{ $recurringInvoice->id }}
            });
        });

        $('#btn-update-exchange-rate').click(function () {
            updateExchangeRate();
        });

        $('#currency_code').change(function () {
            updateExchangeRate();
        });

        function updateExchangeRate() {
            $.post('{{ route('currencies.getExchangeRate') }}', {
                currency_code: $('#currency_code').val()
            }, function (data) {
                $('#exchange_rate').val(data);
            });
        }

        $('.btn-delete-recurring-invoice-item').click(function () {
            const id = $(this).data('item-id');
            deleteConfirm('@lang('bt.trash_record_warning')', '{{ route('recurringInvoiceItem.delete') }}', id,
                    '{{ route('recurringInvoices.recurringInvoiceEdit.refreshTotals') }}', '{{ $recurringInvoice->id }}' );
        });

        $('.btn-save-recurring-invoice').click(function () {
            const items = [];
            let display_order = 1;
            const custom_fields = {};
            const apply_exchange_rate = $(this).data('apply-exchange-rate');

            $('table tr.item').each(function () {
                const row = {};
                $(this).find('input,select,textarea').each(function () {
                    if ($(this).attr('name') !== undefined) {
                        if ($(this).is(':checkbox')) {
                            if ($(this).is(':checked')) {
                                row[$(this).attr('name')] = 1;
                            }
                            else {
                                row[$(this).attr('name')] = 0;
                            }
                        }
                        else {
                            row[$(this).attr('name')] = $(this).val();
                        }
                    }
                });
                row['display_order'] = display_order;
                display_order++;
                items.push(row);
            });

            $('.custom-form-field').each(function () {
                const fieldName = $(this).data('recurring_invoices-field-name');
                if (fieldName !== undefined) {
                    custom_fields[$(this).data('recurring_invoices-field-name')] = $(this).val();
                }
            });

            swalSaving();

            $.post('{{ route('recurringInvoices.update', [$recurringInvoice->id]) }}', {
                items: items,
                terms: $('#terms').val(),
                footer: $('#footer').val(),
                currency_code: $('#currency_code').val(),
                exchange_rate: $('#exchange_rate').val(),
                custom: custom_fields,
                apply_exchange_rate: apply_exchange_rate,
                template: $('#template').val(),
                summary: $('#summary').val(),
                discount: $('#discount').val(),
                next_date: $('#next_date').val(),
                stop_date: $('#stop_date').val(),
                recurring_frequency: $('#recurring_frequency').val(),
                recurring_period: $('#recurring_period').val(),
                group_id: $('#group_id').val()
            }).done(function () {
                $('#div-recurring-invoice-edit').load('{{ route('recurringInvoices.recurringInvoiceEdit.refreshEdit', [$recurringInvoice->id]) }}', function () {
                    notify('@lang('bt.record_successfully_updated')', 'success');
                });
            }).fail(function (response) {
                if (response.status == 422) {
                    let msg = '';
                    $.each($.parseJSON(response.responseText).errors, function (id, message) {
                        msg += message + '\n';
                    });
                    notify(msg, 'error');
                } else {
                    notify('@lang('bt.unknown_error')', 'error');
                }
            });
        });

        const fixHelper = function (e, tr) {
            const $originals = tr.children();
            const $helper = tr.clone();
            $helper.children().each(function (index) {
                $(this).width($originals.eq(index).width())
            });
            return $helper;
        };

        $("#item-table tbody").sortable({
            helper: fixHelper
        });

    });

</script>
