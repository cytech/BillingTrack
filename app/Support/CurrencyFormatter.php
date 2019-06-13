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

class CurrencyFormatter extends NumberFormatter
{
    /**
     * Formats currency according to BT config.
     *
     * @param  float $amount
     * @param  object $currency
     * @param  integer $decimalPlaces
     * @return string
     */
    public static function format($amount, $currency = null, $decimalPlaces = null)
    {
        $currency      = ($currency) ?: config('bt.currency');
        $decimalPlaces = ($decimalPlaces) ?: config('bt.amountDecimals');

        $amount = parent::format($amount, $currency, $decimalPlaces);

        if ($currency->placement == 'before')
        {
            return $currency->symbol . $amount;
        }

        return $amount . $currency->symbol;
    }
}
