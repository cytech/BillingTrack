@include('quotes._js_edit_from')

<div class="card card-light">
    <div class="card-header">
        <h3 class="card-title">@lang('fi.from')</h3>

        <div class="card-tools float-right">
            <button class="btn btn-secondary btn-sm" id="btn-change-company_profile">
                <i class="fa fa-exchange"></i> @lang('fi.change')
            </button>
        </div>
    </div>
    <div class="card-body">
        <strong>{{ $quote->companyProfile->company }}</strong><br>
        {!! $quote->companyProfile->formatted_address !!}<br>
        @lang('fi.phone'): {{ $quote->companyProfile->phone }}<br>
        @lang('fi.email'): {{ $quote->user->email }}
    </div>
</div>