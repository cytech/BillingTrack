<?php

/**
 * This file is part of Workorders Addon for FusionInvoice.
 * (c) Cytech <cytech@cytech-eng.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\Workorders\Requests;

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