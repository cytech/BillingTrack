
<div class="btn-group">
    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
        {{ trans('fi.options') }} <span class="caret"></span>
    </button>
    <ul class="dropdown-menu dropdown-menu-right">
        <li><a href="{{ route('invoices.edit', [$id]) }}"><i
                        class="fa fa-edit"></i> {{ trans('fi.edit') }}</a></li>
        <li><a href="{{ route('invoices.pdf', [$id]) }}" target="_blank"
               id="btn-pdf-invoice"><i class="fa fa-print"></i> {{ trans('fi.pdf') }}</a></li>
        <li><a href="javascript:void(0)" class="email-invoice" data-invoice-id="{{ $id }}"
               data-redirect-to="{{ request()->fullUrl() }}"><i
                        class="fa fa-envelope"></i> {{ trans('fi.email') }}</a></li>
        <li><a href="{{ route('clientCenter.public.invoice.show', [$url_key]) }}"
               target="_blank" id="btn-public-invoice"><i
                        class="fa fa-globe"></i> {{ trans('fi.public') }}</a></li>
        {{-- TODO --}}
        {{--@if ($isPayable or config('fi.allowPaymentsWithoutBalance'))--}}
        @if (config('fi.allowPaymentsWithoutBalance'))
            <li><a href="javascript:void(0)" id="btn-enter-payment" class="enter-payment"
                   data-invoice-id="{{ $id }}"
                   {{--data-invoice-balance="{{ $amount->formatted_numeric_balance }}"--}}
                   data-redirect-to="{{ request()->fullUrl() }}"><i
                            class="fa fa-credit-card"></i> {{ trans('fi.enter_payment') }}</a></li>
        @endif
        <li><a href="#"
               onclick="swalConfirm('{{ trans('fi.trash_record_warning') }}', '{{ route('invoices.delete', [$id]) }}');"><i
                        class="fa fa-trash-o"></i> {{ trans('fi.trash') }}</a></li>
    </ul>
</div>