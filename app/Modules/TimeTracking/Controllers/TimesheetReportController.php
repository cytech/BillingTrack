<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\TimeTracking\Controllers;

use FI\Support\Statuses\TimeTrackingProjectStatuses;
use FI\Modules\TimeTracking\Reports\TimesheetReport;
use FI\Http\Controllers\Controller;
use FI\Modules\CompanyProfiles\Models\CompanyProfile;
use FI\Support\PDF\PDFFactory;

class TimesheetReportController extends Controller
{
    private $timesheetReport;

    public function __construct(
        TimesheetReport $timesheetReport

    )
    {
        $this->timesheetReport = $timesheetReport;
    }

    public function index()
    {

        return view('time_tracking.reports.options.timesheet')
            ->with('companyProfiles', ['' => trans('fi.all_company_profiles')] + CompanyProfile::getList())
            ->with('statuses', ['' => trans('fi.all_statuses')] + TimeTrackingProjectStatuses::lists());
    }

    public function ajaxValidate()
    {

        return response()->json(['success' => true]);
    }

    public function html()
    {
        $results = $this->timesheetReport->getResults(
            request('from_date'),
            request('to_date'),
            request('company_profile_id'),
            request('status_id')
        );

        return view('time_tracking.reports.output.timesheet')
            ->with('results', $results);
    }

    public function pdf()
    {
        $pdf = PDFFactory::create();

        $results = $this->timesheetReport->getResults(
            request('from_date'),
            request('to_date'),
            request('company_profile_id'),
            request('status_id')
        );

        $html = view('time_tracking.reports.output.timesheet')
            ->with('results', $results)->render();

        $pdf->download($html, trans('fi.time_tracking') . '.pdf');
    }
}
