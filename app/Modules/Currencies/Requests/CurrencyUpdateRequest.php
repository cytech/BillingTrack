<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\Currencies\Requests;

class CurrencyUpdateRequest extends CurrencyStoreRequest
{
    public function rules()
    {
        return [
            'name'      => 'required',
            'code'      => 'required|unique:currencies,code,' . $this->route('id'),
            'symbol'    => 'required',
            'placement' => 'required',
        ];
    }
}
