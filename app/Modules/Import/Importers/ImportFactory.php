<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\Import\Importers;

class ImportFactory
{
    public static function create($importType)
    {
        switch ($importType)
        {
            case 'clients':
                return app()->make('BT\Modules\Import\Importers\ClientImporter');
            case 'quotes':
                return app()->make('BT\Modules\Import\Importers\QuoteImporter');
            case 'invoices':
                return app()->make('BT\Modules\Import\Importers\InvoiceImporter');
            case 'payments':
                return app()->make('BT\Modules\Import\Importers\PaymentImporter');
            case 'invoiceItems':
                return app()->make('BT\Modules\Import\Importers\InvoiceItemImporter');
            case 'quoteItems':
                return app()->make('BT\Modules\Import\Importers\QuoteItemImporter');
            case 'itemLookups':
                return app()->make('BT\Modules\Import\Importers\ItemLookupImporter');
            case 'expenses':
                return app('BT\Modules\Import\Importers\ExpenseImporter');
        }
    }
}
