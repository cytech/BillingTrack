<style>
    .xdsoft_datetimepicker .xdsoft_timepicker {
        width: 75px;
        float: left;
        text-align: center;
        margin-left: 8px;
        margin-top: 0;
    }
</style>
<script type="text/javascript">

    $(function () {

        $("#workorder_date").datetimepicker({format: '{{ config('bt.dateFormat') }}', timepicker: false, scrollInput: false});
        $("#expires_at").datetimepicker({format: '{{ config('bt.dateFormat') }}', timepicker: false, scrollInput: false});
        $("#job_date").datetimepicker({format: '{{ config('bt.dateFormat') }}', timepicker: false, scrollInput: false});

        $("#start_time").datetimepicker({
            datepicker: false,
            format: 'H:i',
            // format: 'm/d/Y g:i a',
            //validateOnBlur: false
            formatTime: '{{ config('bt.use24HourTimeFormat') ? 'H:i' : 'g:i A' }}',
            defaultTime: '08:00',
            step: {!! config('bt.schedulerTimestep') !!},//15
            // onClose: function (selectedTime) {
            //     $("#end_time").datetimepicker({minTime: selectedTime});
            // }
        });

        $('#end_time').datetimepicker({
            datepicker: false,
            format: 'H:i',
            formatTime: '{{ config('bt.use24HourTimeFormat') ? 'H:i' : 'g:i A' }}',
            step: {!! config('bt.schedulerTimestep') !!},
            // onClose: function (selectedTime) {
            //     $("#start_time").datetimepicker({maxTime: selectedTime});
            // }
        });

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

        $('#btn-copy-workorder').click(function () {
            $('#modal-placeholder').load('{{ route('workorderCopy.create') }}', {
                workorder_id: {{ $workorder->id }}
            });
        });

        $('#btn-workorder-to-invoice').click(function () {
            $('#modal-placeholder').load('{{ route('workorderToInvoice.create') }}', {
                workorder_id: {{ $workorder->id }},
                client_id: {{ $workorder->client_id }},
                job_date: '{{ $workorder->formatted_job_date }}'
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

        $('.btn-delete-workorder-item').click(function () {
            const id = $(this).data('item-id');
            deleteConfirm('@lang('bt.trash_record_warning')', '{{ route('workorderItem.delete') }}', id,
                '{{ route('workorders.workorderEdit.refreshTotals') }}', '{{ $workorder->id }}' );
        });

        $('.btn-save-workorder').click(function () {
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
                const fieldName = $(this).data('workorders-field-name');
                if (fieldName !== undefined) {
                    custom_fields[$(this).data('workorders-field-name')] = $(this).val();
                }
            });

            let willcall = 0;
            if ($("#will_call").prop('checked')){
                willcall = 1;
            }

            swalSaving();

            $.post('{{ route('workorders.update', [$workorder->id]) }}', {
                number: $('#number').val(),
                workorder_date: $('#workorder_date').val(),
                expires_at: $('#expires_at').val(),
                workorder_status_id: $('#workorder_status_id').val(),
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
                job_date: $('#job_date').val(),
                start_time: $('#start_time').val(),
                end_time: $('#end_time').val(),
                will_call: willcall
            }).done(function () {
                $('#div-workorder-edit').load('{{ route('workorders.workorderEdit.refreshEdit', [$workorder->id]) }}', function() {
                    notify('@lang('bt.workorder_successfully_updated')', 'success');
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
