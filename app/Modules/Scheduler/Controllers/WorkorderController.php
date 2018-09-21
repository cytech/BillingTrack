<?php

/**
 * This file is part of FusionInvoiceFOSS.
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


namespace FI\Modules\Scheduler\Controllers;

use FI\Http\Controllers\Controller;
use FI\Events\WorkorderModified;
use FI\Modules\Clients\Models\Client;
use FI\Modules\Workorders\Models\WorkorderItem;
use FI\Modules\Workorders\Models\Workorder;
use FI\Modules\Workorders\Requests\WorkorderStoreRequest;
use FI\Support\DateFormatter;
use FI\Modules\Employees\Models\Employee;
use FI\Modules\Products\Models\Product;
use FI\Support\Statuses\WorkorderStatuses;

class WorkorderController extends Controller
{
    public function create(WorkorderStoreRequest $request)
    {
        $input = $request->except('client_name', 'workers', 'resources','quantity');
        $input['client_id'] = Client::firstOrCreateByUniqueName($request->input('client_name'))->id;
        $input['start_time'] = DateFormatter::formattime($input['start_time']);
        $input['end_time'] = DateFormatter::formattime($input['end_time']);
        $input['workorder_status_id'] = WorkorderStatuses::getStatusId('approved');

        $workorder = Workorder::create($input);

        $input = $request->only('workers', 'resources', 'quantity');
        // Now let's add some employee items to that new workorder.
        if (isset($input['workers'])) {
            foreach ($input['workers'] as $val) {
                $lookupItem = Employee::where('id', '=', $val)->firstOrFail();
                $item['workorder_id'] = $workorder->id;
                $item['resource_table'] = 'employees';
                $item['resource_id'] = $lookupItem->id;
                $item['name'] = $lookupItem->short_name;
                $item['description'] = $lookupItem->title . "-" . $lookupItem->number;
                $item['quantity'] = 0;
                $item['price'] = $lookupItem->billing_rate;

                WorkorderItem::create($item);
            }
        }
        // Now let's add some resource items to that new workorder.
        if (isset($input['resources'])) {
            foreach ($input['resources'] as $val) {
                $lookupItem = Product::where('id', '=', $val)->firstOrFail();
                $item['workorder_id'] = $workorder->id;
                $item['resource_table'] = 'products';
                $item['resource_id'] = $lookupItem->id;
                $item['name'] = $lookupItem->name;
                $item['description'] = $lookupItem->description;
                $item['quantity'] = $input['quantity'][$val];
                $item['price'] = $lookupItem->cost;

                WorkorderItem::create($item);
            }
        }

        event(new WorkorderModified(Workorder::find($workorder->id)));

        //return redirect()->route('workorders.edit', ['id' => $workorder->id])->with('alertSuccess', trans('fi.record_successfully_created'));
        return back()->with('alertSuccess', trans('fi.record_successfully_created'));
    }
}