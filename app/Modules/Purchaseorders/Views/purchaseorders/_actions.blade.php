
<div class="btn-group">
    <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown">
        @lang('bt.options')
    </button>
    <div class="dropdown-menu dropdown-menu-right" role="menu">
        <a class="dropdown-item" href ="{{ route('purchaseorders.edit', [$id]) }}"><i
                        class="fa fa-edit"></i> @lang('bt.edit')</a>
        @if($model->status_text != 'received')
        <a class="dropdown-item receive-purchaseorder" href="javascript:void(0)" data-purchaseorder-id="{{ $id }}" ><i
                    class="fa fa-arrow-alt-circle-right" ></i> @lang('bt.receive')</a>
        @endif
        <a class="dropdown-item" href ="{{ route('purchaseorders.pdf', [$id]) }}" target="_blank"
               id="btn-pdf-purchaseorder"><i class="fa fa-print"></i> @lang('bt.pdf')</a>
        @if (config('bt.mailConfigured'))
        <a class="dropdown-item email-purchaseorder" href ="javascript:void(0)" data-purchaseorder-id="{{ $id }}"
               data-redirect-to="{{ request()->fullUrl() }}"><i
                        class="fa fa-envelope"></i> @lang('bt.email')</a>
        @endif
{{--        <a class="dropdown-item" href ="{{ route('vendorCenter.public.purchaseorder.show', [$url_key]) }}"--}}
{{--               target="_blank" id="btn-public-purchaseorder"><i--}}
{{--                        class="fa fa-globe"></i> @lang('bt.public')</a>--}}

{{--        @if ($model->isPayable or config('bt.allowPaymentsWithoutBalance'))--}}
{{--            <a class="dropdown-item enter-payment" href ="javascript:void(0)" id="btn-enter-payment"--}}
{{--                   data-purchaseorder-id="{{ $id }}"--}}
{{--                   --}}{{--data-purchaseorder-balance="{{ $amount->formatted_numeric_balance }}"--}}
{{--                   data-redirect-to="{{ request()->fullUrl() }}"><i--}}
{{--                            class="fa fa-credit-card"></i> @lang('bt.enter_payment')</a>--}}
{{--        @endif--}}
        <div class="dropdown-divider"></div>

        <a class="dropdown-item" href ="#"
               onclick="swalConfirm('@lang('bt.trash_record_warning')', '', '{{ route('purchaseorders.delete', [$id]) }}');"><i
                        class="fa fa-trash-alt"></i> @lang('bt.trash')</a>
    </div>
</div>
