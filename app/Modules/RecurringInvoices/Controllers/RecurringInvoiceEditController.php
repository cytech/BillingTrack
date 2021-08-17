<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\RecurringInvoices\Controllers;

use BT\Events\RecurringInvoiceModified;
use BT\Http\Controllers\Controller;
use BT\Modules\Currencies\Models\Currency;
use BT\Modules\CustomFields\Models\CustomField;
use BT\Modules\Groups\Models\Group;
use BT\Modules\Invoices\Support\InvoiceTemplates;
use BT\Modules\ItemLookups\Models\ItemLookup;
use BT\Modules\RecurringInvoices\Models\RecurringInvoice;
use BT\Modules\RecurringInvoices\Models\RecurringInvoiceItem;
use BT\Modules\RecurringInvoices\Requests\RecurringInvoiceUpdateRequest;
use BT\Modules\TaxRates\Models\TaxRate;
use BT\Support\DateFormatter;
use BT\Support\Frequency;
use BT\Traits\ReturnUrl;

class RecurringInvoiceEditController extends Controller
{
    use ReturnUrl;

    public function edit($id)
    {
        $recurringInvoice = RecurringInvoice::with(['items.amount.item.recurringInvoice.currency'])->find($id);

        return view('recurring_invoices.edit')
            ->with('recurringInvoice', $recurringInvoice)
            ->with('currencies', Currency::getList())
            ->with('taxRates', TaxRate::getList())
            ->with('customFields', CustomField::forTable('recurring_invoices')->get())
            ->with('returnUrl', $this->getReturnUrl())
            ->with('templates', InvoiceTemplates::lists())
            ->with('itemCount', count($recurringInvoice->recurringInvoiceItems))
            ->with('frequencies', Frequency::lists())
            ->with('groups', Group::getList());
    }

    public function update(RecurringInvoiceUpdateRequest $request, $id)
    {
        $input              = $request->except(['items', 'custom', 'apply_exchange_rate']);
        $input['next_date'] = DateFormatter::unformat($input['next_date']);
        $input['stop_date'] = DateFormatter::unformat($input['stop_date']);

        // Save the recurring invoice.
        $recurringInvoice = RecurringInvoice::find($id);
        $recurringInvoice->fill($input);
        $recurringInvoice->save();

        // Save the custom fields.
        $recurringInvoice->custom->update($request->input('custom', []));

        // Save the items.
        foreach ($request->input('items') as $item)
        {
            $item['apply_exchange_rate'] = request('apply_exchange_rate');

            if (!isset($item['id']) or (!$item['id']))
            {
                $saveItemAsLookup = $item['save_item_as_lookup'];
                unset($item['save_item_as_lookup']);

                RecurringInvoiceItem::create($item);

                if ($saveItemAsLookup)
                {
                    ItemLookup::create([
                        'name'          => $item['name'],
                        'description'   => $item['description'],
                        'price'         => $item['price'],
                        'tax_rate_id'   => $item['tax_rate_id'],
                        'tax_rate_2_id' => $item['tax_rate_2_id'],
                    ]);
                }
            }
            else
            {
                $recurringInvoiceItem = RecurringInvoiceItem::find($item['id']);
                $recurringInvoiceItem->fill($item);
                $recurringInvoiceItem->save();
            }
        }

        event(new RecurringInvoiceModified($recurringInvoice));
    }

    public function refreshEdit($id)
    {
        $recurringInvoice = RecurringInvoice::with(['items.amount.item.recurringInvoice.currency'])->find($id);

        return view('recurring_invoices._edit')
            ->with('recurringInvoice', $recurringInvoice)
            ->with('currencies', Currency::getList())
            ->with('taxRates', TaxRate::getList())
            ->with('customFields', CustomField::forTable('recurring_invoices')->get())
            ->with('returnUrl', $this->getReturnUrl())
            ->with('templates', InvoiceTemplates::lists())
            ->with('itemCount', count($recurringInvoice->recurringInvoiceItems))
            ->with('frequencies', Frequency::lists())
            ->with('groups', Group::getList());
    }

    public function refreshTotals()
    {
        return view('recurring_invoices._edit_totals')
            ->with('recurringInvoice', RecurringInvoice::with(['items.amount.item.recurringInvoice.currency'])->find(request('id')));
    }

    public function refreshTo()
    {
        return view('recurring_invoices._edit_to')
            ->with('recurringInvoice', RecurringInvoice::find(request('id')));
    }

    public function refreshFrom()
    {
        return view('recurring_invoices._edit_from')
            ->with('recurringInvoice', RecurringInvoice::find(request('id')));
    }

    public function updateClient()
    {
        RecurringInvoice::where('id', request('id'))->update(['client_id' => request('client_id')]);
    }

    public function updateCompanyProfile()
    {
        RecurringInvoice::where('id', request('id'))->update(['company_profile_id' => request('company_profile_id')]);
    }
}
