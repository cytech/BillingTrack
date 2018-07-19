<?php

/**
 * This file is part of Workorders Addon for FusionInvoice.
 * (c) Cytech <cytech@cytech-eng.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Addons\Workorders\Controllers;

use FI\Modules\ItemLookups\Models\ItemLookup;
use FI\Modules\ItemLookups\Controllers\ItemLookupController as FIItemLookupController;
use FI\Support\NumberFormatter;

class ItemLookupController extends FIItemLookupController
{

    public function getItemLookup()
    {
        $item_lookups = ItemLookup::orderby('resource_table','ASC')->orderby('category','ASC')->orderby('name','ASC')->get();

        return view('itemlookups.modal_item_lookups')
            ->with('item_lookups',$item_lookups);

    }

    public function processItemLookup(){

        $items = ItemLookup::whereIn('id', request('item_lookup_ids'))->get();

        echo json_encode($items);
    }

    public function ajaxItemLookup()
    {
        $items = ItemLookup::orderBy('name')->where('name', 'like', '%' . request('query') . '%')->get();

        $list = [];

        foreach ($items as $item)
        {
            $list[] = [
                'name' => $item->name,
                'description' => $item->description,
                'price' => NumberFormatter::format($item->price),
                'resource_table' => $item->resource_table,
                'resource_id' => $item->resource_id,
                'tax_rate_id' => $item->tax_rate_id,
                'tax_rate_2_id' => $item->tax_rate_2_id,
            ];
        }

        return json_encode($list);
    }
}