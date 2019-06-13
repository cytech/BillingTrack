<?php

/**
 * This file is part of BillingTrack.
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\Workorders\Requests;

class WorkorderToInvoiceRequest extends WorkorderStoreRequest
{
    public function rules()
    {
        return [
            'client_id'    => 'required',
            'workorder_date' => 'required',
            'group_id'     => 'required',
        ];
    }
}
