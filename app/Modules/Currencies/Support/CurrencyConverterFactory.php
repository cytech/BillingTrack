<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\Currencies\Support;

class CurrencyConverterFactory
{
    public static function create()
    {
        $class = 'BT\Modules\Currencies\Support\Drivers\\' . config('bt.currencyConversionDriver');

        return new $class;
    }
}
