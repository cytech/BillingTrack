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

use BT\Http\Controllers\Controller;
use BT\Modules\Reports\Reports\PaymentsCollectedReport;
use BT\Modules\Reports\Requests\DateRangeRequest;
use BT\Support\PDF\PDFFactory;

class PaymentsCollectedReportController extends Controller
{
    private $report;

    public function __construct(PaymentsCollectedReport $report)
    {
        $this->report = $report;
    }

    public function index()
    {
        return view('reports.options.payments_collected');
    }

    public function validateOptions(DateRangeRequest $request)
    {

    }

    public function html()
    {
        $results = $this->report->getResults(
            request('from_date'),
            request('to_date'),
            request('company_profile_id')
        );

        return view('reports.output.payments_collected')
            ->with('results', $results);
    }

    public function pdf()
    {
        $pdf = PDFFactory::create();
        $pdf->setPaperOrientation('landscape');

        $results = $this->report->getResults(
            request('from_date'),
            request('to_date'),
            request('company_profile_id')
        );

        $html = view('reports.output.payments_collected')
            ->with('results', $results)->render();

        $pdf->download($html, trans('bt.payments_collected') . '.pdf');
    }
}
