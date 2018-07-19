@include('Workorders::workorders.partials._js_edit_from')

<div class="box box-primary">
    <div class="box-header">
        <h3 class="box-title">{{ trans('fi.from') }}</h3>

        <div class="box-tools pull-right">
            <button class="btn btn-default btn-sm" id="btn-change-company_profile">
                <i class="fa fa-exchange"></i> {{ trans('fi.change') }}
            </button>
        </div>
    </div>
    <div class="box-body">
        <strong>{{ $workorder->companyProfile->company }}</strong><br>
        {!! $workorder->companyProfile->formatted_address !!}<br>
        {{ trans('fi.phone') }}: {{ $workorder->companyProfile->phone }}<br>
        {{ trans('fi.email') }}: {{ $workorder->user->email }}
    </div>
</div>