<?php

namespace BT\Observers;

use BT\Events\QuoteModified;
use BT\Modules\Quotes\Models\QuoteItem;

class QuoteItemObserver
{
    /**
     * Handle the quote item "saving" event.
     *
     * @param  \BT\Modules\Quotes\Models\QuoteItem  $quoteItem
     * @return void
     */
    public function saving(QuoteItem $quoteItem): void
    {
        $item = $quoteItem;

        $applyExchangeRate = $item->apply_exchange_rate;
        unset($item->apply_exchange_rate);

        if ($applyExchangeRate == true)
        {
            $item->price = $item->price * $item->quote->exchange_rate;
        }

        if (!$item->display_order)
        {
            $displayOrder = QuoteItem::where('quote_id', $item->quote_id)->max('display_order');

            $displayOrder++;

            $item->display_order = $displayOrder;
        }

        if (!$item->resource_id){
            $item->resource_id = 0;
        }
    }

    /**
     * Handle the quote item "deleted" event.
     *
     * @param  \BT\Modules\Quotes\Models\QuoteItem  $quoteItem
     * @return void
     */
    public function deleted(QuoteItem $quoteItem): void
    {
        event(new QuoteModified($quoteItem->quote));

    }

}
