<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

function formatAddress($object)
{
    if ($object->address or $object->city or $object->state or $object->zip or $object->country)
    {
        $address = config('fi.addressFormat');

        $address = str_replace('{{ address }}', $object->address, $address);
        $address = str_replace('{{ city }}', $object->city, $address);
        $address = str_replace('{{ state }}', $object->state, $address);
        $address = str_replace('{{ zip }}', $object->zip, $address);
        $address = str_replace('{{ zip_code }}', $object->zip, $address);
        $address = str_replace('{{ postal_code }}', $object->zip, $address);
        $address = str_replace('{{ country }}', $object->country, $address);

        return $address;
    }

    return '';
}
