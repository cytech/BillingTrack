<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\Currencies\Support\Drivers;

class FixerIOCurrencyConverter
{
    /**
     * Returns the currency conversion rate.
     *
     * @param  string $cc_key
     * @param  string $from
     * @param  string $to
     * @return float|int
     */
    public function convert($cc_key,$from, $to)
    {
        try
        {
            $result = json_decode(file_get_contents('http://data.fixer.io/api/latest?access_key='. $cc_key . '&symbols='. $from . ',' . $to ), true);

            //fixer free api only accepts EUR as base so...
            $convrate = $result['rates'][strtoupper($to)] / $result['rates'][strtoupper($from)];

            return $convrate;
        }
        catch (\Exception $e)
        {
            return '1.0000000';
        }

    }
}
