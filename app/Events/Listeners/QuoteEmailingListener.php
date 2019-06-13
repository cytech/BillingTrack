<?php

namespace BT\Events\Listeners;

use BT\Events\QuoteEmailing;
use BT\Support\DateFormatter;

class QuoteEmailingListener
{
    public function handle(QuoteEmailing $event)
    {
        if (config('bt.resetQuoteDateEmailDraft') and $event->quote->status_text == 'draft')
        {
            $event->quote->quote_date = date('Y-m-d');
            $event->quote->expires_at = DateFormatter::incrementDateByDays(date('Y-m-d'), config('bt.quotesExpireAfter'));
            $event->quote->save();
        }
    }
}
