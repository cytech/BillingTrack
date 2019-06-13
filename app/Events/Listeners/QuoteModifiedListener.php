<?php

namespace BT\Events\Listeners;

use BT\Events\QuoteModified;
use BT\Modules\Quotes\Support\QuoteCalculate;

class QuoteModifiedListener
{
    public function __construct(QuoteCalculate $quoteCalculate)
    {
        $this->quoteCalculate = $quoteCalculate;
    }

    public function handle(QuoteModified $event)
    {
        // Calculate the quote and item amounts
        $this->quoteCalculate->calculate($event->quote);
    }
}
