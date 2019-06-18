<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\Purchaseorders\Controllers;

use BT\Http\Controllers\Controller;
use BT\Modules\Purchaseorders\Support\PurchaseorderCalculate;

class PurchaseorderRecalculateController extends Controller
{
    private $purchaseorderCalculate;

    public function __construct(PurchaseorderCalculate $purchaseorderCalculate)
    {
        $this->purchaseorderCalculate = $purchaseorderCalculate;
    }

    public function recalculate()
    {
        try
        {
            $this->purchaseorderCalculate->calculateAll();
        }
        catch (\Exception $e)
        {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }

        return response()->json(['success' => true, 'message' => trans('bt.recalculation_complete')], 200);
    }
}
