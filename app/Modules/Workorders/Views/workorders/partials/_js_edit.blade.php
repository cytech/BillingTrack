<script type="text/javascript">

    $(function () {

        $("#workorder_date").datepicker({format: '{{ config('fi.datepickerFormat') }}', autoclose: true});
        $("#expires_at").datepicker({format: '{{ config('fi.datepickerFormat') }}', autoclose: true});
        $("#job_date").datepicker({format: '{{ config('fi.datepickerFormat') }}',
            todayHighlight:true,
            autoclose: true});
        $("#start_time").timepicker({
            minuteStep: {!! config('fi.schedulerTimestep') !!},
            template: 'dropdown',
            appendWidgetTo: 'body',
            showSeconds: false,
            showMeridian: false,
            modalBackdrop: false,
            defaultTime: '08:00 AM',
            autoclose: true}
            );
        $("#end_time").timepicker({
            minuteStep: {!! config('fi.schedulerTimestep') !!},
            template: 'dropdown',
            appendWidgetTo: 'body',
            showSeconds: false,
            showMeridian: false,
            modalBackdrop: false,
            defaultTime: '09:00 AM',
            autoclose: true}
        );


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
                client_id: {{ $workorder->client_id }}
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
            var id = $(this).data('item-id');
            deleteConfirm('{!! trans('fi.trash_record_warning') !!}', '{{ route('workorderItem.delete') }}', id,
                '{{ route('workorderEdit.refreshTotals') }}', '{{ $workorder->id }}' );
        });

        $('.btn-save-workorder').click(function () {
            var items = [];
            var display_order = 1;
            var custom_fields = {};
            var apply_exchange_rate = $(this).data('apply-exchange-rate');

            $('table tr.item').each(function () {
                var row = {};
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
                var fieldName = $(this).data('workorders-field-name');
                if (fieldName !== undefined) {
                    custom_fields[$(this).data('workorders-field-name')] = $(this).val();
                }
            });

            var willcall = 0;
            if ($("#will_call").prop('checked')){
                willcall = 1;
            }

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
                $('#div-workorder-edit').load('{{ route('workorderEdit.refreshEdit', [$workorder->id]) }}', function() {
                    notify('{{ trans('fi.workorder_successfully_updated') }}', 'success');
                });
            }).fail(function (response) {
                if (response.status == 422) {
                    var msg ='';
                    $.each($.parseJSON(response.responseText).errors, function (id, message) {
                        msg += message + '\n';
                    });
                    notify(msg, 'error');
                } else {
                    notify('{{ trans('fi.unknown_error') }}', 'error');
                }
            });
        });

        var fixHelper = function (e, tr) {
            var $originals = tr.children();
            var $helper = tr.clone();
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