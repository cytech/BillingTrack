<div class="btn-group">
    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
        {{ trans('fi.options') }} <span class="caret"></span>
    </button>
    <ul class="dropdown-menu dropdown-menu-right">
        <li><a href="{{ route('payments.edit', [$id]) }}"><i class="fa fa-edit"></i> {{ trans('fi.edit') }}</a></li>
        <li><a href="{{ route('invoices.pdf', [$model->invoice->id]) }}" target="_blank" id="btn-pdf-invoice"><i class="fa fa-print"></i> {{ trans('fi.invoice') }}</a></li>
        @if (config('fi.mailConfigured'))
            <li><a href="javascript:void(0)" class="email-payment-receipt" data-payment-id="{{ $id }}" data-redirect-to="{{ request()->fullUrl() }}"><i class="fa fa-envelope"></i> {{ trans('fi.email_payment_receipt') }}</a></li>
        @endif
        <li><a href="#"
               onclick="swalConfirm('{{ trans('fi.trash_record_warning') }}', '{{ route('payments.delete', [$id]) }}');"><i class="fa fa-trash-o"></i> {{ trans('fi.trash') }}</a></li>
    </ul>
</div>

