<div class="card card-light">

    <div class="card-body">

        <span class="float-left"><strong>{{ trans('fi.subtotal') }}</strong></span><span
            class="float-right">{{ $quote->amount->formatted_subtotal }}</span>

        <div class="clearfix"></div>

        @if ($quote->discount > 0)
            <span class="float-left"><strong>{{ trans('fi.discount') }}</strong></span><span
                class="float-right">{{ $quote->amount->formatted_discount }}</span>

            <div class="clearfix"></div>
        @endif

        <span class="float-left"><strong>{{ trans('fi.tax') }}</strong></span><span
            class="float-right">{{ $quote->amount->formatted_tax }}</span>

        <div class="clearfix"></div>

        <span class="float-left"><strong>{{ trans('fi.total') }}</strong></span><span
            class="float-right">{{ $quote->amount->formatted_total }}</span>

        <div class="clearfix"></div>

    </div>

</div>