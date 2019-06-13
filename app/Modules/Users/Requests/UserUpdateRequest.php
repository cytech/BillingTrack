<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\Users\Requests;

class UserUpdateRequest extends UserStoreRequest
{
    public function rules()
    {
        return [
            'email' => 'required|email|unique:users,email,' . $this->route('id'),
            'name'  => 'required',
        ];
    }
}
