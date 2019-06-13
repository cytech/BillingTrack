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

use Illuminate\Routing\Controller;

class ApiController extends Controller
{
    protected $validator;

    public function __construct()
    {
        $this->validator = app('Illuminate\Validation\Factory');
    }
}
