<?php

namespace BT\Observers;

use BT\Events\RecurringInvoiceModified;
use BT\Modules\RecurringInvoices\Models\RecurringInvoiceItem;

class RecurringInvoiceItemObserver
{
    /**
     * Handle the recurring invoice item "saving" event.
     *
     * @param  \BT\Modules\RecurringInvoices\Models\RecurringInvoiceItem  $recurringInvoiceItem
     * @return void
     */
    public function saving(RecurringInvoiceItem $recurringInvoiceItem): void
    {
        $item = $recurringInvoiceItem;

        $applyExchangeRate = $item->apply_exchange_rate;
        unset($item->apply_exchange_rate);

        if ($applyExchangeRate == true)
        {
            $item->price = $item->price * $item->invoice->exchange_rate;
        }

        if (!$item->display_order)
        {
            $displayOrder = RecurringInvoiceItem::where('invoice_id', $item->recurring_invoice_id)->max('display_order');

            $displayOrder++;

            $item->display_order = $displayOrder;
        }

        if (!$item->resource_id){
            $item->resource_id = 0;
        }
    }

    /**
     * Handle the recurring invoice item "deleted" event.
     *
     * @param  \BT\Modules\RecurringInvoices\Models\RecurringInvoiceItem  $recurringInvoiceItem
     * @return void
     */
    public function deleted(RecurringInvoiceItem $recurringInvoiceItem): void
    {
        event(new RecurringInvoiceModified($recurringInvoiceItem->recurringInvoice));

    }

}
