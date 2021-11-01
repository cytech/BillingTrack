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

use BT\Events\QuoteModified;
use BT\Modules\API\Requests\APIQuoteItemRequest;
use BT\Modules\API\Requests\APIQuoteStoreRequest;
use BT\Modules\Clients\Models\Client;
use BT\Modules\Quotes\Models\Quote;
use BT\Modules\Quotes\Models\QuoteItem;
use BT\Modules\Users\Models\User;

class ApiQuoteController extends ApiController
{
    public function lists()
    {
        $quotes = Quote::select('quotes.*')
            ->with(['items.amount', 'client', 'amount', 'currency'])
            ->status(request('status'))
            //->sortable(['quote_date' => 'desc', 'LENGTH(number)' => 'desc', 'number' => 'desc'])
            ->paginate(config('bt.resultsPerPage'));

        return response()->json($quotes);
    }

    public function show()
    {
        return response()->json(Quote::with(['items.amount', 'client', 'amount', 'currency'])->find(request('id')));
    }

    public function store(APIQuoteStoreRequest $request)
    {
        $input = $request->except('key', 'signature', 'timestamp', 'endpoint');

        $input['user_id'] = User::where('client_id', 0)->where('api_public_key', $request->input('key'))->first()->id;

        $input['client_id'] = Client::firstOrCreateByUniqueName(request('client_name'))->id;

        unset($input['client_name']);

        return response()->json(Quote::create($input));
    }

    public function addItem(APIQuoteItemRequest $request)
    {
        $input = $request->except('key', 'signature', 'timestamp', 'endpoint');

        QuoteItem::create($input);
        $quote = Quote::find(request('quote_id'));
        event(new QuoteModified($quote));
    }

    public function delete()
    {
        $validator = $this->validator->make(['id' => request('id')], ['id' => 'required']);

        if ($validator->fails())
        {
            return response()->json($validator->errors()->all(), 400);
        }

        if (Quote::find(request('id')))
        {
            Quote::destroy(request('id'));

            return response(200);
        }

        return response()->json([trans('bt.record_not_found')], 400);
    }
}
