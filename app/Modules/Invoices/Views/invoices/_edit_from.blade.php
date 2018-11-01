@include('invoices._js_edit_from')

<div class="card card-light">
    <div class="card-header">
        <h3 class="card-title">{{ trans('fi.from') }}</h3>

        <div class="card-tools float-right">
            <button class="btn btn-default btn-sm" id="btn-change-company-profile">
                <i class="fa fa-exchange"></i> {{ trans('fi.change') }}
            </button>
        </div>
    </div>
    <div class="card-body">
        <strong>{{ $invoice->companyProfile->company }}</strong><br>
        {!! $invoice->companyProfile->formatted_address !!}<br>
        {{ trans('fi.phone') }}: {{ $invoice->companyProfile->phone }}<br>
        {{ trans('fi.email') }}: {{ $invoice->user->email }}
    </div>
</div>