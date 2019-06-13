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
use BT\Modules\Quotes\Support\QuoteCalculate;

class QuoteRecalculateController extends Controller
{
    private $quoteCalculate;

    public function __construct(QuoteCalculate $quoteCalculate)
    {
        $this->quoteCalculate = $quoteCalculate;
    }

    public function recalculate()
    {
        try
        {
            $this->quoteCalculate->calculateAll();
        }
        catch (\Exception $e)
        {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => trans('bt.recalculation_complete'),
        ], 200);
    }
}
