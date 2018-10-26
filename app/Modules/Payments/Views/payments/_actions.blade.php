<div class="btn-group">
    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
        {{ trans('fi.options') }} <span class="caret"></span>
    </button>
    <div class="dropdown-menu dropdown-menu-right" role="menu">
        <a class="dropdown-item" href ="{{ route('payments.edit', [$id]) }}"><i class="fa fa-edit"></i> {{ trans('fi.edit') }}</a>
        <a class="dropdown-item" href ="{{ route('invoices.pdf', [$model->invoice->id]) }}" target="_blank" id="btn-pdf-invoice"><i class="fa fa-print"></i> {{ trans('fi.invoice') }}</a>
        @if (config('fi.mailConfigured'))
            <a class="dropdown-item" href ="javascript:void(0)" class="email-payment-receipt" data-payment-id="{{ $id }}" data-redirect-to="{{ request()->fullUrl() }}"><i class="fa fa-envelope"></i> {{ trans('fi.email_payment_receipt') }}</a>
        @endif
        <a class="dropdown-item" href ="#"
               onclick="swalConfirm('{{ trans('fi.trash_record_warning') }}', '{{ route('payments.delete', [$id]) }}');"><i class="fa fa-trash-alt"></i> {{ trans('fi.trash') }}</a>
    </div>
</div>

