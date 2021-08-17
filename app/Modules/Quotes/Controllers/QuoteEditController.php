<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\Quotes\Controllers;

use BT\Events\QuoteModified;
use BT\Http\Controllers\Controller;
use BT\Modules\Currencies\Models\Currency;
use BT\Modules\CustomFields\Models\CustomField;
use BT\Modules\ItemLookups\Models\ItemLookup;
use BT\Modules\Quotes\Models\Quote;
use BT\Modules\Quotes\Models\QuoteItem;
use BT\Modules\Quotes\Support\QuoteTemplates;
use BT\Modules\Quotes\Requests\QuoteUpdateRequest;
use BT\Modules\TaxRates\Models\TaxRate;
use BT\Support\DateFormatter;
use BT\Support\Statuses\QuoteStatuses;
use BT\Traits\ReturnUrl;

class QuoteEditController extends Controller
{
    use ReturnUrl;

    public function edit($id)
    {
        $quote = Quote::with(['items.amount.item.quote.currency'])->find($id);

        return view('quotes.edit')
            ->with('quote', $quote)
            ->with('statuses', QuoteStatuses::lists())
            ->with('currencies', Currency::getList())
            ->with('taxRates', TaxRate::getList())
            ->with('customFields', CustomField::forTable('quotes')->get())
            ->with('returnUrl', $this->getReturnUrl())
            ->with('templates', QuoteTemplates::lists())
            ->with('itemCount', count($quote->quoteItems));
    }

    public function update(QuoteUpdateRequest $request, $id)
    {
        // Unformat the quote dates.
        $input               = $request->except(['items', 'custom', 'apply_exchange_rate']);
        $input['quote_date'] = DateFormatter::unformat($input['quote_date']);
        $input['expires_at'] = DateFormatter::unformat($input['expires_at']);

        // Save the quote.
        $quote = Quote::find($id);
        $quote->fill($input);
        $quote->save();

        // Save the custom fields.
            $quote->custom->update($request->input('custom', []));

        // Save the items.
        foreach ($request->input('items') as $item)
        {
            $item['apply_exchange_rate'] = $request->input('apply_exchange_rate');

            if (!isset($item['id']) or (!$item['id']))
            {
                $saveItemAsLookup = $item['save_item_as_lookup'];
                unset($item['save_item_as_lookup']);

                QuoteItem::create($item);

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
                $quoteItem = QuoteItem::find($item['id']);
                $quoteItem->fill($item);
                $quoteItem->save();
            }
        }

        event(new QuoteModified($quote));

        return response()->json(['success' => true], 200);
    }

    public function refreshEdit($id)
    {
        $quote = Quote::with(['items.amount.item.quote.currency'])->find($id);

        return view('quotes._edit')
            ->with('quote', $quote)
            ->with('statuses', QuoteStatuses::lists())
            ->with('currencies', Currency::getList())
            ->with('taxRates', TaxRate::getList())
            ->with('customFields', CustomField::forTable('quotes')->get())
            ->with('returnUrl', $this->getReturnUrl())
            ->with('templates', QuoteTemplates::lists())
            ->with('itemCount', count($quote->quoteItems));
    }

    public function refreshTotals()
    {
        return view('quotes._edit_totals')
            ->with('quote', Quote::with(['items.amount.item.quote.currency'])->find(request('id')));
    }

    public function refreshTo()
    {
        return view('quotes._edit_to')
            ->with('quote', Quote::find(request('id')));
    }

    public function refreshFrom()
    {
        return view('quotes._edit_from')
            ->with('quote', Quote::find(request('id')));
    }

    public function updateClient()
    {
        Quote::where('id', request('id'))->update(['client_id' => request('client_id')]);
    }

    public function updateCompanyProfile()
    {
        Quote::where('id', request('id'))->update(['company_profile_id' => request('company_profile_id')]);
    }
}
