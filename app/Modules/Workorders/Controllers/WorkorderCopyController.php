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
use BT\Modules\Clients\Models\Client;
use BT\Modules\CompanyProfiles\Models\CompanyProfile;
use BT\Modules\Groups\Models\Group;
use BT\Modules\Workorders\Models\Workorder;
use BT\Modules\Workorders\Models\WorkorderItem;
use BT\Modules\Workorders\Requests\WorkorderStoreRequest;
use BT\Support\DateFormatter;

class WorkorderCopyController extends Controller
{
    public function create()
    {
        $workorder = Workorder::find(request('workorder_id'));

        return view('workorders.partials._modal_copy')
            ->with('workorder', $workorder)
            ->with('groups', Group::getList())
            ->with('companyProfiles', CompanyProfile::getList())
            ->with('workorder_date', DateFormatter::format())
            ->with('user_id', auth()->user()->id);
    }

    public function store(WorkorderStoreRequest $request)
    {
        $client = Client::firstOrCreateByUniqueName($request->input('client_name'));

        $fromWorkorder = Workorder::find($request->input('workorder_id'));

        $toWorkorder = Workorder::create([
                'client_id'       => $client->id,
                'company_profile_id' => $request->input('company_profile_id'),
                'workorder_date'     => DateFormatter::unformat(request('workorder_date')),
                'group_id'        => $request->input('group_id'),
                'currency_code'   => $fromWorkorder->currency_code,
                'exchange_rate'   => $fromWorkorder->exchange_rate,
                'terms'           => $fromWorkorder->terms,
                'footer'          => $fromWorkorder->footer,
                'template'        => $fromWorkorder->template,
                'summary'         => $fromWorkorder->summary,
                'discount'        => $fromWorkorder->discount,
                'job_date'        => $fromWorkorder->job_date,
                'start_time'      => $fromWorkorder->start_time,
                'end_time'        => $fromWorkorder->end_time,
                'will_call'       => $fromWorkorder->will_call
            ]);

        foreach ($fromWorkorder->items as $item)
        {
            WorkorderItem::create(
                [
                    'workorder_id'      => $toWorkorder->id,
                    'name'          => $item->name,
                    'description'   => $item->description,
                    'quantity'      => $item->quantity,
                    'price'         => $item->price,
                    'tax_rate_id'   => $item->tax_rate_id,
                    'tax_rate_2_id' => $item->tax_rate_2_id,
                    'resource_table' => $item->resource_table,
                    'resource_id'    => $item->resource_id,
                    'display_order' => $item->display_order
                ]);
        }

        // Copy the custom fields
        $custom = collect($fromWorkorder->custom)->except('workorder_id')->toArray();
        $toWorkorder->custom->update($custom);


        return response()->json(['success' => true, 'id' => $toWorkorder->id], 200);
    }
}
