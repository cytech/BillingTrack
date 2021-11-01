<?php

/**
 * This file is part of BillingTrack.
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\API\Controllers;

use BT\Events\WorkorderModified;
use BT\Modules\API\Requests\APIWorkorderItemRequest;
use BT\Modules\API\Requests\APIWorkorderStoreRequest;
use BT\Modules\Clients\Models\Client;
use BT\Modules\Workorders\Models\Workorder;
use BT\Modules\Workorders\Models\WorkorderItem;
use BT\Modules\Users\Models\User;

class ApiWorkorderController extends ApiController
{
    public function lists()
    {
        $workorders = Workorder::select('workorders.*')
            ->with(['items.amount', 'client', 'amount', 'currency'])
            ->status(request('status'))
            //->sortable(['job_date' => 'desc', 'LENGTH(number)' => 'desc', 'number' => 'desc'])
            ->paginate(config('bt.resultsPerPage'));

        return response()->json($workorders);
    }

    public function show()
    {
        return response()->json(Workorder::with(['items.amount', 'client', 'amount', 'currency'])->find(request('id')));
    }

    public function store(APIWorkorderStoreRequest $request)
    {
        $input = $request->except('key', 'signature', 'timestamp', 'endpoint');

        $input['user_id'] = User::where('client_id', 0)->where('api_public_key', $request->input('key'))->first()->id;

        $input['client_id'] = Client::firstOrCreateByUniqueName(request('client_name'))->id;

        unset($input['client_name']);

        return response()->json(Workorder::create($input));
    }

    public function addItem(APIWorkorderItemRequest $request)
    {
        $input = $request->except('key', 'signature', 'timestamp', 'endpoint');

        WorkorderItem::create($input);
        $workorder = Workorder::find(request('workorder_id'));
        event(new WorkorderModified($workorder));
    }

    public function delete()
    {
        $validator = $this->validator->make(['id' => request('id')], ['id' => 'required']);

        if ($validator->fails())
        {
            return response()->json($validator->errors()->all(), 400);
        }

        if (Workorder::find(request('id')))
        {
            Workorder::destroy(request('id'));

            return response(200);
        }

        return response()->json([trans('bt.record_not_found')], 400);
    }
}
