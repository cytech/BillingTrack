<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Support;

class HTML
{
    public static function invoice($invoice)
    {
        app()->setLocale($invoice->client->language);

        config(['bt.baseCurrency' => $invoice->currency_code]);

        $template = str_replace('.blade.php', '', $invoice->template);

        if (view()->exists('invoice_templates.' . $template))
        {
            $template = 'invoice_templates.' . $template;
        }
        else
        {
            $template = 'templates.invoices.default';
        }

        return view($template)
            ->with('invoice', $invoice)
            ->with('logo', $invoice->companyProfile->logo())->render();
    }

    public static function quote($quote)
    {
        app()->setLocale($quote->client->language);

        config(['bt.baseCurrency' => $quote->currency_code]);

        $template = str_replace('.blade.php', '', $quote->template);

        if (view()->exists('quote_templates.' . $template))
        {
            $template = 'quote_templates.' . $template;
        }
        else
        {
            $template = 'templates.quotes.default';
        }

        return view($template)
            ->with('quote', $quote)
            ->with('logo', $quote->companyProfile->logo())->render();
    }

    public static function workorder($workorder)
    {
        app()->setLocale($workorder->client->language);

        config(['bt.baseCurrency' => $workorder->currency_code]);

        $template = str_replace('.blade.php', '', $workorder->template);

        if (view()->exists('workorder_templates.' . $template))
        {
            $template = 'workorder_templates.' . $template;
        }
        else //default fi templates
        {
            $template = 'templates.workorders.default';
        }

        return view($template)
            ->with('workorder', $workorder)
            ->with('logo', $workorder->companyProfile->logo())->render();
    }

    public static function purchaseorder($purchaseorder)
    {
        app()->setLocale($purchaseorder->vendor->language);

        config(['bt.baseCurrency' => $purchaseorder->currency_code]);

        $template = str_replace('.blade.php', '', $purchaseorder->template);

        if (view()->exists('purchaseorder_templates.' . $template))
        {
            $template = 'purchaseorder_templates.' . $template;
        }
        else
        {
            $template = 'templates.purchaseorders.default';
        }

        return view($template)
            ->with('purchaseorder', $purchaseorder)
            ->with('logo', $purchaseorder->companyProfile->logo())->render();
    }
}
