
<div class="btn-group">
    <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown">
        @lang('fi.options')
    </button>
    <div class="dropdown-menu dropdown-menu-right" role="menu">
        <a class="dropdown-item" href ="{{ route('invoices.edit', [$id]) }}"><i
                        class="fa fa-edit"></i> @lang('fi.edit')</a>
        <a class="dropdown-item" href ="{{ route('invoices.pdf', [$id]) }}" target="_blank"
               id="btn-pdf-invoice"><i class="fa fa-print"></i> @lang('fi.pdf')</a>
        <a class="dropdown-item email-invoice" href ="javascript:void(0)" data-invoice-id="{{ $id }}"
               data-redirect-to="{{ request()->fullUrl() }}"><i
                        class="fa fa-envelope"></i> @lang('fi.email')</a>
        <a class="dropdown-item" href ="{{ route('clientCenter.public.invoice.show', [$url_key]) }}"
               target="_blank" id="btn-public-invoice"><i
                        class="fa fa-globe"></i> @lang('fi.public')</a>

        @if ($model->isPayable or config('fi.allowPaymentsWithoutBalance'))
            <a class="dropdown-item enter-payment" href ="javascript:void(0)" id="btn-enter-payment"
                   data-invoice-id="{{ $id }}"
                   {{--data-invoice-balance="{{ $amount->formatted_numeric_balance }}"--}}
                   data-redirect-to="{{ request()->fullUrl() }}"><i
                            class="fa fa-credit-card"></i> @lang('fi.enter_payment')</a>
        @endif
        <div class="dropdown-divider"></div>

        <a class="dropdown-item" href ="#"
               onclick="swalConfirm('@lang('fi.trash_record_warning')', '{{ route('invoices.delete', [$id]) }}');"><i
                        class="fa fa-trash-alt"></i> @lang('fi.trash')</a>
    </div>
</div>