<?php

namespace BT\Composers;

use BT\Modules\Currencies\Models\Currency;
use BT\Modules\Invoices\Support\InvoiceTemplates;
use BT\Modules\Quotes\Support\QuoteTemplates;
use BT\Support\Languages;

class ClientFormComposer
{
    public function compose($view)
    {
        $view->with('currencies', Currency::getList())
            ->with('invoiceTemplates', InvoiceTemplates::lists())
            ->with('quoteTemplates', QuoteTemplates::lists())
            ->with('languages', Languages::listLanguages());
    }
}
