<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\Reports\Reports;

use BT\Modules\Clients\Models\Client;
use BT\Modules\CompanyProfiles\Models\CompanyProfile;
use BT\Support\CurrencyFormatter;
use BT\Support\DateFormatter;

class ClientStatementReport
{
    public function getResults($clientName, $fromDate, $toDate, $companyProfileId = null)
    {
        $results = [
            'client_name' => '',
            'client_address' => '',
            'client_city' => '',
            'client_state' => '',
            'client_zip' => '',
            'client_phone' => '',
            'from_date'   => '',
            'to_date'     => '',
            'subtotal'    => 0,
            'discount'    => 0,
            'tax'         => 0,
            'total'       => 0,
            'paid'        => 0,
            'balance'     => 0,
            'records'     => [],
        ];

        $client = Client::where('unique_name', $clientName)->first();

        $invoices = $client->invoices()
            ->with('items', 'client.currency', 'amount.invoice.currency')
            ->notCanceled()
            ->where('invoice_date', '>=', $fromDate)
            ->where('invoice_date', '<=', $toDate)
            ->orderBy('invoice_date');

        if ($companyProfileId)
        {
            $companyProfile = CompanyProfile::where('id', $companyProfileId)->first();
            $results['companyProfile_company'] = $companyProfile->company;
            $results['companyProfile_address'] = $companyProfile->address;
            $results['companyProfile_city'] = $companyProfile->city;
            $results['companyProfile_state'] = $companyProfile->state;
            $results['companyProfile_zip'] = $companyProfile->zip;
            $results['companyProfile_phone'] = $companyProfile->phone;

            $invoices->where('company_profile_id', $companyProfileId);
        }
        else{
            $results['companyProfile_company'] = trans('bt.all_billing');
            $results['companyProfile_address'] = '';
            $results['companyProfile_city'] = '';
            $results['companyProfile_state'] = '';
            $results['companyProfile_zip'] = '';
            $results['companyProfile_phone'] = '';
        }

        $invoices = $invoices->get();

        foreach ($invoices as $invoice)
        {
            $results['records'][] = [
                'formatted_invoice_date' => $invoice->formatted_invoice_date,
                'number'                 => $invoice->number,
                'summary'                => $invoice->summary,
                'subtotal'               => $invoice->amount->subtotal,
                'discount'               => $invoice->amount->discount,
                'tax'                    => $invoice->amount->tax,
                'total'                  => $invoice->amount->total,
                'paid'                   => $invoice->amount->paid,
                'balance'                => $invoice->amount->balance,
                'formatted_subtotal'     => $invoice->amount->formatted_subtotal,
                'formatted_discount'     => $invoice->amount->formatted_discount,
                'formatted_tax'          => $invoice->amount->formatted_tax,
                'formatted_total'        => $invoice->amount->formatted_total,
                'formatted_paid'         => $invoice->amount->formatted_paid,
                'formatted_balance'      => $invoice->amount->formatted_balance,
            ];

            $results['subtotal'] += $invoice->amount->subtotal;
            $results['discount'] += $invoice->amount->discount;
            $results['tax']      += $invoice->amount->tax;
            $results['total']    += $invoice->amount->total;
            $results['paid']     += $invoice->amount->paid;
            $results['balance']  += $invoice->amount->balance;
        }

        $currency = $client->currency;

        $results['client_name'] = $client->name;
        $results['client_address'] = $client->address;
        $results['client_city'] = $client->city;
        $results['client_state'] = $client->state;
        $results['client_zip'] = $client->zip;
        $results['client_phone'] = $client->phone;
        $results['from_date']   = DateFormatter::format($fromDate);
        $results['to_date']     = DateFormatter::format($toDate);
        $results['subtotal']    = CurrencyFormatter::format($results['subtotal'], $currency);
        $results['discount']    = CurrencyFormatter::format($results['discount'], $currency);
        $results['tax']         = CurrencyFormatter::format($results['tax'], $currency);
        $results['total']       = CurrencyFormatter::format($results['total'], $currency);
        $results['paid']        = CurrencyFormatter::format($results['paid'], $currency);
        $results['balance']     = CurrencyFormatter::format($results['balance'], $currency);

        return $results;
    }
}
