<?php

namespace BT\Observers;

use BT\Events\WorkorderModified;
use BT\Modules\Workorders\Models\WorkorderItem;

class WorkorderItemObserver
{
    /**
     * Handle the workorder item "saving" event.
     *
     * @param  \BT\Modules\Workorders\Models\WorkorderItem  $workorderItem
     * @return void
     */
    public function saving(WorkorderItem $workorderItem): void
    {
        $item = $workorderItem;

        $applyExchangeRate = $item->apply_exchange_rate;
        unset($item->apply_exchange_rate);

        if ($applyExchangeRate == true)
        {
            $item->price = $item->price * $item->workorder->exchange_rate;
        }

        if (!$item->display_order)
        {
            $displayOrder = WorkorderItem::where('workorder_id', $item->workorder_id)->max('display_order');

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
     * Handle the workorder item "deleted" event.
     *
     * @param  \BT\Modules\Workorders\Models\WorkorderItem  $workorderItem
     * @return void
     */
    public function deleted(WorkorderItem $workorderItem): void
    {
        event(new WorkorderModified($workorderItem->workorder));

    }

}
