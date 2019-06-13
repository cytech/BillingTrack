<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\TimeTracking\Controllers;

use BT\Modules\TimeTracking\Models\TimeTrackingProject;
use BT\Modules\TimeTracking\Models\TimeTrackingTask;
use BT\Events\InvoiceModified;
use BT\Http\Controllers\Controller;
use BT\Modules\Groups\Models\Group;
use BT\Modules\Invoices\Models\Invoice;
use BT\Modules\Invoices\Models\InvoiceItem;

class TaskBillController extends Controller
{
    public function create()
    {
        $project = TimeTrackingProject::find(request('projectId'));

        $invoices = [];

        $clientInvoices = $project->client->invoices()->orderBy('created_at', 'desc')->statusIn(['draft', 'sent'])->get();

        foreach ($clientInvoices as $invoice)
        {
            $invoices[$invoice->id] = $invoice->formatted_created_at . ' - ' . $invoice->number . ' ' . $invoice->summary;
        }

        return view('time_tracking._task_bill_modal')
            ->with('project', $project)
            ->with('taskIds', request('taskIds'))
            ->with('invoices', $invoices)
            ->with('invoiceCount', count($invoices))
            ->with('groups', Group::getList());
    }

    public function store()
    {
        $project = TimeTrackingProject::find(request('project_id'));

        $tasks = TimeTrackingTask::getSelect()
            ->orderBy('display_order')
            ->orderBy('created_at')
            ->whereIn('id', json_decode(request('task_ids')))->get();

        if (request('how_to_bill') == 'new')
        {
            $invoice = Invoice::create([
                'client_id'          => $project->client_id,
                'company_profile_id' => $project->company_profile_id,
                'group_id'           => request('group_id'),
                'user_id'            => auth()->user()->id,
            ]);
        }
        elseif (request('how_to_bill') == 'existing')
        {
            $invoice = Invoice::find(request('invoice_id'));
        }

        foreach ($tasks as $task)
        {
            InvoiceItem::create([
                'invoice_id'    => $invoice->id,
                'name'          => trans('bt.hourly_charge'),
                'description'   => $task->name,
                'quantity'      => $task->hours,
                'price'         => $project->hourly_rate,
                'tax_rate_id'   => config('bt.itemTaxRate'),
                'tax_rate_2_id' => config('bt.itemTax2Rate'),
            ]);

            $task->billed     = 1;
            $task->invoice_id = $invoice->id;
            $task->save();
        }

        event(new InvoiceModified($invoice));

        return route('invoices.edit', [$invoice->id]);
    }
}
