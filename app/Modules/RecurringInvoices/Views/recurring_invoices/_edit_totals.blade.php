<div class="card card-light">
    <div class="card-body">
        <span class="float-left"><strong>@lang('bt.subtotal')</strong></span><span
            class="float-right">{{ $recurringInvoice->amount->formatted_subtotal }}</span>

        <div class="clearfix"></div>

        @if ($recurringInvoice->discount > 0)
            <span class="float-left"><strong>@lang('bt.discount')</strong></span><span
                class="float-right">{{ $recurringInvoice->amount->formatted_discount }}</span>

            <div class="clearfix"></div>
        @endif

        <span class="float-left"><strong>@lang('bt.tax')</strong></span><span
            class="float-right">{{ $recurringInvoice->amount->formatted_tax }}</span>

        <div class="clearfix"></div>
        <span class="float-left"><strong>@lang('bt.total')</strong></span><span
            class="float-right">{{ $recurringInvoice->amount->formatted_total }}</span>

        <div class="clearfix"></div>
    </div>
</div>
