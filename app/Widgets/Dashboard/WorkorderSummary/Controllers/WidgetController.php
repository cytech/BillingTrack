<?php

namespace FI\Widgets\Dashboard\WorkorderSummary\Controllers;

use FI\Http\Controllers\Controller;
use FI\Modules\Settings\Models\Setting;

class WidgetController extends Controller
{
    public function renderPartial()
    {
        Setting::saveByKey('widgetWorkorderSummaryDashboardTotals', request('widgetWorkorderSummaryDashboardTotals'));

        if (request()->has('widgetWorkorderSummaryDashboardTotalsFromDate'))
        {
            Setting::saveByKey('widgetWorkorderSummaryDashboardTotalsFromDate', request('widgetWorkorderSummaryDashboardTotalsFromDate'));
        }

        if (request()->has('widgetWorkorderSummaryDashboardTotalsToDate'))
        {
            Setting::saveByKey('widgetWorkorderSummaryDashboardTotalsToDate', request('widgetWorkorderSummaryDashboardTotalsToDate'));
        }

        Setting::setAll();

        return view('WorkorderSummaryWidget');
    }
}