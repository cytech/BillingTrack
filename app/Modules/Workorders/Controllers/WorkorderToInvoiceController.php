<?php

/**
 * This file is part of BillingTrack.
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\Workorders\Controllers;

use BT\Http\Controllers\Controller;
use BT\Modules\Groups\Models\Group;
use BT\Modules\Workorders\Models\Workorder;
use BT\Modules\Workorders\Support\WorkorderToInvoice;
use BT\Modules\Workorders\Requests\WorkorderToInvoiceRequest;
use BT\Support\DateFormatter;

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
            ->with('workorder_date', config('bt.convertWorkorderDate') == 'jobdate' ? request('job_date') : DateFormatter::format());
    }

    public function store(WorkorderToInvoiceRequest $request)
    {
        $workorder = Workorder::find($request->input('workorder_id'));

        $invoice = $this->workorderToInvoice->convert(
            $workorder,
            DateFormatter::unformat($request->input('workorder_date')),
            DateFormatter::incrementDateByDays(DateFormatter::unformat($request->input('workorder_date')),  $workorder->client->client_terms),
	        $request->input('group_id')
        );

        return response()->json(['success' => true, 'redirectTo' => route('invoices.edit', ['id' => $invoice->id])], 200);
    }
}
