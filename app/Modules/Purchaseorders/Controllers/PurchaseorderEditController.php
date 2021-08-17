<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\Purchaseorders\Controllers;

use BT\Events\PurchaseorderModified;
use BT\Http\Controllers\Controller;
use BT\Modules\Currencies\Models\Currency;
use BT\Modules\CustomFields\Models\CustomField;
use BT\Modules\Products\Models\Product;
use BT\Modules\Purchaseorders\Models\Purchaseorder;
use BT\Modules\Purchaseorders\Models\PurchaseorderItem;
use BT\Modules\Purchaseorders\Support\PurchaseorderTemplates;
use BT\Modules\Purchaseorders\Requests\PurchaseorderUpdateRequest;
use BT\Modules\ItemLookups\Models\ItemLookup;
use BT\Modules\TaxRates\Models\TaxRate;
use BT\Support\DateFormatter;
use BT\Support\Statuses\PurchaseorderStatuses;
use BT\Traits\ReturnUrl;

class PurchaseorderEditController extends Controller
{
    use ReturnUrl;

    public function edit($id)
    {
        $purchaseorder = Purchaseorder::with(['items.amount.item.purchaseorder.currency'])->find($id);
        return view('purchaseorders.edit')
            ->with('purchaseorder', $purchaseorder)
            ->with('statuses', PurchaseorderStatuses::lists())
            ->with('currencies', Currency::getList())
            ->with('taxRates', TaxRate::getList())
            ->with('customFields', CustomField::forTable('purchaseorders')->get())
            ->with('returnUrl', $this->getReturnUrl())
            ->with('templates', PurchaseorderTemplates::lists())
            ->with('itemCount', count($purchaseorder->purchaseorderItems));
    }

    public function update(PurchaseorderUpdateRequest $request, $id)
    {
        // Unformat the purchaseorder dates.
        $purchaseorderInput                 = $request->except(['items', 'custom', 'apply_exchange_rate']);
        $purchaseorderInput['purchaseorder_date'] = DateFormatter::unformat($purchaseorderInput['purchaseorder_date']);
        $purchaseorderInput['due_at']       = DateFormatter::unformat($purchaseorderInput['due_at']);

        // Save the purchaseorder.
        $purchaseorder = Purchaseorder::find($id);
        $purchaseorder->fill($purchaseorderInput);
        $purchaseorder->save();

        // Save the custom fields.
        $purchaseorder->custom->update(request('custom', []));

        // Save the items.
        foreach ($request->input('items') as $item)
        {
            $item['apply_exchange_rate'] = request('apply_exchange_rate');

            if (!isset($item['id']) or (!$item['id']))
            {
                $saveItemAsProduct = $item['save_item_as_product'];
                unset($item['save_item_as_product']);

                PurchaseorderItem::create($item);

                if ($saveItemAsProduct)
                {
                    Product::create([
                        'name'          => $item['name'],
                        'description'   => $item['description'],
                        'cost'         => $item['cost'],
                        'tax_rate_id'   => $item['tax_rate_id'],
                        'tax_rate_2_id' => $item['tax_rate_2_id'],
                    ]);
                }
            }
            else
            {
                $purchaseorderItem = PurchaseorderItem::find($item['id']);
                $purchaseorderItem->fill($item);
                $purchaseorderItem->save();
            }
        }

        event(new PurchaseorderModified($purchaseorder));
    }

    public function refreshEdit($id)
    {
        $purchaseorder = Purchaseorder::with(['items.amount.item.purchaseorder.currency'])->find($id);

        return view('purchaseorders._edit')
            ->with('purchaseorder', $purchaseorder)
            ->with('statuses', PurchaseorderStatuses::lists())
            ->with('currencies', Currency::getList())
            ->with('taxRates', TaxRate::getList())
            ->with('customFields', CustomField::forTable('purchaseorders')->get())
            ->with('returnUrl', $this->getReturnUrl())
            ->with('templates', PurchaseorderTemplates::lists())
            ->with('itemCount', count($purchaseorder->purchaseorderItems));
    }

    public function refreshTotals()
    {
        return view('purchaseorders._edit_totals')
            ->with('purchaseorder', Purchaseorder::with(['items.amount.item.purchaseorder.currency'])->find(request('id')));
    }

    public function refreshTo()
    {
        return view('purchaseorders._edit_to')
            ->with('purchaseorder', Purchaseorder::find(request('id')));
    }

    public function refreshFrom()
    {
        return view('purchaseorders._edit_from')
            ->with('purchaseorder', Purchaseorder::find(request('id')));
    }

    public function updateVendor()
    {
        Purchaseorder::where('id', request('id'))->update(['vendor_id' => request('vendor_id')]);
    }

    public function updateCompanyProfile()
    {
        Purchaseorder::where('id', request('id'))->update(['company_profile_id' => request('company_profile_id')]);
    }
}
