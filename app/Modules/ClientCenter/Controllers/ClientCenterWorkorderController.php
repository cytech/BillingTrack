<?php

/**
 * This file is part of FusionInvoiceFOSS.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\ClientCenter\Controllers;

use FI\Http\Controllers\Controller;
use FI\Modules\Workorders\Models\Workorder;
use FI\Support\Statuses\WorkorderStatuses;
use Illuminate\Support\Facades\DB;

class ClientCenterWorkorderController extends Controller
{
    private $workorderStatuses;

    public function __construct(WorkorderStatuses $workorderStatuses)
    {
        $this->workorderStatuses = $workorderStatuses;
    }

    public function index()
    {
        $workorders = Workorder::with(['amount.workorder.currency', 'client'])
            ->where('client_id', auth()->user()->client->id)
            ->orderBy('created_at', 'DESC')
            ->orderBy(DB::raw('length(number)'), 'DESC')
            ->orderBy('number', 'DESC')
            ->paginate(config('fi.resultsPerPage'));

        return view('client_center.workorders.index')
            ->with('workorders', $workorders)
            ->with('workorderStatuses', $this->workorderStatuses->statuses());
    }
}