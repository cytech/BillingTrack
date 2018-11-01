@include('layouts._datepicker')

@include('quotes._js_quote_to_invoice')

<div class="modal fade" id="modal-quote-to-invoice">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{ trans('fi.quote_to_invoice') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">

                <div id="modal-status-placeholder"></div>

                <form >

                    <div class="form-group d-flex align-items-center">
                        <label class="col-sm-4 text-right text">{{ trans('fi.date') }}</label>

                        <div class="col-sm-8">
                            {!! Form::text('invoice_date', $invoice_date, ['id' => 'to_invoice_date', 'class' => 'form-control']) !!}
                        </div>
                    </div>

                    <div class="form-group d-flex align-items-center">
                        <label class="col-sm-4 text-right text">{{ trans('fi.group') }}</label>

                        <div class="col-sm-8">
                            {!! Form::select('group_id', $groups, config('fi.invoiceGroup'), ['id' => 'to_invoice_group_id', 'class' => 'form-control']) !!}
                        </div>
                    </div>

                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('fi.cancel') }}</button>
                <button type="button" id="btn-quote-to-invoice-submit"
                        class="btn btn-primary">{{ trans('fi.submit') }}</button>
            </div>
        </div>
    </div>
</div>