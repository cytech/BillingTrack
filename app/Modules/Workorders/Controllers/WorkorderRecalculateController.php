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
use BT\Modules\Workorders\Support\WorkorderCalculate;

class WorkorderRecalculateController extends Controller
{
    private $workorderCalculate;

    public function __construct(WorkorderCalculate $workorderCalculate)
    {
        $this->workorderCalculate = $workorderCalculate;
    }

    public function recalculate()
    {
        try
        {
            $this->workorderCalculate->calculateAll();
        }
        catch (\Exception $e)
        {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => trans('bt.recalculation_complete')
        ], 200);
    }
}
