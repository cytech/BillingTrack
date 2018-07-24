<?php

/**
 * This file is part of Workorders Addon for FusionInvoice.
 * (c) Cytech <cytech@cytech-eng.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\Workorders\Controllers;

use FI\Http\Controllers\Controller;
use FI\Modules\Workorders\Support\ClientStatementReport;
use FI\Modules\Workorders\Requests\ClientStatementReportRequest;
use FI\Modules\CompanyProfiles\Models\CompanyProfile;
use FI\Support\PDF\PDFFactory;

class ClientStatementReportController extends Controller
{
    private $report;

    public function __construct(ClientStatementReport $report)
    {
        $this->report = $report;
    }

    public function index()
    {
        return view('workorders.client_statement')
            ->with('companyProfiles', ['' => trans('fi.all_company_profiles')] + CompanyProfile::getList());
    }

    public function validateOptions(ClientStatementReportRequest $request)
    {

    }

    public function html()
    {
        $results = $this->report->getResults(
            request('client_name'),
            request('from_date'),
            request('to_date'),
            request('company_profile_id'));

        return view('workorders.partials._client_statement')
            ->with('results', $results);
    }

    public function pdf()
    {
        $pdf = PDFFactory::create();
        $pdf->setPaperOrientation('landscape');

        $results = $this->report->getResults(
            request('client_name'),
            request('from_date'),
            request('to_date'),
            request('company_profile_id'));

        $html = view('workorders.partials._client_statement')
            ->with('results', $results)->render();

        $pdf->download($html, trans('fi.client_statement') . '.pdf');
    }
}