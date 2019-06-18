@include('purchaseorders._js_edit_from')

<div class="card card-light">
    <div class="card-header">
        <h3 class="card-title">@lang('bt.from')</h3>

        <div class="card-tools float-right">
            <button class="btn btn-secondary btn-sm" id="btn-change-company-profile">
                <i class="fa fa-exchange"></i> @lang('bt.change')
            </button>
        </div>
    </div>
    <div class="card-body">
        <strong>{{ $purchaseorder->companyProfile->company }}</strong><br>
        {!! $purchaseorder->companyProfile->formatted_address !!}<br>
        @lang('bt.phone'): {{ $purchaseorder->companyProfile->phone }}<br>
        @lang('bt.email'): {{ $purchaseorder->user->email }}
    </div>
</div>
