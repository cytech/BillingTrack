<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\API\Controllers;

class ApiKeyController extends ApiController
{
    public function generateKeys()
    {
        return response()->json(['api_public_key' => str_random(32), 'api_secret_key' => str_random(32)]);
    }
}
