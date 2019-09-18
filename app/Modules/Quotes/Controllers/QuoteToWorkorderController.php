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
use BT\Modules\Groups\Models\Group;
use BT\Modules\Quotes\Models\Quote;
use BT\Modules\Quotes\Support\QuoteToWorkorder;
use BT\Modules\Quotes\Requests\QuoteToWorkorderRequest;
use BT\Support\DateFormatter;

class QuoteToWorkorderController extends Controller
{
    private $quoteToWorkorder;

    public function __construct(QuoteToWorkorder $quoteToWorkorder)
    {
        $this->quoteToWorkorder = $quoteToWorkorder;
    }

    public function create()
    {
        return view('quotes._modal_quote_to_workorder')
            ->with('quote_id', request('quote_id'))
            ->with('client_id', request('client_id'))
            ->with('groups', Group::getList())
            ->with('user_id', auth()->user()->id)
            ->with('workorder_date', DateFormatter::format());
    }

    public function store(QuoteToWorkorderRequest $request)
    {
        $quote = Quote::find($request->input('quote_id'));

        $workorder = $this->quoteToWorkorder->convert(
            $quote,
            DateFormatter::unformat($request->input('workorder_date')),
            DateFormatter::incrementDateByDays(DateFormatter::unformat($request->input('workorder_date')), config('bt.workordersExpireAfter')),
            $request->input('group_id')
        );

        return response()->json(['redirectTo' => route('workorders.edit', ['id' => $workorder->id])], 200);
    }
}
