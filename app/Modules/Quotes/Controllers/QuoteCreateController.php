<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\Quotes\Controllers;

use BT\Http\Controllers\Controller;
use BT\Modules\Clients\Models\Client;
use BT\Modules\CompanyProfiles\Models\CompanyProfile;
use BT\Modules\Groups\Models\Group;
use BT\Modules\Quotes\Models\Quote;
use BT\Modules\Quotes\Requests\QuoteStoreRequest;
use BT\Support\DateFormatter;

class QuoteCreateController extends Controller
{
    public function create()
    {
        return view('quotes._modal_create')
            ->with('companyProfiles', CompanyProfile::getList())
            ->with('groups', Group::getList());
    }

    public function store(QuoteStoreRequest $request)
    {
        $input = $request->except('client_name');

        $input['client_id']  = Client::firstOrCreateByUniqueName($request->input('client_name'))->id;
        $input['quote_date'] = DateFormatter::unformat($input['quote_date']);

        $quote = Quote::create($input);

        return response()->json(['id' => $quote->id], 200);
    }
}
