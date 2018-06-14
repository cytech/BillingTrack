<?php

/**
 * This file is part of FusionInvoiceFOSS.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Addons\TimeTracking;

use FI\Support\Statuses\AbstractStatuses;

class ProjectStatuses extends AbstractStatuses
{
    protected static $statuses = [
        '0' => 'all_statuses',
        '1' => 'active',
        '2' => 'inactive',
        '3' => 'canceled'
    ];
}