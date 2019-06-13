<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\Invoices\Controllers;

use BT\Http\Controllers\Controller;
use BT\Modules\Invoices\Support\InvoiceCalculate;

class InvoiceRecalculateController extends Controller
{
    private $invoiceCalculate;

    public function __construct(InvoiceCalculate $invoiceCalculate)
    {
        $this->invoiceCalculate = $invoiceCalculate;
    }

    public function recalculate()
    {
        try
        {
            $this->invoiceCalculate->calculateAll();
        }
        catch (\Exception $e)
        {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }

        return response()->json(['success' => true, 'message' => trans('bt.recalculation_complete')], 200);
    }
}
