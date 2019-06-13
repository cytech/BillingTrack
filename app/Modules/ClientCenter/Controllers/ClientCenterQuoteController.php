<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\ClientCenter\Controllers;

use BT\Http\Controllers\Controller;
use BT\Modules\Quotes\Models\Quote;
use BT\Support\Statuses\QuoteStatuses;
use Illuminate\Support\Facades\DB;

class ClientCenterQuoteController extends Controller
{
    private $quoteStatuses;

    public function __construct(QuoteStatuses $quoteStatuses)
    {
        $this->quoteStatuses = $quoteStatuses;
    }

    public function index()
    {
        $quotes = Quote::with(['amount.quote.currency', 'client'])
            ->where('client_id', auth()->user()->client->id)
            ->orderBy('created_at', 'DESC')
            ->orderBy(DB::raw('length(number)'), 'DESC')
            ->orderBy('number', 'DESC')
            ->paginate(config('bt.resultsPerPage'));

        return view('client_center.quotes.index')
            ->with('quotes', $quotes)
            ->with('quoteStatuses', $this->quoteStatuses->statuses());
    }
}
