<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\Quotes\Controllers;

use FI\Http\Controllers\Controller;
use FI\Modules\Groups\Models\Group;
use FI\Modules\Quotes\Models\Quote;
use FI\Modules\Quotes\Support\QuoteToWorkorder;
use FI\Modules\Quotes\Requests\QuoteToWorkorderRequest;
use FI\Support\DateFormatter;

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
            DateFormatter::incrementDateByDays(DateFormatter::unformat($request->input('workorder_date')), config('fi.workordersExpireAfter')),
            $request->input('group_id')
        );

        return response()->json(['redirectTo' => route('workorders.edit', ['workorder' => $workorder->id])], 200);
    }
}
