<?php

namespace BT\Observers;

use BT\Events\PurchaseorderModified;
use BT\Modules\Purchaseorders\Models\PurchaseorderItem;

class PurchaseorderItemObserver
{
    /**
     * Handle the purchaseorder item "saving" event.
     *
     * @param  \BT\Modules\Purchaseorders\Models\PurchaseorderItem  $purchaseorderItem
     * @return void
     */
    public function saving(PurchaseorderItem $purchaseorderItem): void
    {
        $item = $purchaseorderItem;

        $applyExchangeRate = $item->apply_exchange_rate;
        unset($item->apply_exchange_rate);

        if ($applyExchangeRate == true)
        {
            $item->price = $item->price * $item->purchaseorder->exchange_rate;
        }

        if (!$item->display_order)
        {
            $displayOrder = PurchaseorderItem::where('purchaseorder_id', $item->purchaseorder_id)->max('display_order');

            $displayOrder++;

            $item->display_order = $displayOrder;
        }

        if (is_null($item->tax_rate_id))
        {
            $item->tax_rate_id = 0;
        }

        if (is_null($item->tax_rate_2_id))
        {
            $item->tax_rate_2_id = 0;
        }

        if (!$item->resource_id){
            $item->resource_id = 0;
        }

    }

    /**
     * Handle the purchaseorder item "deleted" event.
     *
     * @param  \BT\Modules\Purchaseorders\Models\PurchaseorderItem  $purchaseorderItem
     * @return void
     */
    public function deleted(PurchaseorderItem $purchaseorderItem): void
    {
        if ($purchaseorderItem->purchaseorder)
        {
            event(new PurchaseorderModified($purchaseorderItem->purchaseorder));
        }
    }

}
