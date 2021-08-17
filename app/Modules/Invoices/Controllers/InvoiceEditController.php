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

use BT\Events\InvoiceModified;
use BT\Http\Controllers\Controller;
use BT\Modules\Currencies\Models\Currency;
use BT\Modules\CustomFields\Models\CustomField;
use BT\Modules\Invoices\Models\Invoice;
use BT\Modules\Invoices\Models\InvoiceItem;
use BT\Modules\Invoices\Support\InvoiceTemplates;
use BT\Modules\Invoices\Requests\InvoiceUpdateRequest;
use BT\Modules\ItemLookups\Models\ItemLookup;
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

                InvoiceItem::create($item);
                // product numstock update - moved to InvoiceItemObserver:created()

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
                                $invoiceItem->product->decrement('numstock', $qtydiff);
                                break;
                            case 1:
                                $invoiceItem->product->increment('numstock', $qtydiff);
                                break;
                        }
                    }

                    // if status changed to sent from draft or canceled
                    if (($oldstatus == 1 || $oldstatus == 4) && $newstatus == 2) {
                        // if item has NOT already been tracked and item is tracked inventory, decrement onhand
                        if ($invoiceItem->resource_id && !$invoiceItem->is_tracked && $invoiceItem->resource_table == 'products'
                            && $invoiceItem->product()->tracked()->get()->isNotEmpty()) {
                            $invoiceItem->product->decrement('numstock', $item['quantity']);
                            $invoiceItem->is_tracked = 1;
                        }
                    }
                    //if status changed from sent to draft or canceled
                    if ($oldstatus == 2 && ($newstatus == 1 || $newstatus == 4)) {
                        // if item has already been tracked and item is tracked inventory, increment onhand
                        if ($invoiceItem->resource_id && $invoiceItem->is_tracked && $invoiceItem->resource_table == 'products'
                            && $invoiceItem->product()->tracked()->get()->isNotEmpty()) {
                            $invoiceItem->product->increment('numstock', $item['quantity']);
                            $invoiceItem->is_tracked = 0;
                        }
                    }
                }
                $invoiceItem->fill($item);
                $invoiceItem->save();
            }
        }

        event(new InvoiceModified($invoice));
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
