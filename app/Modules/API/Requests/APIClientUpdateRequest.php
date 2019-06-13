<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\API\Requests;

use BT\Modules\Clients\Requests\ClientUpdateRequest;

class APIClientUpdateRequest extends ClientUpdateRequest
{
    public function rules()
    {
        return [
            'id'          => 'required',
            'email'       => 'email',
            'unique_name' => 'sometimes|unique:clients,unique_name,' . $this->input('id'),
        ];
    }
}
