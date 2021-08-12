@section('javaScript')
    @parent
    <script type="text/javascript">
        $().ready(function () {
            $('#btn-check-update').click(function () {
                $.get("{{ route('settings.updateCheck') }}")
                    .done(function (response) {
                        notify(response.message,'info');
                    })
                    .fail(function (response) {
                        notify("@lang('bt.unknown_error')",'error');
                    });
            });
        });
    </script>
@stop

<div class="row">

    <div class="col-md-4">
        <div class="form-group">
            <label>@lang('bt.header_title_text'): </label>
            {!! Form::text('setting[headerTitleText]', config('bt.headerTitleText'), ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label>@lang('bt.default_company_profile'): </label>
            {!! Form::select('setting[defaultCompanyProfile]', $companyProfiles, config('bt.defaultCompanyProfile'), ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label>@lang('bt.version'): </label>

            <div class="input-group">
                {!! Form::text('version', config('bt.version'), ['class' => 'form-control', 'disabled' => 'disabled']) !!}
                <span class="input-group-append">
                    @if (!config('app.demo'))
					<button class="btn btn-secondary" id="btn-check-update"
                            type="button" >@lang('bt.check_for_update') </button>
                    @else
                        Check updates are disabled in the demo.
                    @endif
				</span>
            </div>
        </div>
    </div>

</div>

<div class="row">



    <div class="col-md-2">
        <div class="form-group">
            <label>@lang('bt.language'): </label>
            {!! Form::select('setting[language]', $languages, config('bt.language'), ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="col-md-2">
        <div class="form-group">
            <label>@lang('bt.date_format'): </label>
            {!! Form::select('setting[dateFormat]', $dateFormats, config('bt.dateFormat'), ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <label>@lang('bt.use_24_hour_time_format'): </label>
            {!! Form::select('setting[use24HourTimeFormat]', $yesNoArray, config('bt.use24HourTimeFormat'), ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <label>@lang('bt.timezone'): </label>
            {!! Form::select('setting[timezone]', $timezones, config('bt.timezone'), ['class' => 'form-control']) !!}
        </div>
    </div>

</div>
<div class="row">
    <div class="col-md-2">
        <div class="form-group">
            <label>@lang('bt.skin_header_bg'): </label>
            {!! Form::select('skin[headBackground]', $skins, json_decode(config('bt.skin'),true)['headBackground'], ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label>@lang('bt.skin_header_text'): </label>
            {!! Form::select('skin[headClass]', ['dark'=>'Dark', 'light'=>'Light'], json_decode(config('bt.skin'),true)['headClass'], ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label>@lang('bt.skin_menu_bg'): </label>
            {!! Form::select('skin[sidebarBackground]', $skins, json_decode(config('bt.skin'),true)['sidebarBackground'], ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label>@lang('bt.skin_menu_text'): </label>
            {!! Form::select('skin[sidebarClass]', ['dark'=>'Dark', 'light'=>'Light'], json_decode(config('bt.skin'),true)['sidebarClass'], ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label>@lang('bt.skin_menu_mode'): </label>
            {!! Form::select('skin[sidebarMode]', ['open'=>'Open', 'collapse'=>'Collapse'], json_decode(config('bt.skin'),true)['sidebarMode'], ['class' => 'form-control']) !!}
        </div>
    </div>
</div>

<div class="row">

    <div class="col-md-6">

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>@lang('bt.display_client_unique_name'): </label>
                    {!! Form::select('setting[displayClientUniqueName]', $clientUniqueNameOptions, config('bt.displayClientUniqueName'), ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>@lang('bt.quantity_price_decimals'): </label>
                            {!! Form::select('setting[amountDecimals]', $amountDecimalOptions, config('bt.amountDecimals'), ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>@lang('bt.round_tax_decimals'): </label>
                            {!! Form::select('setting[roundTaxDecimals]', $roundTaxDecimalOptions, config('bt.roundTaxDecimals'), ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label>@lang('bt.address_format'): </label>
            {!! Form::textarea('setting[addressFormat]', config('bt.addressFormat'), ['class' => 'form-control', 'rows' => 5]) !!}
        </div>
    </div>

</div>

<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label>@lang('bt.base_currency'): </label>
                    {!! Form::select('setting[baseCurrency]', $currencies, config('bt.baseCurrency'), ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>@lang('bt.fixerio_api_key'): </label>
                    {!! Form::text('setting[currencyConversionKey]', config('bt.currencyConversionKey'), ['class' => 'form-control', 'placeholder' => 'Get a free API key at https://fixer.io', 'title' => 'Get a free API key at https://fixer.io']) !!}
                </div>
                    {{--Why is this here?? because the latest version of Chrome 77.0.3865.90 insists on treating the 2nd text field in the form as a password autofill....--}}
                    {!! Form::text('stupidchrome', 'Get a free API key at https://fixer.io', ['class' => 'form-control', 'readonly']) !!}
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>@lang('bt.exchange_rate_mode'): </label>
                    {!! Form::select('setting[exchangeRateMode]', $exchangeRateModes, config('bt.exchangeRateMode'), ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>@lang('bt.results_per_page'):</label>
                    {!! Form::select('setting[resultsPerPage]', $resultsPerPage, config('bt.resultsPerPage'), ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>
    </div>



</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label>@lang('bt.restolup') </label>
            {!! Form::select('setting[restolup]', [0=>trans('bt.no'),1=>trans('bt.yes')], config('bt.restolup'),
                            ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>@lang('bt.emptolup') </label>
            {!! Form::select('setting[emptolup]', [0=>trans('bt.no'),1=>trans('bt.yes')], config('bt.emptolup'),
                            ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>@lang('bt.force_https'):</label>
            {!! Form::select('setting[forceHttps]', $yesNoArray, config('bt.forceHttps'), ['class' => 'form-control', 'title' => trans('bt.force_https_help') ]) !!}
        </div>
    </div>
</div>
<div class="row">

    <div class="col-md-4">
        <div class="form-group">
            @if (!config('app.demo'))
            <a href="{{action('BT\Modules\Products\Controllers\ProductController@forceLUTupdate',['ret' => 0])}}"
               class="btn btn-warning">@lang('bt.force_product_update')</a>
            @else
                Force updates are disabled in the demo.
            @endif
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            @if (!config('app.demo'))
            <a href="{{action('BT\Modules\Employees\Controllers\EmployeeController@forceLUTupdate',['ret' => 0])}}"
               class="btn btn-warning">@lang('bt.force_employee_update')</a>
            @else
                Force updates are disabled in the demo.
            @endif
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <p class="form-text text-muted">@lang('bt.force_https_help')</p>
        </div>
    </div>
</div>
