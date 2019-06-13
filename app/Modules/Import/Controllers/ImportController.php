<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\Import\Controllers;

use BT\Http\Controllers\Controller;
use BT\Modules\Import\Importers\ImportFactory;
use BT\Modules\Import\Requests\ImportRequest;

class ImportController extends Controller
{
    public function index()
    {
        $importTypes = [
            'clients'      => trans('bt.clients'),
            'quotes'       => trans('bt.quotes'),
            'quoteItems'   => trans('bt.quote_items'),
            'invoices'     => trans('bt.invoices'),
            'invoiceItems' => trans('bt.invoice_items'),
            'payments'     => trans('bt.payments'),
            'expenses'     => trans('bt.expenses'),
            'itemLookups'  => trans('bt.item_lookups'),
        ];

        return view('import.index')
            ->with('importTypes', $importTypes);
    }

    public function upload(ImportRequest $request)
    {
        $request->file('import_file')->move(storage_path(), $request->input('import_type') . '.csv');

        return redirect()->route('import.map', [$request->input('import_type')]);
    }

    public function mapImport($importType)
    {
        $importer = ImportFactory::create($importType);

        return view('import.map')
            ->with('importType', $importType)
            ->with('importFields', $importer->getFields($importType))
            ->with('fileFields', $importer->getFileFields(storage_path($importType . '.csv')));
    }

    public function mapImportSubmit($importType)
    {
        $importer = ImportFactory::create($importType);

        if (!$importer->validateMap(request()->all()))
        {
            return redirect()->route('import.map', [$importType])
                ->withErrors($importer->errors())
                ->withInput();
        }

        if (!$importer->importData(request()->except('_token')))
        {
            return redirect()->route('import.map', [$importType])
                ->withErrors($importer->errors());
        }

        return redirect()->route('import.index')
            ->with('alertInfo', trans('bt.records_imported_successfully'));
    }
}
