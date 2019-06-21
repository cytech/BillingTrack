{{--@include('purchaseorders._js_edit_shipto')--}}

<div class="card card-light">
    <div class="card-header">
        <h3 class="card-title">@lang('bt.ship_to')</h3>

{{--        <div class="card-tools float-right">--}}
{{--            <button class="btn btn-secondary btn-sm" id="btn-change-shipto"><i--}}
{{--                        class="fa fa-exchange"></i> @lang('bt.change')</button>--}}
{{--            <button class="btn btn-secondary btn-sm" id="btn-edit-shipto"--}}
{{--                    data-vendor-id="{{ $purchaseorder->vendor->id }}"><i--}}
{{--                        class="fa fa-pencil"></i> @lang('bt.edit')</button>--}}
{{--        </div>--}}
    </div>
    <div class="card-body">
        <strong>{{ $purchaseorder->companyProfile->company }}</strong><br>
        @if($purchaseorder->companyProfile->formatted_address2)
            {!! $purchaseorder->companyProfile->formatted_address2 !!}
        @else
            {!! $purchaseorder->companyProfile->formatted_address !!}<br>
        @endif
        @lang('bt.phone'): {{ $purchaseorder->companyProfile->phone }}<br>
        @lang('bt.email'): {{ $purchaseorder->companyProfile->email }}
    </div>
</div>
