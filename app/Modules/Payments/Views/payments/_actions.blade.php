<div class="btn-group">
    <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown">
        @lang('fi.options')
    </button>
    <div class="dropdown-menu dropdown-menu-right" role="menu">
        <a class="dropdown-item" href ="{{ route('payments.edit', [$id]) }}"><i class="fa fa-edit"></i> @lang('fi.edit')</a>
        <a class="dropdown-item" href ="{{ route('invoices.pdf', [$model->invoice->id]) }}" target="_blank" id="btn-pdf-invoice"><i class="fa fa-print"></i> @lang('fi.invoice')</a>
        @if (config('fi.mailConfigured'))
            <a class="dropdown-item email-payment-receipt" href ="javascript:void(0)" data-payment-id="{{ $id }}" data-redirect-to="{{ request()->fullUrl() }}"><i class="fa fa-envelope"></i> @lang('fi.email_payment_receipt')</a>
        @endif
        <div class="dropdown-divider"></div>

        <a class="dropdown-item" href ="#"
               onclick="swalConfirm('@lang('fi.trash_record_warning')', '{{ route('payments.delete', [$id]) }}');"><i class="fa fa-trash-alt"></i> @lang('fi.trash')</a>
    </div>
</div>

