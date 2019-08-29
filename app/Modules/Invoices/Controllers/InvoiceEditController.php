<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\Invoices\Controllers;

use BT\Http\Controllers\Controller;
use BT\Modules\Currencies\Models\Currency;
use BT\Modules\CustomFields\Models\CustomField;
use BT\Modules\Invoices\Models\Invoice;
use BT\Modules\Invoices\Models\InvoiceItem;
use BT\Modules\Invoices\Support\InvoiceTemplates;
use BT\Modules\Invoices\Requests\InvoiceUpdateRequest;
use BT\Modules\ItemLookups\Models\ItemLookup;
use BT\Modules\Products\Models\Product;
use BT\Modules\TaxRates\Models\TaxRate;
use BT\Support\DateFormatter;
use BT\Support\Statuses\InvoiceStatuses;
use BT\Traits\ReturnUrl;

class InvoiceEditController extends Controller
{
    use ReturnUrl;

    public function edit($id)
    {
        $invoice = Invoice::with(['items.amount.item.invoice.currency'])->find($id);

        return view('invoices.edit')
            ->with('invoice', $invoice)
            ->with('statuses', InvoiceStatuses::lists())
            ->with('currencies', Currency::getList())
            ->with('taxRates', TaxRate::getList())
            ->with('customFields', CustomField::forTable('invoices')->get())
            ->with('returnUrl', $this->getReturnUrl())
            ->with('templates', InvoiceTemplates::lists())
            ->with('itemCount', count($invoice->invoiceItems));
    }

    public function update(InvoiceUpdateRequest $request, $id)
    {
        // Unformat the invoice dates.
        $invoiceInput = $request->except(['items', 'custom', 'apply_exchange_rate']);
        $invoiceInput['invoice_date'] = DateFormatter::unformat($invoiceInput['invoice_date']);
        $invoiceInput['due_at'] = DateFormatter::unformat($invoiceInput['due_at']);

        // Save the invoice.
        $invoice = Invoice::find($id);
        $oldstatus = $invoice->invoice_status_id;
        $newstatus = $invoiceInput['invoice_status_id'];
        $invoice->fill($invoiceInput);
        $invoice->save();

        // Save the custom fields.
        $invoice->custom->update(request('custom', []));

        // Save the items.
        foreach ($request->input('items') as $item) {
            $item['apply_exchange_rate'] = request('apply_exchange_rate');

            if (!isset($item['id']) or (!$item['id'])) {
                $saveItemAsLookup = $item['save_item_as_lookup'];
                unset($item['save_item_as_lookup']);

                $newitem = InvoiceItem::create($item);
                // product numstock update
                // if inv tracking is on and invoice is sent
                // and item is tracked inventory, decrement onhand
                if (config('bt.updateInvProductsDefault') && $newitem->invoice->status_text == 'sent') {
                    if ($newitem->resource_id && $newitem->resource_table == 'products'
                        && $newitem->product()->tracked()->get()->isNotEmpty()) {
                        $newitem->product->numstock -= $newitem->quantity;
                        $newitem->product->save();
                        $newitem->is_tracked = 1;
                        $newitem->save();
                    }
                }

                if ($saveItemAsLookup) {
                    ItemLookup::create([
                        'name'          => $item['name'],
                        'description'   => $item['description'],
                        'price'         => $item['price'],
                        'tax_rate_id'   => $item['tax_rate_id'],
                        'tax_rate_2_id' => $item['tax_rate_2_id'],
                    ]);
                }
            } else {
                $invoiceItem = InvoiceItem::find($item['id']);
                $qtydiff = abs($invoiceItem->quantity - $item['quantity']);
                // product numstock updating
                if (config('bt.updateInvProductsDefault')) {
                    // if quantity changed
                    if ($qtydiff && $invoiceItem->is_tracked) {
                        switch ($invoiceItem->quantity <=> $item['quantity']) {
                            case 0:
                                break;
                            case -1:
                                // decrement numstock
                                $product = Product::find($invoiceItem->resource_id);
                                $product->numstock -= $qtydiff;
                                $product->save();
                                break;
                            case 1:
                                // increment numstock
                                $product = Product::find($invoiceItem->resource_id);
                                $product->numstock += $qtydiff;
                                $product->save();
                                break;
                        }
                    }

                    // if status changed to sent from draft or canceled
                    if (($oldstatus == 1 || $oldstatus == 4) && $newstatus == 2) {
                        // if item has NOT already been tracked
                        // and item is tracked inventory, decrement onhand
                        if ($invoiceItem->resource_id && !$invoiceItem->is_tracked && $invoiceItem->resource_table == 'products'
                            && $invoiceItem->product()->tracked()->get()->isNotEmpty()) {
                            $invoiceItem->product->numstock -= $item['quantity'];
                            $invoiceItem->product->save();
                            $invoiceItem->is_tracked = 1;
                        }
                    }
                    //if status changed from sent to draft or canceled
                    if ($oldstatus == 2 && ($newstatus == 1 || $newstatus == 4)) {
                        // if item has already been tracked
                        // and item is tracked inventory, increment onhand
                        if ($invoiceItem->resource_id && $invoiceItem->is_tracked && $invoiceItem->resource_table == 'products'
                            && $invoiceItem->product()->tracked()->get()->isNotEmpty()) {
                            $invoiceItem->product->numstock += $invoiceItem->quantity;
                            $invoiceItem->product->save();
                            $invoiceItem->is_tracked = 0;
                        }
                    }
                }
                $invoiceItem->fill($item);
                $invoiceItem->save();
            }
        }
    }

    public function refreshEdit($id)
    {
        $invoice = Invoice::with(['items.amount.item.invoice.currency'])->find($id);

        return view('invoices._edit')
            ->with('invoice', $invoice)
            ->with('statuses', InvoiceStatuses::lists())
            ->with('currencies', Currency::getList())
            ->with('taxRates', TaxRate::getList())
            ->with('customFields', CustomField::forTable('invoices')->get())
            ->with('returnUrl', $this->getReturnUrl())
            ->with('templates', InvoiceTemplates::lists())
            ->with('itemCount', count($invoice->invoiceItems));
    }

    public function refreshTotals()
    {
        return view('invoices._edit_totals')
            ->with('invoice', Invoice::with(['items.amount.item.invoice.currency'])->find(request('id')));
    }

    public function refreshTo()
    {
        return view('invoices._edit_to')
            ->with('invoice', Invoice::find(request('id')));
    }

    public function refreshFrom()
    {
        return view('invoices._edit_from')
            ->with('invoice', Invoice::find(request('id')));
    }

    public function updateClient()
    {
        Invoice::where('id', request('id'))->update(['client_id' => request('client_id')]);
    }

    public function updateCompanyProfile()
    {
        Invoice::where('id', request('id'))->update(['company_profile_id' => request('company_profile_id')]);
    }
}
