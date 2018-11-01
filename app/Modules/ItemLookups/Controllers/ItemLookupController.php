<?php

/**
 * This file is part of FusionInvoiceFOSS.
 *
 * 
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\ItemLookups\Controllers;

use FI\Http\Controllers\Controller;
use FI\Modules\ItemLookups\Models\ItemLookup;
use FI\Modules\ItemLookups\Requests\ItemLookupRequest;
use FI\Modules\TaxRates\Models\TaxRate;
use FI\Support\NumberFormatter;

class ItemLookupController extends Controller
{
    public function index()
    {
        $itemLookups = ItemLookup::with(['taxRate', 'taxRate2'])->orderBy('resource_table')->get();

        return view('item_lookups.index')
            ->with('itemLookups', $itemLookups);

    }

    public function create()
    {
        return view('item_lookups.form')
            ->with('editMode', false)
            ->with('taxRates', TaxRate::getList());
    }

    public function store(ItemLookupRequest $request)
    {
        ItemLookup::create($request->all());

        return redirect()->route('itemLookups.index')
            ->with('alertSuccess', trans('fi.record_successfully_created'));
    }

    public function edit($id)
    {
        $itemLookup = ItemLookup::find($id);

        return view('item_lookups.form')
            ->with('editMode', true)
            ->with('itemLookup', $itemLookup)
            ->with('taxRates', TaxRate::getList());
    }

    public function update(ItemLookupRequest $request, $id)
    {
        $itemLookup = ItemLookup::find($id);

        $itemLookup->fill($request->all());

        $itemLookup->save();

        return redirect()->route('itemLookups.index')
            ->with('alertInfo', trans('fi.record_successfully_updated'));
    }

    public function delete($id)
    {
        ItemLookup::destroy($id);

        return redirect()->route('itemLookups.index')
            ->with('alert', trans('fi.record_successfully_deleted'));
    }

    public function getItemLookup()
    {
        $item_lookups = ItemLookup::orderby('resource_table','ASC')->orderby('name','ASC')->get();

        return view('item_lookups.modal_item_lookups')
            ->with('item_lookups',$item_lookups);

    }

    public function processItemLookup(){

        $items = ItemLookup::whereIn('id', request('item_lookup_ids'))->get();

        echo json_encode($items);
    }

    public function ajaxItemLookup()
    {

        $items = ItemLookup::orderBy('name')->where('name', 'like', '%' . request('term') . '%')->get();

        $list = [];

        foreach ($items as $item)
        {
            $list[] = [
                'value'         => $item->name, //for autocomplete
                'name'          => $item->name,
                'description'   => $item->description,
                'price'         => NumberFormatter::format($item->price),
                'tax_rate_id'   => $item->tax_rate_id,
                'tax_rate_2_id' => $item->tax_rate_2_id,
            ];
        }

        return json_encode($list);
    }
}