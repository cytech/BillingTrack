<?php

/**
 * This file is part of Workorders Addon for FusionInvoice.
 * (c) Cytech <cytech@cytech-eng.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
 
namespace Addons\Workorders\Controllers;

use FI\Http\Controllers\Controller;
use Addons\Workorders\Support\WorkorderCalculate;

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
            'message' => trans('fi.recalculation_complete')
        ], 200);
    }
}