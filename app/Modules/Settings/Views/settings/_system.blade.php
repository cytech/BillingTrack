<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label>@lang('bt.enabled_modules')</label>
            <div class="col-lg-8 col-sm-8">
                @foreach (\BT\Modules\Settings\Models\Setting::$modules as $entityType => $value)
                    <div class="form-check">
                        <label for="enabledModules{{ $value}}">
                            <input name="enabledModules[]" id="enabledModules{{ $value}}" type="checkbox"
                                   {{ (new \BT\Modules\Settings\Models\Setting())->isModuleEnabled($entityType) ? 'checked="checked"' : '' }} value="{{ $value }}"> {{ trans("bt.{$entityType}") }}
                        </label>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>@lang('bt.jqui_theme')</label>
            <p class="form-text text-muted font-italic">@lang('bt.jqui_themenote')</p>
            <div class="form-group col-md-6">
                {!! Form::select('setting[jquiTheme]', $jquiTheme, config('bt.jquiTheme'), ['class' => 'form-control'] ) !!}
            </div>
        </div>
    </div>
    @if (!config('app.demo'))
    <div class="form-group col-md-4">
        <label>Application URL: </label>
        {!! Form::text('app_url',config('app.url'), ['class' => 'form-control', 'readonly']) !!}
        <label>Debug Enabled? </label>
        {!! Form::select('debug', ['0' => 'No', '1' => 'Yes'], config('app.debug'), ['class' => 'form-control', 'disabled']) !!}
        <label>Database Driver: </label>
        {!! Form::text('db_driver',config('database.connections.mysql.driver'), ['class' => 'form-control', 'readonly']) !!}
        <label>Database Host: </label>
        {!! Form::text('db_host',env('DB_HOST', 'empty'), ['class' => 'form-control', 'readonly']) !!}
        <label>Database: </label>
        {!! Form::text('db_database',env('DB_DATABASE','empty'), ['class' => 'form-control', 'readonly']) !!}
        <label>Database UserName: </label>
        {!! Form::text('db_username',env('DB_USERNAME', 'empty'), ['class' => 'form-control', 'readonly']) !!}
    </div>
        @endif
</div>
{{--<div class="form-group">--}}
{{--<label>Database Password: </label>--}}
{{--{!! Form::password('db_password',['class' => 'form-control', 'readonly']) !!}--}}
{{--</div>--}}

