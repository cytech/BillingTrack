<?php

return [
    'rules'    => [
        'widgetWorkorderSummaryDashboardTotalsFromDate' => 'required_if:widgetWorkorderSummaryDashboardTotals,custom_date_range',
        'widgetWorkorderSummaryDashboardTotalsToDate'   => 'required_if:widgetWorkorderSummaryDashboardTotals,custom_date_range'
    ],
    'messages' => [
        'widgetWorkorderSummaryDashboardTotalsFromDate.required_if' => trans('bt.validation_workorder_summary_from_date'),
        'widgetWorkorderSummaryDashboardTotalsToDate.required_if'   => trans('bt.validation_workorder_summary_to_date')
    ]
];
