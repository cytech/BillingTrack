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
use BT\Modules\Workorders\Requests\WorkorderStoreRequest;
use BT\Support\DateFormatter;

class WorkorderCreateController extends Controller
{
    public function create()
    {
        return view('workorders.partials._modal_create')
            ->with('companyProfiles', CompanyProfile::getList())
            ->with('groups', Group::getList());
    }

    public function store(WorkorderStoreRequest $request)
    {
        $input = request()->except('client_name');

        $input['client_id']  = Client::firstOrCreateByUniqueName($request->input('client_name'))->id;
        $input['workorder_date'] = DateFormatter::unformat($input['workorder_date']);

        $workorder = Workorder::create($input);

        return response()->json(['success' => true, 'id' => $workorder->id], 200);
    }
}
