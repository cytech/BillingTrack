<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\Quotes\Support;

use FI\Events\WorkorderModified;
use FI\Modules\CustomFields\Models\CustomField;
use FI\Modules\Groups\Models\Group;
use FI\Modules\Workorders\Models\Workorder;
use FI\Modules\Workorders\Models\WorkorderItem;
use FI\Support\Statuses\WorkorderStatuses;
use FI\Support\Statuses\QuoteStatuses;

class QuoteToWorkorder
{
    public function convert($quote, $workorderDate, $expiresAt, $groupId)
    {
        $record = [
            'client_id'          => $quote->client_id,
            'workorder_date'     => $workorderDate,
            'expires_at'         => $expiresAt,
            'group_id'           => $groupId,
            'number'             => Group::generateNumber($groupId),
            'user_id'            => $quote->user_id,
            'workorder_status_id'  => WorkorderStatuses::getStatusId('draft'),
            'terms'              => ((config('fi.convertQuoteTerms') == 'quote') ? $quote->terms : config('fi.workorderTerms')),
            'footer'             => $quote->footer,
            'currency_code'      => $quote->currency_code,
            'exchange_rate'      => $quote->exchange_rate,
            'summary'            => $quote->summary,
            'discount'           => $quote->discount,
            'company_profile_id' => $quote->company_profile_id,
        ];

        $toWorkorder = Workorder::create($record);

        CustomField::copyCustomFieldValues($quote, $toWorkorder);

        $quote->workorder_id      = $toWorkorder->id;
        $quote->quote_status_id = QuoteStatuses::getStatusId('approved');
        $quote->save();

        foreach ($quote->quoteItems as $item)
        {
            $itemRecord = [
                'workorder_id'    => $toWorkorder->id,
                'name'          => $item->name,
                'description'   => $item->description,
                'quantity'      => $item->quantity,
                'price'         => $item->price,
                'tax_rate_id'   => $item->tax_rate_id,
                'tax_rate_2_id' => $item->tax_rate_2_id,
                'resource_table' => $item->resource_table,
                'resource_id'    => $item->resource_id,
                'display_order' => $item->display_order,
            ];

            WorkorderItem::create($itemRecord);
        }

        event(new WorkorderModified($toWorkorder));

        return $toWorkorder;
    }
}
