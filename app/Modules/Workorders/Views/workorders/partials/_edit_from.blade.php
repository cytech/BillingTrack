@include('workorders.partials._js_edit_from')

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
        <strong>{{ $workorder->companyProfile->company }}</strong><br>
        {!! $workorder->companyProfile->formatted_address !!}<br>
        @lang('fi.phone'): {{ $workorder->companyProfile->phone }}<br>
        @lang('fi.email'): {{ $workorder->user->email }}
    </div>
</div>