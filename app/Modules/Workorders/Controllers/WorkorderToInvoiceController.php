<?php

/**
 * This file is part of FusionInvoiceFOSS.
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
 
namespace FI\Modules\Workorders\Controllers;

use FI\Http\Controllers\Controller;
use FI\Modules\Groups\Models\Group;
use FI\Modules\Workorders\Models\Workorder;
use FI\Modules\Workorders\Support\WorkorderToInvoice;
use FI\Modules\Workorders\Requests\WorkorderToInvoiceRequest;
use FI\Support\DateFormatter;

class WorkorderToInvoiceController extends Controller
{
    private $workorderToInvoice;

    public function __construct(WorkorderToInvoice $workorderToInvoice)
    {
        $this->workorderToInvoice = $workorderToInvoice;
    }

    public function create()
    {
        return view('workorders.partials._modal_workorder_to_invoice')
            ->with('workorder_id', request('workorder_id'))
            ->with('client_id', request('client_id'))
            ->with('groups', Group::getList())
            ->with('user_id', auth()->user()->id)
            ->with('workorder_date', DateFormatter::format())
            ->with('job_date', request('job_date'));
    }

    public function store(WorkorderToInvoiceRequest $request)
    {
        $workorder = Workorder::find($request->input('workorder_id'));

        $invoice = $this->workorderToInvoice->convert(
            $workorder,
            DateFormatter::unformat($request->input('workorder_date')),
            DateFormatter::incrementDateByDays(DateFormatter::unformat($request->input('workorder_date')), config('fi.invoicesDueAfter')),
	        $request->input('group_id')
        );

        return response()->json(['success' => true, 'redirectTo' => route('invoices.edit', ['invoice' => $invoice->id])], 200);
    }
}