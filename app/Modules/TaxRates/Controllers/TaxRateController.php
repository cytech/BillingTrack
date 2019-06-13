<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\TaxRates\Controllers;

use BT\Http\Controllers\Controller;
use BT\Modules\TaxRates\Models\TaxRate;
use BT\Modules\TaxRates\Requests\TaxRateRequest;
use BT\Traits\ReturnUrl;

class TaxRateController extends Controller
{
    use ReturnUrl;

    public function index()
    {
        $this->setReturnUrl();

        $taxRates = TaxRate::sortable(['name' => 'asc'])->paginate(config('bt.resultsPerPage'));

        return view('tax_rates.index')
            ->with('taxRates', $taxRates);
    }

    public function create()
    {
        return view('tax_rates.form')
            ->with('editMode', false);
    }

    public function store(TaxRateRequest $request)
    {
        TaxRate::create($request->all());

        return redirect($this->getReturnUrl())
            ->with('alertSuccess', trans('bt.record_successfully_created'));
    }

    public function edit($id)
    {
        $taxRate = TaxRate::find($id);

        return view('tax_rates.form')
            ->with('editMode', true)
            ->with('taxRate', $taxRate);
    }

    public function update(TaxRateRequest $request, $id)
    {
        $taxRate = TaxRate::find($id);

        $taxRate->fill($request->all());

        $taxRate->save();

        return redirect($this->getReturnUrl())
            ->with('alertInfo', trans('bt.record_successfully_updated'));
    }

    public function delete($id)
    {
        $taxRate = TaxRate::find($id);

        if ($taxRate->in_use)
        {
            $alert = trans('bt.cannot_delete_record_in_use');
        }
        else
        {
            $taxRate->delete();

            $alert = trans('bt.record_successfully_deleted');
        }

        return redirect()->route('taxRates.index')
            ->with('alert', $alert);
    }
}
