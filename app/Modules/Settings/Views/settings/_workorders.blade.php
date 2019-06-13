<div class="row">

    <div class="col-md-3">
        <div class="form-group">
            <label>@lang('bt.default_workorder_template'): </label>
            {!! Form::select('setting[workorderTemplate]', $workorderTemplates, config('bt.workorderTemplate'), ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <label>@lang('bt.default_group'): </label>
            {!! Form::select('setting[workorderGroup]', $groups, config('bt.workorderGroup'), ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <label>@lang('bt.workorders_expire_after'): </label>
            {!! Form::text('setting[workordersExpireAfter]', config('bt.workordersExpireAfter'), ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <label>@lang('bt.default_status_filter'): </label>
            {!! Form::select('setting[workorderStatusFilter]', $workorderStatuses, config('bt.workorderStatusFilter'), ['class' => 'form-control']) !!}
        </div>
    </div>

</div>

<div class="form-group">
    <label>@lang('bt.convert_workorder_when_approved'): </label>
    {!! Form::select('setting[convertWorkorderWhenApproved]', $yesNoArray, config('bt.convertWorkorderWhenApproved'), ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    <label>@lang('bt.convert_workorder_setting'): </label>
    {!! Form::select('setting[convertWorkorderTerms]', $convertWorkorderOptions, config('bt.convertWorkorderTerms'), ['class' => 'form-control']) !!}
    {!! Form::select('setting[convertWorkorderDate]', $convertWorkorderDate, config('bt.convertWorkorderDate'), ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    <label>@lang('bt.default_terms'): </label>
    {!! Form::textarea('setting[workorderTerms]', config('bt.workorderTerms'), ['class' => 'form-control', 'rows' => 2]) !!}
</div>

<div class="form-group">
    <label>@lang('bt.default_footer'): </label>
    {!! Form::textarea('setting[workorderFooter]', config('bt.workorderFooter'), ['class' => 'form-control', 'rows' => 2]) !!}
</div>
<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label>@lang('bt.if_workorder_is_emailed_while_draft'): </label>
            {!! Form::select('setting[resetWorkorderDateEmailDraft]', $workorderWhenDraftOptions, config('bt.resetWorkorderDateEmailDraft'), ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-md-6"></div>
    <div class="col-md-3">
        <div class="form-group">
            <label>@lang('bt.recalculate_workorders'): </label><br>
            @if (!config('app.demo'))
            <button type="button" class="btn btn-secondary" id="btn-recalculate-workorders"
                    data-loading-text="@lang('bt.recalculating_wait')">@lang('bt.recalculate')</button>
            @else
                Recalculate is disabled in the demo.
            @endif
            <p class="form-text text-muted">@lang('bt.recalculate_help_text')</p>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label>@lang('bt.wo_timesheet_companyname')</label>
            {!! Form::text('setting[tsCompanyName]', config('bt.tsCompanyName'),
                            ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>@lang('bt.wo_timesheet_companycreatetime') </label>
            {!! Form::text('setting[tsCompanyCreate]', config('bt.tsCompanyCreate'),
                            ['class' => 'form-control']) !!}
        </div>
    </div>
</div>
