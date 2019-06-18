@include('purchaseorders._js_edit_to')

<div class="card card-light">
    <div class="card-header">
        <h3 class="card-title">@lang('bt.to')</h3>

        <div class="card-tools float-right">
            <button class="btn btn-secondary btn-sm" id="btn-change-vendor"><i
                    class="fa fa-exchange"></i> @lang('bt.change')</button>
            <button class="btn btn-secondary btn-sm" id="btn-edit-vendor" data-vendor-id="{{ $purchaseorder->vendor->id }}"><i
                    class="fa fa-pencil"></i> @lang('bt.edit')</button>
        </div>
    </div>
    <div class="card-body">
        <strong>{{ $purchaseorder->vendor->name }}</strong><br>
        {!! $purchaseorder->vendor->formatted_address !!}<br>
        @lang('bt.phone'): {{ $purchaseorder->vendor->phone }}<br>
        @lang('bt.email'): {{ $purchaseorder->vendor->email }}
    </div>
</div>
