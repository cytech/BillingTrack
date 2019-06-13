<?php

/**
 * *
 *  * This file is part of BillingTrack.
 *  *
 *  *
 *  * For the full copyright and license information, please view the LICENSE
 *  * file that was distributed with this source code.
 *
 *
 */

namespace BT\Modules\API\Requests;

use BT\Modules\Workorders\Requests\WorkorderStoreRequest;

class APIWorkorderStoreRequest extends WorkorderStoreRequest
{
    public function rules()
    {
        $rules = parent::rules();

        unset($rules['user_id']);

        return $rules;
    }
}
