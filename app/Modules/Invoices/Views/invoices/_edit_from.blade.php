@include('invoices._js_edit_from')

<div class="card card-light">
    <div class="card-header">
        <h3 class="card-title">@lang('fi.from')</h3>

        <div class="card-tools float-right">
            <button class="btn btn-secondary btn-sm" id="btn-change-company-profile">
                <i class="fa fa-exchange"></i> @lang('fi.change')
            </button>
        </div>
    </div>
    <div class="card-body">
        <strong>{{ $invoice->companyProfile->company }}</strong><br>
        {!! $invoice->companyProfile->formatted_address !!}<br>
        @lang('fi.phone'): {{ $invoice->companyProfile->phone }}<br>
        @lang('fi.email'): {{ $invoice->user->email }}
    </div>
</div>