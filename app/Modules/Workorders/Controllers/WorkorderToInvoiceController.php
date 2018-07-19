<?php

/**
 * This file is part of Workorders Addon for FusionInvoice.
 * (c) Cytech <cytech@cytech-eng.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
 
namespace Addons\Workorders\Controllers;

use FI\Http\Controllers\Controller;
use FI\Modules\Groups\Models\Group;
use Addons\Workorders\Models\Workorder;
use Addons\Workorders\Support\WorkorderToInvoice;
use Addons\Workorders\Requests\WorkorderToInvoiceRequest;
use Addons\Workorders\Support\DateFormatter;

class WorkorderToInvoiceController extends Controller
{
    private $workorderToInvoice;

    public function __construct(WorkorderToInvoice $workorderToInvoice)
    {
        $this->workorderToInvoice = $workorderToInvoice;
    }

    public function create()
    {
        return view('Workorders::workorders.partials._modal_workorder_to_invoice')
            ->with('workorder_id', request('workorder_id'))
            ->with('client_id', request('client_id'))
            ->with('groups', Group::getList())
            ->with('user_id', auth()->user()->id)
            ->with('workorder_date', DateFormatter::format());
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