<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\Clients\Requests;

class ClientUpdateRequest extends ClientStoreRequest
{
    public function rules()
    {
        $rules = parent::rules();

        $rules['unique_name'] = 'required|unique:clients,unique_name,' . $this->route('id');

        return $rules;
    }
}
