<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>@lang('fi.past_days')</label>
            {!! Form::text('setting[schedulerPastdays]', config('fi.schedulerPastdays'), ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>@lang('fi.event_limit')</label>
            {!! Form::text('setting[schedulerEventLimit]', config('fi.schedulerEventLimit'), ['class' => 'form-control']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>@lang('fi.enable_cwo')</label>
            {!! Form::select('setting[schedulerCreateWorkorder]', ['0' => 'No', '1' => 'Yes'], config('fi.schedulerCreateWorkorder'), ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>@lang('fi.fc_themesystem')</label>
            {!! Form::select('setting[schedulerFcThemeSystem]', ['standard' => 'Standard', 'bootstrap4' => 'Bootstrap4', 'jquery-ui' => 'JQuery-ui'], config('fi.schedulerFcThemeSystem'), ['class' => 'form-control']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>@lang('fi.timestep')</label>
            {!! Form::select('setting[schedulerTimestep]',['60' => '60', '30' => '30', '15' => '15', '10' => '10','5' => '5','1' => '1'], config('fi.schedulerTimestep'), ['class' => 'form-control' ]) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>@lang('fi.fc_aspectratio')</label>
            {!! Form::number('setting[schedulerFcAspectRatio]', config('fi.schedulerFcAspectRatio'), ['min'=>'1', 'max'=>'2','step'=>'.05','class' => 'form-control' ]) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-2">
        <div class="form-group">
            <label>@lang('fi.coreeventslist')</label>
            <div class="col-lg-8 col-sm-8">
                @foreach (\FI\Modules\Settings\Models\Setting::$coreevents as $entityType => $value)
                    <div class="form-check">
                        <label for="enabledCoreEvents{{ $value}}">
                            <input name="enabledCoreEvents[]" id="enabledCoreEvents{{ $value}}" type="checkbox" {{ (new \FI\Modules\Settings\Models\Setting())->isCoreeventEnabled($entityType) ? 'checked="checked"' : '' }} value="{{ $value }}">{{ trans("fi.{$entityType}") }}</label>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label>@lang('fi.show_invoiced')</label>
            {!! Form::select('setting[schedulerDisplayInvoiced]', ['0' => 'No', '1' => 'Yes'], config('fi.schedulerDisplayInvoiced'), ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-md-8">
        <br>
        <span class="form-text text-muted">Display Defaults:</span><br>
        <span class="form-text text-muted">Quotes: if expires_at, else quote_date</span><br>
        <span class="form-text text-muted">Workorders: job_date</span><br>
        <span class="form-text text-muted">Invoices: If due_at, else invoice_date</span><br>
        <span class="form-text text-muted">Payments: paid_at</span><br>
        <span class="form-text text-muted">Expenses: expense_date</span><br>
        <span class="form-text text-muted">Projects: due_at</span><br>
        <span class="form-text text-muted">Tasks: start time of first timer in task</span>
    </div>
</div>