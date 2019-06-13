<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\API\Controllers;

use BT\Modules\API\Requests\APIClientUpdateRequest;
use BT\Modules\Clients\Models\Client;
use BT\Modules\Clients\Requests\ClientStoreRequest;
use Illuminate\Http\Request;

class ApiClientController extends ApiController
{
    public function buildFailedValidationResponse(Request $request, array $errors)
    {
        return response()->json($errors, 422);
    }

    public function lists()
    {
        $clients = Client::getSelect()
            ->orderBy('name')
            ->paginate(config('bt.resultsPerPage'));

        return response()->json($clients);
    }

    public function show()
    {
        if ($client = Client::getSelect()->find(request('id')))
        {
            return response()->json($client);
        }

        return response()->json([trans('bt.record_not_found')], 400);

    }

    public function store(ClientStoreRequest $request)
    {
        return response()->json(Client::create($request->except('key', 'signature', 'timestamp', 'endpoint')));
    }

    public function update(APIClientUpdateRequest $request)
    {
        if ($client = Client::getSelect()->find($request->input('id')))
        {
            $client->fill($request->except('key', 'signature', 'timestamp', 'endpoint'));

            $client->save();

            return response()->json($client);
        }

        return response()->json([trans('bt.record_not_found')], 400);

    }

    public function delete()
    {
        $validator = $this->validator->make(request()->only(['id']), ['id' => 'required']);

        if ($validator->fails())
        {
            return response()->json($validator->errors()->all(), 400);
        }

        if ($client = Client::getSelect()->find(request('id')))
        {
            Client::destroy(request('id'));

            return response(200);
        }

        return response()->json([trans('bt.record_not_found')], 400);
    }
}
