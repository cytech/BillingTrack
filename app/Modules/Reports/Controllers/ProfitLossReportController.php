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
use BT\Modules\Reports\Reports\ProfitLossReport;
use BT\Modules\Reports\Requests\DateRangeRequest;
use BT\Support\PDF\PDFFactory;

class ProfitLossReportController extends Controller
{
    private $report;

    public function __construct(ProfitLossReport $report)
    {
        $this->report = $report;
    }

    public function index()
    {
        return view('reports.options.profit_loss');
    }

    public function validateOptions(DateRangeRequest $request)
    {

    }

    public function html()
    {
        $results = $this->report->getResults(
            request('from_date'),
            request('to_date'),
            request('company_profile_id'),
            request('include_profit_based_on')
        );

        return view('reports.output.profit_loss')
            ->with('results', $results);
    }

    public function pdf()
    {
        $pdf = PDFFactory::create();

        $results = $this->report->getResults(
            request('from_date'),
            request('to_date'),
            request('company_profile_id'),
            request('include_profit_based_on')
        );

        $html = view('reports.output.profit_loss')
            ->with('results', $results)->render();

        $pdf->download($html, trans('bt.profit_and_loss') . '.pdf');
    }
}
