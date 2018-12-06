

<script type="text/javascript">
    $(function () {
        $('#workorder-dashboard-total-setting-from-date').datetimepicker({format: 'Y-m-d', timepicker: false});
        $('#workorder-dashboard-total-setting-to-date').datetimepicker({format: 'Y-m-d', timepicker: false});

        $('#workorder-dashboard-total-setting').change(function () {
            toggleWidgetWorkorderDashboardTotalsDateRange($('#workorder-dashboard-total-setting').val());
        });

        function toggleWidgetWorkorderDashboardTotalsDateRange(val) {
            if (val == 'custom_date_range') {
                $('#div-workorder-dashboard-totals-date-range').show();
            }
            else {
                $('#div-workorder-dashboard-totals-date-range').hide();
            }
        }

        toggleWidgetWorkorderDashboardTotalsDateRange($('#workorder-dashboard-total-setting').val());
    });
</script>

<div class="form-group">
    <label>@lang('fi.dashboard_totals_option'): </label>
    {!! Form::select('setting[widgetWorkorderSummaryDashboardTotals]', $dashboardTotalOptions, config('fi.widgetWorkorderSummaryDashboardTotals'), ['class' => 'form-control', 'id' => 'workorder-dashboard-total-setting']) !!}
</div>

<div class="row" id="div-workorder-dashboard-totals-date-range">
    <div class="col-md-2">
        <label>@lang('fi.from_date'):</label>
        {!! Form::text('setting[widgetWorkorderSummaryDashboardTotalsFromDate]', config('fi.widgetWorkorderSummaryDashboardTotalsFromDate'), ['class' => 'form-control', 'id' => 'workorder-dashboard-total-setting-from-date']) !!}
    </div>
    <div class="col-md-2">
        <label>@lang('fi.to_date'):</label>
        {!! Form::text('[setting_widgetWorkorderSummaryDashboardTotalsToDate]', config('fi.widgetWorkorderSummaryDashboardTotalsToDate'), ['class' => 'form-control', 'id' => 'workorder-dashboard-total-setting-to-date']) !!}
    </div>
</div>