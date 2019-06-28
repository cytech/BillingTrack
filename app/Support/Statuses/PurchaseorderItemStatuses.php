<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Support\Statuses;

class PurchaseorderItemStatuses extends AbstractStatuses
{
    protected static $statuses = [
        '0' => 'unprocessed',
        '1' => 'open',
        '2' => 'received',
        '3' => 'partial',
        '4' => 'canceled',
        '5' => 'extra'
    ];
}
