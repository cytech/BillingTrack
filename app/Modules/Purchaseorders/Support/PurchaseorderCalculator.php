<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\Purchaseorders\Support;

use BT\Support\Calculators\Calculator;
use BT\Support\Calculators\Interfaces\PayableInterface;

class PurchaseorderCalculator extends Calculator implements PayableInterface
{
    /**
     * Call the calculation methods.
     */
    public function calculate()
    {
        $this->calculateItems();
        $this->calculatePayments();
    }

    /**
     * Set the total paid amount.
     *
     * @param float $totalPaid
     */
    public function setTotalPaid($totalPaid)
    {
        if ($totalPaid)
        {
            $this->calculatedAmount['paid'] = $totalPaid;
        }
        else
        {
            $this->calculatedAmount['paid'] = 0;
        }
    }

    /**
     * Calculate additional properties.
     *
     * @return void
     */
    public function calculatePayments()
    {
        if (!$this->isCanceled)
        {
            $this->calculatedAmount['balance'] = round($this->calculatedAmount['total'], 2) - $this->calculatedAmount['paid'];
        }
        else
        {
            $this->calculatedAmount['balance'] = 0;
        }
    }
}
