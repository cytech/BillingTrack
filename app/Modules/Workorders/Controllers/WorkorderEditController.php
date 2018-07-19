<?php

/**
 * This file is part of Workorders Addon for FusionInvoice.
 * (c) Cytech <cytech@cytech-eng.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
 
namespace Addons\Workorders\Controllers;

use FI\Http\Controllers\Controller;
use FI\Modules\Currencies\Models\Currency;
use FI\Modules\CustomFields\Models\CustomField;
use FI\Modules\ItemLookups\Models\ItemLookup;
use Addons\Workorders\Models\Workorder;
use Addons\Workorders\Models\WorkorderItem;
use Addons\Workorders\Support\WorkorderTemplates;
use Addons\Workorders\Requests\WorkorderUpdateRequest;
use FI\Modules\TaxRates\Models\TaxRate;
use Addons\Workorders\Support\DateFormatter;
use FI\Support\NumberFormatter;
use FI\Support\Statuses\QuoteStatuses;
use FI\Traits\ReturnUrl;
use mysqli;

class WorkorderEditController extends Controller
{
    use ReturnUrl;

    public function edit($id)
    {
        $workorder = Workorder::with(['items.amount.item.workorder.currency'])->find($id);

        return view('Workorders::workorders.edit')
            ->with('workorder', $workorder)
            ->with('statuses', QuoteStatuses::lists())
            ->with('currencies', Currency::getList())
            ->with('taxRates', TaxRate::getList())
            ->with('customFields', CustomField::forTable('workorders')->get())
            ->with('returnUrl', $this->getReturnUrl())
            ->with('templates', WorkorderTemplates::lists())
            ->with('itemCount', count($workorder->workorderItems));
    }

    public function update(WorkorderUpdateRequest $request, $id)
    {
        // Unformat the workorder dates.
        $input = request()->except(['items', 'custom', 'apply_exchange_rate']);
        $input['workorder_date'] = DateFormatter::unformat($input['workorder_date']);
        $input['expires_at'] = DateFormatter::unformat($input['expires_at']);
        $input['job_date'] = DateFormatter::unformat($input['job_date']);

        // Save the workorder.
        $workorder = Workorder::find($id);
        $workorder->fill($input);
        $workorder->save();

        // Save the custom fields.
            $workorder->custom->update($request->input('custom', []));

        // Save the items.
        foreach ($request->input('items') as $item)
        {
            $item['apply_exchange_rate'] = $request->input('apply_exchange_rate');

            if (!isset($item['id']) or (!$item['id']))
            {
                $saveItemAsLookup = $item['save_item_as_lookup'];
                unset($item['save_item_as_lookup']);

                WorkorderItem::create($item);

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
                $workorderItem = WorkorderItem::find($item['id']);
                $workorderItem->fill($item);
                $workorderItem->save();
            }
        }

        //legacy/external calendar
        if (config('workorder_settings.enableLegacyCalendar') == 1) {
			//hardcode dbconf.php and cal2ical requirement
			if(file_exists('custom/addons/Workorders/dbconf.php')) {
				require_once( "dbconf.php" );
				$mysqlical = new mysqli( $host, $user, $pass, $caldbase );
				$filename  = config( 'workorder_settings.legacyCalendarScript' );
				if ( $file = file_get_contents( $filename ) ) {
					foreach ( explode( ";", $file ) as $query ) {
						$query = trim( $query );
						if ( ! empty( $query ) && $query != ";" ) {
							mysqli_query( $mysqlical, $query );
						}
					}
				}
				mysqli_close( $mysqlical );
				include 'cal2ical.php';
			}
        }

        return response()->json(['success' => true], 200);
    }

    public function refreshEdit($id)
    {
        $workorder = Workorder::with(['items.amount.item.workorder.currency'])->find($id);

        return view('Workorders::workorders.partials._edit')
            ->with('workorder', $workorder)
            ->with('statuses', QuoteStatuses::lists())
            ->with('currencies', Currency::getList())
            ->with('taxRates', TaxRate::getList())
            ->with('customFields', CustomField::forTable('workorders')->get())
            ->with('returnUrl', $this->getReturnUrl())
            ->with('templates', WorkorderTemplates::lists())
            ->with('itemCount', count($workorder->workorderItems));
    }

    public function refreshTotals()
    {
        return view('Workorders::workorders.partials._edit_totals')
            ->with('workorder', Workorder::with(['items.amount.item.workorder.currency'])->find(request('id')));
    }

    public function refreshTo()
    {
        return view('Workorders::workorders.partials._edit_to')
            ->with('workorder', Workorder::find(request('id')));
    }

    public function refreshFrom()
    {
        return view('Workorders::workorders.partials._edit_from')
            ->with('workorder', Workorder::find(request('id')));
    }

    public function updateClient()
    {
        Workorder::where('id', request('id'))->update(['client_id' => request('client_id')]);
    }

    public function updateCompanyProfile()
    {
        Workorder::where('id', request('id'))->update(['company_profile_id' => request('company_profile_id')]);
    }
}