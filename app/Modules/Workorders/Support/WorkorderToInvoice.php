<?php

/**
 * This file is part of BillingTrack.
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\Workorders\Support;

use BT\Events\InvoiceModified;
use BT\Modules\CustomFields\Models\CustomField;
use BT\Modules\Groups\Models\Group;
use BT\Modules\Invoices\Models\Invoice;
use BT\Modules\Invoices\Models\InvoiceItem;
use BT\Support\Statuses\InvoiceStatuses;
use BT\Support\Statuses\WorkorderStatuses;

class WorkorderToInvoice
{
    public function convert($workorder, $invoiceDate, $dueAt, $groupId)
    {
        $record = [
            'client_id'         => $workorder->client_id,
            'invoice_date'        => $invoiceDate,
            'due_at'            => $dueAt,
            'group_id'          => $groupId,
            'number'             => Group::generateNumber($groupId),
            'user_id'           => $workorder->user_id,
            'invoice_status_id' => InvoiceStatuses::getStatusId('draft'),
            'terms'             => ((config('bt.convertWorkorderTerms') == 'workorder') ? $workorder->terms : config('bt.invoiceTerms')),
            'footer'            => $workorder->footer,
            'currency_code'     => $workorder->currency_code,
            'exchange_rate'     => $workorder->exchange_rate,
            'summary'           => $workorder->summary,
            'discount'          => $workorder->discount,
            'company_profile_id' => $workorder->company_profile_id,
        ];

        $toInvoice = Invoice::create($record);

        CustomField::copyCustomFieldValues($workorder, $toInvoice);

        $workorder->invoice_id = $toInvoice->id;
	    $workorder->workorder_status_id = WorkorderStatuses::getStatusId('approved');
        $workorder->save();

        foreach ($workorder->workorderItems as $item)
        {
            $itemRecord = [
                'invoice_id'    => $toInvoice->id,
                'name'          => $item->name,
                'description'   => $item->description,
                'quantity'      => $item->quantity,
                'price'         => $item->price,
                'tax_rate_id'   => $item->tax_rate_id,
                'tax_rate_2_id' => $item->tax_rate_2_id,
                'resource_table' => $item->resource_table,
                'resource_id'    => $item->resource_id,
                'display_order' => $item->display_order
            ];

            InvoiceItem::create($itemRecord);
        }

        event(new InvoiceModified($toInvoice));

        return $toInvoice;
    }
}
