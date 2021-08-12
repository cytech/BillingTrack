
<div class="btn-group">
    <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown">
        @lang('bt.options')
    </button>
    <div class="dropdown-menu dropdown-menu-right" role="menu">
        <a class="dropdown-item" href ="{{ route('invoices.edit', [$id]) }}"><i
                        class="fa fa-edit"></i> @lang('bt.edit')</a>
        <a class="dropdown-item" href ="{{ route('invoices.pdf', [$id]) }}" target="_blank"
               id="btn-pdf-invoice"><i class="fa fa-print"></i> @lang('bt.pdf')</a>
        @if (config('bt.mailConfigured'))
        <a class="dropdown-item email-invoice" href ="javascript:void(0)" data-invoice-id="{{ $id }}"
               data-redirect-to="{{ request()->fullUrl() }}"><i
                        class="fa fa-envelope"></i> @lang('bt.email')</a>
        @endif
        <a class="dropdown-item" href ="{{ route('clientCenter.public.invoice.show', [$url_key]) }}"
               target="_blank" id="btn-public-invoice"><i
                        class="fa fa-globe"></i> @lang('bt.public')</a>

        @if ($model->isPayable or config('bt.allowPaymentsWithoutBalance'))
            <a class="dropdown-item enter-payment" href ="javascript:void(0)" id="btn-enter-payment"
                   data-invoice-id="{{ $id }}"
                   {{--data-invoice-balance="{{ $amount->formatted_numeric_balance }}"--}}
                   data-redirect-to="{{ request()->fullUrl() }}"><i
                            class="fa fa-credit-card"></i> @lang('bt.enter_payment')</a>
        @endif
        <div class="dropdown-divider"></div>

        @if($model->quote || $model->workorder)
            <a class="dropdown-item" href="#"
               onclick="swalConfirm('@lang('bt.trash_record_warning')','@lang('bt.trash_invoice_warning_assoc_msg')', '{{ route('invoices.delete', [$id]) }}');"><i
                        class="fa fa-trash-alt"></i> @lang('bt.trash')</a>
        @else
            <a class="dropdown-item" href="#"
               onclick="swalConfirm('@lang('bt.trash_record_warning')', '@lang('bt.trash_invoice_warning_msg')', '{{ route('invoices.delete', [$id]) }}');"><i
                        class="fa fa-trash-alt"></i> @lang('bt.trash')</a>
        @endif
    </div>
</div>
