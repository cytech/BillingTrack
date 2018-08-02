<?php

/**
 * This file is part of FusionInvoiceFOSS.
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\Workorders\Controllers;

use FI\Modules\API\Requests\APIInvoiceItemRequest;
use FI\Modules\Workorders\Requests\APIWorkorderItemRequest;
use FI\Modules\Workorders\Requests\APIWorkorderStoreRequest;
use FI\Modules\Clients\Models\Client;
use FI\Modules\Workorders\Models\Workorder;
use FI\Modules\Workorders\Models\WorkorderItem;
use FI\Modules\Users\Models\User;
use FI\Modules\API\Controllers\ApiController as FIAPIController;

class ApiWorkorderController extends FIApiController
{
    public function lists()
    {
        $workorders = Workorder::select('workorders.*')
            ->with(['items.amount', 'client', 'amount', 'currency'])
            ->status(request('status'))
            //->sortable(['job_date' => 'desc', 'LENGTH(number)' => 'desc', 'number' => 'desc'])
            ->paginate(config('fi.resultsPerPage'));

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

        return response()->json([trans('fi.record_not_found')], 400);
    }
}