<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Support\Calculators\Interfaces;

interface PayableInterface
{
    /**
     * Set the total paid amount.
     *
     * @param float $totalPaid
     */
    public function setTotalPaid($totalPaid);

    /**
     * Calculate additional properties.
     *
     * @return void
     */
    public function calculatePayments();
}
