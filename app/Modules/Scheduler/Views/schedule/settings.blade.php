@extends('layouts.master')

@section('content')
    {{--@if(config('app.name') == 'FusionInvoice') {!! Form::breadcrumbs() !!} @endif--}}
    <div class="col-md-8 col-md-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i
                            class="fa fa-fw fa-table fa-fw"></i>{{ trans('fi.settings') }}</h3>
            </div>
            {{--@include('layouts._alerts')--}}
            <div class="panel-body">
                {!! Form::open(['route' => 'scheduler.settings']) !!}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ trans('fi.version') }}</label>
                            {!! Form::text('Version', config('schedule_settings.version'), ['class' => 'form-control' , 'readonly' => 'true']) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ trans('fi.past_days') }}</label>
                            {!! Form::text('Pastdays', config('schedule_settings.pastdays'), ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ trans('fi.event_limit') }}</label>
                            {!! Form::text('EventLimit', config('schedule_settings.eventLimit'), ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ trans('fi.enable_cwo') }}</label>
                            {!! Form::select('CreateWorkorder', ['0' => 'No', '1' => 'Yes'], config('schedule_settings.createWorkorder'), ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ trans('fi.fc_themesystem') }}</label>
                            {!! Form::select('FcThemeSystem', ['standard' => 'Standard', 'bootstrap3' => 'Bootstrap3', 'jquery-ui' => 'JQuery-ui'], config('schedule_settings.fcThemeSystem'), ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ trans('fi.timestep') }}</label>
                            {!! Form::select('TimeStep',['60' => '60', '30' => '30', '15' => '15', '10' => '10','5' => '5','1' => '1'], config('schedule_settings.timestep'), ['class' => 'form-control' ]) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ trans('fi.fc_aspectratio') }}</label>
                            {!! Form::number('FcAspectRatio', config('schedule_settings.fcAspectRatio'), ['min'=>'1', 'max'=>'2','step'=>'.05','class' => 'form-control' ]) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ trans('fi.coreeventslist') }}</label>
                            <div class="col-lg-8 col-sm-8">
                                @foreach (\FI\Modules\Scheduler\Models\Setting::$coreevents as $entityType => $value)
                                    <div class="checkbox">
                                        <label for="enabledCoreEvents{{ $value}}">
                                            <input name="enabledCoreEvents[]" id="enabledCoreEvents{{ $value}}" type="checkbox" {{ (new \FI\Modules\Scheduler\Models\Setting())->isCoreeventEnabled($entityType) ? 'checked="checked"' : '' }} value="{{ $value }}">{{ trans("fi.{$entityType}") }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div style="text-align:center" class="buttons">
            <a class="btn btn-warning btn-lg"
               href={!! route('scheduler.index')  !!}>{{ trans('fi.cancel') }} <span
                        class="glyphicon glyphicon-remove-circle"></span></a>
            <button type="submit" class="btn btn-success btn-lg">{{ trans('fi.save') }} <span
                        class="glyphicon glyphicon-floppy-disk"></span></button>
            {{--{!! Button::normal(trans('texts.cancel'))
                    ->large()
                    ->asLinkTo(URL::previous())
                    ->appendIcon(Icon::create('remove-circle')) !!}

            {!! Button::success('Save')
                    ->submit()
                    ->large()
                    ->appendIcon(Icon::create('floppy-disk')) !!}--}}
        </div>
    </div>
    {!! Form::close() !!}
@stop