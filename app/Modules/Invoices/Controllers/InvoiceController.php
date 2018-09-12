<?php

/**
 * This file is part of FusionInvoiceFOSS.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\Invoices\Controllers;

use FI\DataTables\InvoicesDataTable;
use FI\Http\Controllers\Controller;
use FI\Modules\CompanyProfiles\Models\CompanyProfile;
use FI\Modules\Invoices\Models\Invoice;
use FI\Support\FileNames;
use FI\Support\PDF\PDFFactory;
use FI\Support\Statuses\InvoiceStatuses;
use FI\Traits\ReturnUrl;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    use ReturnUrl;

    public function index(InvoicesDataTable $dataTable)
    {
        $this->setReturnUrl();

        $status = request('status', 'all_statuses');
        $statuses = InvoiceStatuses::listsAllFlat() + ['overdue' => trans('fi.overdue')];
        $keyedStatuses = collect(InvoiceStatuses::lists())->except(3);
        $companyProfiles = ['' => trans('fi.all_company_profiles')] + CompanyProfile::getList();

        return $dataTable->render('invoices.index', compact('status','statuses', 'keyedStatuses','companyProfiles'));
    }

    public function delete($id)
    {
        Invoice::destroy($id);

        return redirect()->route('invoices.index')
            ->with('alert', trans('fi.record_successfully_trashed'));
    }

    public function bulkDelete()
    {
        Invoice::destroy(request('ids'));
        return response()->json(['success' => trans('fi.record_successfully_trashed')], 200);
    }

    public function bulkStatus()
    {
        Invoice::whereIn('id', request('ids'))
            ->where('invoice_status_id', '<>', InvoiceStatuses::getStatusId('paid'))
            ->update(['invoice_status_id' => request('status')]);
        return response()->json(['success' => trans('fi.status_successfully_updated')], 200);
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
        })->notCanceled()->get();


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