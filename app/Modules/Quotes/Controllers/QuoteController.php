<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\Quotes\Controllers;

use BT\DataTables\QuotesDataTable;
use BT\Http\Controllers\Controller;
use BT\Modules\CompanyProfiles\Models\CompanyProfile;
use BT\Modules\Quotes\Models\Quote;
use BT\Support\FileNames;
use BT\Support\PDF\PDFFactory;
use BT\Support\Statuses\QuoteStatuses;
use BT\Traits\ReturnUrl;

class QuoteController extends Controller
{
    use ReturnUrl;

    public function index(QuotesDataTable $dataTable)
    {
        $this->setReturnUrl();

        $status = request('status', 'all_statuses');
        $statuses = QuoteStatuses::listsAllFlat();
        $keyedStatuses = collect(QuoteStatuses::lists());//->except(3);
        $companyProfiles = ['' => trans('bt.all_company_profiles')] + CompanyProfile::getList();

        return $dataTable->render('quotes.index', compact('status','statuses', 'keyedStatuses','companyProfiles'));
    }

    public function delete($id)
    {
        Quote::destroy($id);

        return redirect()->route('quotes.index')
            ->with('alert', trans('bt.record_successfully_trashed'));
    }

    public function bulkDelete()
    {
        Quote::destroy(request('ids'));
        return response()->json(['success' => trans('bt.record_successfully_trashed')], 200);
    }

    public function bulkStatus()
    {
        Quote::whereIn('id', request('ids'))->update(['quote_status_id' => request('status')]);

        return response()->json(['success' => trans('bt.status_successfully_updated')], 200);
    }

    public function pdf($id)
    {
        $quote = Quote::find($id);

        $pdf = PDFFactory::create();

        $pdf->download($quote->html, FileNames::quote($quote));
    }
}
