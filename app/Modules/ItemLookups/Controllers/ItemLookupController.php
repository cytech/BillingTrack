<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\ItemLookups\Controllers;

use BT\DataTables\ItemLookupsDataTable;
use BT\Http\Controllers\Controller;
use BT\Modules\ItemLookups\Models\ItemLookup;
use BT\Modules\ItemLookups\Requests\ItemLookupRequest;
use BT\Modules\TaxRates\Models\TaxRate;
use BT\Support\NumberFormatter;

class ItemLookupController extends Controller
{
    public function index(ItemLookupsDataTable $dataTable)
    {
        return $dataTable->render('item_lookups.index');
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
            ->with('alertSuccess', trans('bt.record_successfully_created'));
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
            ->with('alertInfo', trans('bt.record_successfully_updated'));
    }

    public function delete($id)
    {
        ItemLookup::destroy($id);

        return redirect()->route('itemLookups.index')
            ->with('alert', trans('bt.record_successfully_deleted'));
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
                'resource_table' => $item->resource_table,
                'resource_id' => $item->resource_id
            ];
        }

        return json_encode($list);
    }
}
