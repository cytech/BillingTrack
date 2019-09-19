<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\Reports\Controllers;

use BT\Support\Statuses\TimeTrackingProjectStatuses;
use BT\Modules\Reports\Reports\TimeTrackingReport;
use BT\Http\Controllers\Controller;
use BT\Modules\CompanyProfiles\Models\CompanyProfile;
use BT\Support\PDF\PDFFactory;

class TimeTrackingReportController extends Controller
{
    private $timeTrackingReport;

    public function __construct(
        TimeTrackingReport $timeTrackingReport

    )
    {
        $this->timeTrackingReport = $timeTrackingReport;
    }

    public function index()
    {

        return view('reports.options.timetracking')
            ->with('companyProfiles', ['' => trans('bt.all_company_profiles')] + CompanyProfile::getList())
            ->with('statuses', ['' => trans('bt.all_statuses')] + TimeTrackingProjectStatuses::lists());
    }

    public function ajaxValidate()
    {

        return response()->json(['success' => true]);
    }

    public function html()
    {
        $results = $this->timeTrackingReport->getResults(
            request('from_date'),
            request('to_date'),
            request('company_profile_id'),
            request('status_id')
        );

        return view('reports.output.timetracking')
            ->with('results', $results);
    }

    public function pdf()
    {
        $pdf = PDFFactory::create();

        $results = $this->timeTrackingReport->getResults(
            request('from_date'),
            request('to_date'),
            request('company_profile_id'),
            request('status_id')
        );

        $html = view('reports.output.timetracking')
            ->with('results', $results)->render();

        $pdf->download($html, trans('bt.time_tracking') . '.pdf');
    }
}
