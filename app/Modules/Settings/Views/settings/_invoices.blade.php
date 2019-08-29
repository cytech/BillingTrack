<div class="row">

    <div class="col-md-3">
        <div class="form-group">
            <label>@lang('bt.default_invoice_template'): </label>
            {!! Form::select('setting[invoiceTemplate]', $invoiceTemplates, config('bt.invoiceTemplate'), ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <label>@lang('bt.default_group'): </label>
            {!! Form::select('setting[invoiceGroup]', $groups, config('bt.invoiceGroup'), ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <label>@lang('bt.invoices_due_after'): </label>
            {!! Form::text('setting[invoicesDueAfter]', config('bt.invoicesDueAfter'), ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <label>@lang('bt.default_status_filter'): </label>
            {!! Form::select('setting[invoiceStatusFilter]', $invoiceStatuses, config('bt.invoiceStatusFilter'), ['class' => 'form-control']) !!}
        </div>
    </div>

</div>
<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label>@lang('bt.update_inv_products'): </label>
            {!! Form::select('setting[updateInvProductsDefault]', ['0' => trans('bt.no'), '1' => trans('bt.yes')], config('bt.updateInvProductsDefault'), ['class' => 'form-control']) !!}
        </div>
    </div>
</div>
<div class="form-group">
    <label>@lang('bt.default_terms'): </label>
    {!! Form::textarea('setting[invoiceTerms]', config('bt.invoiceTerms'), ['class' => 'form-control', 'rows' => 2]) !!}
</div>

<div class="form-group">
    <label>@lang('bt.default_footer'): </label>
    {!! Form::textarea('setting[invoiceFooter]', config('bt.invoiceFooter'), ['class' => 'form-control', 'rows' => 2]) !!}
</div>

<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label>@lang('bt.automatic_email_on_recur'): </label>
            {!! Form::select('setting[automaticEmailOnRecur]', ['0' => trans('bt.no'), '1' => trans('bt.yes')], config('bt.automaticEmailOnRecur'), ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label>@lang('bt.automatic_email_payment_receipts'): </label>
            {!! Form::select('setting[automaticEmailPaymentReceipts]', ['0' => trans('bt.no'), '1' => trans('bt.yes')], config('bt.automaticEmailPaymentReceipts'), ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label>@lang('bt.online_payment_method'): </label>
            {!! Form::select('setting[onlinePaymentMethod]', $paymentMethods, config('bt.onlinePaymentMethod'), ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label>@lang('bt.allow_payments_without_balance'): </label>
            {!! Form::select('setting[allowPaymentsWithoutBalance]', $yesNoArray, config('bt.allowPaymentsWithoutBalance'), ['class' => 'form-control']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label>@lang('bt.if_invoice_is_emailed_while_draft'): </label>
            {!! Form::select('setting[resetInvoiceDateEmailDraft]', $invoiceWhenDraftOptions, config('bt.resetInvoiceDateEmailDraft'), ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-md-6"></div>
    <div class="col-md-3">
        <div class="form-group">
            <label>@lang('bt.recalculate_invoices'): </label><br>
            @if (!config('app.demo'))
            <button type="button" class="btn btn-secondary" id="btn-recalculate-invoices"
                    data-loading-text="@lang('bt.recalculating_wait')">@lang('bt.recalculate')</button>
            @else
                Recalculate is disabled in the demo.
            @endif
            <p class="form-text text-muted">@lang('bt.recalculate_help_text')</p>
        </div>
    </div>
</div>
