<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\Exports\Controllers;

use BT\Http\Controllers\Controller;
use BT\Modules\Exports\Support\Export;

class ExportController extends Controller
{
    public function index()
    {
        return view('export.index')
            ->with('writers', ['CsvWriter' => 'CSV', 'JsonWriter' => 'JSON', 'XlsWriter' => 'XLS', 'XmlWriter' => 'XML']);
    }

    public function export($exportType)
    {
        $export = new Export($exportType, request('writer'));

        $export->writeFile();

        return response()->download($export->getDownloadPath());
    }
}
