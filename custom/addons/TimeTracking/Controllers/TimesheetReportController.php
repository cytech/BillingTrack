<?php

/**
 * This file is part of FusionInvoiceFOSS.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Addons\TimeTracking\Controllers;

use Addons\TimeTracking\ProjectStatuses;
use Addons\TimeTracking\Reports\TimesheetReport;
use FI\Http\Controllers\Controller;
use FI\Modules\CompanyProfiles\Models\CompanyProfile;
use FI\Modules\Reports\Requests\YearRequest;
use FI\Support\PDF\PDFFactory;

class TimesheetReportController extends Controller
{
    private $timesheetReport;
    private $reportValidator;

    public function __construct(
        TimesheetReport $timesheetReport,
        YearRequest $reportValidator
    )
    {
        $this->timesheetReport = $timesheetReport;
        $this->reportValidator = $reportValidator;
    }

    public function index()
    {
        return view('time_tracking.reports.options.timesheet')
            ->with('companyProfiles', ['' => trans('fi.all_company_profiles')] + CompanyProfile::getList())
            ->with('statuses', ['' => trans('fi.all_statuses')] + ProjectStatuses::lists());
    }

    public function ajaxValidate()
    {
        $validator = $this->reportValidator->getDateRangeValidator(request()->all());

        if ($validator->fails())
        {
            return response()->json([
                'success' => false,
                'errors'  => $validator->messages()->toArray(),
            ], 400);
        }

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

        $pdf->download($html, trans('TimeTracking::lang.timesheet') . '.pdf');
    }
}