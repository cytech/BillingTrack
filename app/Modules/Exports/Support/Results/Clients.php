<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\Exports\Support\Results;

use BT\Modules\Clients\Models\Client;

class Clients implements SourceInterface
{
    public function getResults($params = [])
    {
        $client = Client::orderBy('name');

        return $client->get()->makeHidden('formatted_balance')->toArray();
    }
}
