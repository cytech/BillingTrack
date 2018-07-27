<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>{{ trans('fi.past_days') }}</label>
            {!! Form::text('setting[schedulerPastdays]', config('fi.schedulerPastdays'), ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>{{ trans('fi.event_limit') }}</label>
            {!! Form::text('setting[schedulerEventLimit]', config('fi.schedulerEventLimit'), ['class' => 'form-control']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>{{ trans('fi.enable_cwo') }}</label>
            {!! Form::select('setting[schedulerCreateWorkorder]', ['0' => 'No', '1' => 'Yes'], config('fi.schedulerCreateWorkorder'), ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>{{ trans('fi.fc_themesystem') }}</label>
            {!! Form::select('setting[schedulerFcThemeSystem]', ['standard' => 'Standard', 'bootstrap3' => 'Bootstrap3', 'jquery-ui' => 'JQuery-ui'], config('fi.schedulerFcThemeSystem'), ['class' => 'form-control']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>{{ trans('fi.timestep') }}</label>
            {!! Form::select('setting[schedulerTimestep]',['60' => '60', '30' => '30', '15' => '15', '10' => '10','5' => '5','1' => '1'], config('fi.schedulerTimestep'), ['class' => 'form-control' ]) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>{{ trans('fi.fc_aspectratio') }}</label>
            {!! Form::number('setting[schedulerFcAspectRatio]', config('fi.schedulerFcAspectRatio'), ['min'=>'1', 'max'=>'2','step'=>'.05','class' => 'form-control' ]) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label>{{ trans('fi.coreeventslist') }}</label>
            <div class="col-lg-8 col-sm-8">
                @foreach (\FI\Modules\Settings\Models\Setting::$coreevents as $entityType => $value)
                    <div class="checkbox">
                        <label for="enabledCoreEvents{{ $value}}">
                            <input name="enabledCoreEvents[]" id="enabledCoreEvents{{ $value}}" type="checkbox" {{ (new \FI\Modules\Settings\Models\Setting())->isCoreeventEnabled($entityType) ? 'checked="checked"' : '' }} value="{{ $value }}">{{ trans("fi.{$entityType}") }}</label>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>