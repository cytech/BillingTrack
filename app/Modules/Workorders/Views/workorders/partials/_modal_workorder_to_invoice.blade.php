

@include('workorders.partials._js_workorder_to_invoice')

<div class="modal fade" id="modal-workorder-to-invoice">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('bt.workorder_to_invoice')</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">

                <div id="modal-status-placeholder"></div>

                <form>

                    <div class="form-group d-flex align-items-center">
                        <label class="col-sm-4 text-right text">@lang('bt.invoice_date')</label>

                        <div class="col-sm-8">
                            {{--{!! Form::text('created_at', $created_at, ['id' => 'to_invoice_created_at', 'class' => 'form-control']) !!}--}}
                            {!! Form::text('workorder_date', $workorder_date, ['id' => 'to_invoice_workorder_date', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group d-flex align-items-center">
                        <label class="col-sm-4 text-right text">@lang('bt.group')</label>

                        <div class="col-sm-8">
                            {!! Form::select('group_id', $groups, config('bt.invoiceGroup'), ['id' => 'to_invoice_group_id', 'class' => 'form-control']) !!}
                        </div>
                    </div>

                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('bt.cancel')</button>
                <button type="button" id="btn-workorder-to-invoice-submit"
                        class="btn btn-primary">@lang('bt.submit')</button>
            </div>
        </div>
    </div>
</div>
