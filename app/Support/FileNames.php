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

class FileNames
{
    public static function invoice($invoice)
    {
        return trans('bt.invoice') . '_' . str_replace('/', '-', $invoice->number) . '.pdf';
    }

    public static function quote($quote)
    {
        return trans('bt.quote') . '_' . str_replace('/', '-', $quote->number) . '.pdf';
    }

    public static function workorder($workorder)
    {
        return trans('bt.workorder') . '_' . str_replace('/', '-', $workorder->number) . '.pdf';
    }

    public static function purchaseorder($purchaseorder)
    {
        return trans('bt.purchaseorder') . '_' . str_replace('/', '-', $purchaseorder->number) . '.pdf';
    }

    public static function batchprint()
    {
        return trans('bt.batchprint') . '_' . 'batchprint' . '.pdf';
    }
}
