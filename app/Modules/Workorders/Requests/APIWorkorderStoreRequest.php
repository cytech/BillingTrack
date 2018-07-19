<?php

/**
 * *
 *  * This file is part of Workorder Addon for FusionInvoice.
 *  * (c) Cytech <cytech@cytech-eng.com>
 *  *
 *  * For the full copyright and license information, please view the LICENSE
 *  * file that was distributed with this source code.
 *
 *
 */

namespace Addons\Workorders\Requests;

use Addons\Workorders\Requests\WorkorderStoreRequest;

class APIWorkorderStoreRequest extends WorkorderStoreRequest
{
    public function rules()
    {
        $rules = parent::rules();

        unset($rules['user_id']);

        return $rules;
    }
}