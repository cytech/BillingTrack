<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\Invoices\Controllers;

use BT\DataTables\InvoicesDataTable;
use BT\Http\Controllers\Controller;
use BT\Modules\CompanyProfiles\Models\CompanyProfile;
use BT\Modules\Invoices\Models\Invoice;
use BT\Support\FileNames;
use BT\Support\PDF\PDFFactory;
use BT\Support\Statuses\InvoiceStatuses;
use BT\Traits\ReturnUrl;

class InvoiceController extends Controller
{
    use ReturnUrl;

    public function index(InvoicesDataTable $dataTable)
    {
        $this->setReturnUrl();

        $status = request('status', 'all_statuses');
        $statuses = InvoiceStatuses::listsAllFlat() + ['overdue' => trans('bt.overdue')];
        $keyedStatuses = collect(InvoiceStatuses::lists())->except(3);
        $companyProfiles = ['' => trans('bt.all_company_profiles')] + CompanyProfile::getList();

        return $dataTable->render('invoices.index', compact('status','statuses', 'keyedStatuses','companyProfiles'));
    }

    public function delete($id)
    {
        Invoice::destroy($id);

        return redirect()->route('invoices.index')
            ->with('alert', trans('bt.record_successfully_trashed'));
    }

    public function bulkDelete()
    {
        Invoice::destroy(request('ids'));
        return response()->json(['success' => trans('bt.record_successfully_trashed')], 200);
    }

    public function bulkStatus()
    {
        Invoice::whereIn('id', request('ids'))
            ->where('invoice_status_id', '<>', InvoiceStatuses::getStatusId('paid'))
            ->update(['invoice_status_id' => request('status')]);
        return response()->json(['success' => trans('bt.status_successfully_updated')], 200);
    }

    public function pdf($id)
    {
        $invoice = Invoice::find($id);

        $pdf = PDFFactory::create();

        $pdf->download($invoice->html, FileNames::invoice($invoice));
    }

    public function ajaxLookup($name)
    {
        $invoices = Invoice::whereHas( 'client', function ($query) use ($name){
            $query->where('unique_name', $name);
        })->whereHas( 'amount', function ($query){
            $query->where('balance', '>', 0);
        })->sent()->get();


        $list = [];

        foreach ($invoices as $invoice){
            $list[] =[
            'client_id' => $invoice->client->id,
            'id' => $invoice->id,
            'number' => $invoice->number,
            'amount' =>  $invoice->amount->formatted_numeric_balance,
            'invoice_date' => $invoice->formatted_invoice_date,
            ];
        }

        return json_encode($list);

    }
}
