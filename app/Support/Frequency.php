<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Support;

class Frequency
{
    /**
     * Returns a list of frequencies for recurring invoices.
     *
     * @return array
     */
    public static function lists()
    {
        return [
            '1' => trans('bt.days'),
            '2' => trans('bt.weeks'),
            '3' => trans('bt.months'),
            '4' => trans('bt.years')
        ];
    }
}
