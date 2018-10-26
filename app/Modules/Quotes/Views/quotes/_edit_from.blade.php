@include('quotes._js_edit_from')

<div class="card card-light">
    <div class="card-header">
        <h3 class="card-title">{{ trans('fi.from') }}</h3>

        <div class="card-tools pull-right">
            <button class="btn btn-default btn-sm" id="btn-change-company_profile">
                <i class="fa fa-exchange"></i> {{ trans('fi.change') }}
            </button>
        </div>
    </div>
    <div class="card-body">
        <strong>{{ $quote->companyProfile->company }}</strong><br>
        {!! $quote->companyProfile->formatted_address !!}<br>
        {{ trans('fi.phone') }}: {{ $quote->companyProfile->phone }}<br>
        {{ trans('fi.email') }}: {{ $quote->user->email }}
    </div>
</div>