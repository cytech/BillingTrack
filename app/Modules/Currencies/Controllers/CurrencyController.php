<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\Currencies\Controllers;

use BT\Http\Controllers\Controller;
use BT\Modules\Currencies\Models\Currency;
use BT\Modules\Currencies\Support\CurrencyConverterFactory;
use BT\Modules\Currencies\Requests\CurrencyStoreRequest;
use BT\Modules\Currencies\Requests\CurrencyUpdateRequest;
use BT\Traits\ReturnUrl;

class CurrencyController extends Controller
{
    use ReturnUrl;

    public function index()
    {
        $this->setReturnUrl();

        $currencies = Currency::sortable(['name' => 'asc'])->paginate(config('bt.resultsPerPage'));

        return view('currencies.index')
            ->with('currencies', $currencies)
            ->with('baseCurrency', config('bt.baseCurrency'));
    }

    public function create()
    {
        return view('currencies.form')
            ->with('editMode', false);
    }

    public function store(CurrencyStoreRequest $request)
    {
        Currency::create($request->all());

        return redirect($this->getReturnUrl())
            ->with('alertSuccess', trans('bt.record_successfully_created'));
    }

    public function edit($id)
    {
        return view('currencies.form')
            ->with('editMode', true)
            ->with('currency', Currency::find($id));
    }

    public function update(CurrencyUpdateRequest $request, $id)
    {
        $currency = Currency::find($id);

        $currency->fill($request->all());

        $currency->save();

        return redirect($this->getReturnUrl())
            ->with('alertInfo', trans('bt.record_successfully_updated'));
    }

    public function delete($id)
    {
        $currency = Currency::find($id);

        if ($currency->in_use)
        {
            $alert = trans('bt.cannot_delete_record_in_use');
        }
        else
        {
            Currency::destroy($id);

            $alert = trans('bt.record_successfully_deleted');
        }

        return redirect()->route('currencies.index')
            ->with('alert', $alert);
    }

    public function getExchangeRate()
    {
        $currencyConverter = CurrencyConverterFactory::create();

        if (config('bt.currencyConversionKey')) {

            return $currencyConverter->convert(config('bt.currencyConversionKey'), config('bt.baseCurrency'), request('currency_code'));

        } else {

            return '1.0000000';
        }
    }
}
