
{{--@include('layouts._typeahead')--}}
{{--@include('clients._js_lookup')--}}
@include('payments._js_create')

<div class="modal fade" id="modal-enter-multi-payment">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('fi.enter_payment')</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">

                <div id="modal-status-placeholder"></div>

                <form>
                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}" id="user_id">

                    <div class="form-group d-flex align-items-center">
                        <label class="col-sm-4 text-right">@lang('fi.client')</label>

                        <div class="col-sm-8">
                            {!! Form::text('client_name', null, ['id' => 'create_client_name', 'class' =>
                            'form-control client-lookup', 'autocomplete' => 'off', 'typeahead-editable' => "false"]) !!}
                        </div>
                        <script>
                            $('#create_client_name').autocomplete({
                                appendTo: '#modal-enter-multi-payment',
                                source: '{{ route('clients.ajax.lookup') }}',
                                minLength: 3
                            }).autocomplete("widget");
                        </script>
                    </div>

                    <input type="hidden" name="invoice_id" id="invoice_id" value="">
                    <div class="form-group d-flex align-items-center">
                        <label class="col-sm-4 text-right">@lang('fi.invoice')</label>
                        <div class="col-sm-8">
                            {!! Form::select('client_invoices', [], null, ['id' => 'client_invoices', 'class' => 'form-control
                            client-invoices', 'autocomplete' => 'off', 'placeholder' => trans('fi.select_invoice')]) !!}
                        </div>
                    </div>

                    <input type="hidden" name="client_id" id="client_id" value="">

                    <div class="form-group d-flex align-items-center">
                        <label class="col-sm-4 text-right">@lang('fi.amount')</label>

                        <div class="col-sm-8">
                            {!! Form::text('payment_amount', null, ['id' => 'payment_amount', 'class' => 'form-control']) !!}
                        </div>
                    </div>

                    <div class="form-group d-flex align-items-center">
                        <label class="col-sm-4 text-right">@lang('fi.payment_date')</label>

                        <div class="col-sm-8">
                            {!! Form::text('payment_date', $date, ['id' => 'payment_date', 'class' => 'form-control']) !!}
                        </div>
                    </div>

                    <div class="form-group d-flex align-items-center">
                        <label class="col-sm-4 text-right">@lang('fi.payment_method')</label>

                        <div class="col-sm-8">
                            {!! Form::select('payment_method_id', $paymentMethods, null, ['id' => 'payment_method_id', 'class' => 'form-control']) !!}
                        </div>
                    </div>

                    <div class="form-group d-flex align-items-center">
                        <label class="col-sm-4 text-right">@lang('fi.note')</label>

                        <div class="col-sm-8">
                            {!! Form::textarea('payment_note', null, ['id' => 'payment_note', 'class' => 'form-control', 'rows' => 4]) !!}
                        </div>
                    </div>

                    {{--@if (config('fi.mailConfigured') and $client->email)--}}
                    @if (config('fi.mailConfigured'))
                        <div class="form-group d-flex align-items-center">
                            <label class="col-sm-4 text-right">@lang('fi.email_payment_receipt')</label>

                            <div class="col-sm-8">
                                {!! Form::checkbox('email_payment_receipt', 1, config('fi.automaticEmailPaymentReceipts'), ['id' => 'email_payment_receipt']) !!}
                            </div>
                        </div>
                    @endif

                    <div id="payment-custom-fields">
                        @if ($customFields->count())
                            @include('custom_fields._custom_fields_modal')
                        @endif
                    </div>

                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('fi.cancel')</button>
                <button type="button" id="enter-payment-confirm" class="btn btn-primary"
                        data-loading-text="@lang('fi.please_wait')...">@lang('fi.submit')</button>
            </div>
        </div>
    </div>
</div>
<script>

    $('#create_client_name').on('autocompleteselect', function (event, ui) {
        const clientName = ui.item.value;
        $.get('/invoices/ajaxLookup/' + clientName, function (data) {
            $('#client_invoices').empty();
            const first = $("<option></option>")
                .attr("value", 'first')
                .text('@lang('fi.select_invoice')');
            $('#client_invoices').append(first);
            $.each(JSON.parse(data), function (key, value) {
                const option = $("<option></option>")
                    .attr("value", value.id)
                    .attr("client_id", value.client_id)
                    .attr("amount", value.amount)
                    .text(value.number + ' - @lang('fi.invoice_date') ' + value.invoice_date + ' - @lang('fi.balance');  ' + value.amount);

                $('#client_invoices').append(option);

            });
        });
    });

    $('#client_invoices').change(function () {
        $('#client_invoices option[value="first"]').remove();
        const invoice_id = $('#client_invoices').val();
        $('#invoice_id').val(invoice_id);
        const client_id = $('#client_invoices option:selected ').attr("client_id");
        $('#client_id').val(client_id);
        const payment_amount = $('#client_invoices option:selected ').attr("amount");
        $('#payment_amount').val(payment_amount);
    });

</script>

