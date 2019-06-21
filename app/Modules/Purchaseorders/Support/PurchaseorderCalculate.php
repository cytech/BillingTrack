<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\Purchaseorders\Support;

use BT\Modules\Purchaseorders\Models\Purchaseorder;
use BT\Modules\Purchaseorders\Models\PurchaseorderAmount;
use BT\Modules\Purchaseorders\Models\PurchaseorderItem;
use BT\Modules\Purchaseorders\Models\PurchaseorderItemAmount;
//use BT\Modules\Payments\Models\Payment;
use BT\Support\Statuses\PurchaseorderStatuses;

class PurchaseorderCalculate
{
    public function calculate($purchaseorder)
    {
        $purchaseorderItems = PurchaseorderItem::select('purchaseorder_items.*',
            'tax_rates_1.percent AS tax_rate_1_percent',
            'tax_rates_2.percent AS tax_rate_2_percent',
            'tax_rates_2.is_compound AS tax_rate_2_is_compound',
            'tax_rates_1.calculate_vat AS tax_rate_1_calculate_vat')
            ->leftJoin('tax_rates AS tax_rates_1', 'purchaseorder_items.tax_rate_id', '=', 'tax_rates_1.id')
            ->leftJoin('tax_rates AS tax_rates_2', 'purchaseorder_items.tax_rate_2_id', '=', 'tax_rates_2.id')
            ->where('purchaseorder_id', $purchaseorder->id)
            ->get();

        //$totalPaid = Payment::where('purchaseorder_id', $purchaseorder->id)->sum('amount');
        if ($purchaseorder->status_text == 'paid'){
            $totalPaid = $purchaseorder->amount->total;
        }else{
            $totalPaid = 0;
        }

        $calculator = new PurchaseorderCalculator;
        $calculator->setId($purchaseorder->id);
        $calculator->setTotalPaid($totalPaid);
        $calculator->setDiscount($purchaseorder->discount);

        if ($purchaseorder->status_text == 'canceled')
        {
            $calculator->setIsCanceled(true);
        }

        foreach ($purchaseorderItems as $purchaseorderItem)
        {
            $taxRatePercent       = ($purchaseorderItem->tax_rate_id) ? $purchaseorderItem->tax_rate_1_percent : 0;
            $taxRate2Percent      = ($purchaseorderItem->tax_rate_2_id) ? $purchaseorderItem->tax_rate_2_percent : 0;
            $taxRate2IsCompound   = ($purchaseorderItem->tax_rate_2_is_compound) ? 1 : 0;
            $taxRate1CalculateVat = ($purchaseorderItem->tax_rate_1_calculate_vat) ? 1 : 0;

            $calculator->addItem($purchaseorderItem->id, $purchaseorderItem->quantity, $purchaseorderItem->cost, $taxRatePercent, $taxRate2Percent, $taxRate2IsCompound, $taxRate1CalculateVat);
        }

        $calculator->calculate();

        // Get the calculated values
        $calculatedItemAmounts = $calculator->getCalculatedItemAmounts();
        $calculatedAmount      = $calculator->getCalculatedAmount();

        // Update the item amount records.
        foreach ($calculatedItemAmounts as $calculatedItemAmount)
        {
            $purchaseorderItemAmount = PurchaseorderItemAmount::firstOrNew(['item_id' => $calculatedItemAmount['item_id']]);
            $purchaseorderItemAmount->fill($calculatedItemAmount);
            $purchaseorderItemAmount->save();
        }

        // Update the overall purchaseorder amount record.
        $purchaseorderAmount = PurchaseorderAmount::firstOrNew(['purchaseorder_id' => $purchaseorder->id]);
        $purchaseorderAmount->fill($calculatedAmount);
        $purchaseorderAmount->save();

        // Check to see if the purchaseorder should be marked as paid.
        if ($calculatedAmount['total'] > 0 and $calculatedAmount['balance'] <= 0 and $purchaseorder->status_text != 'canceled')
        {
            $purchaseorder->purchaseorder_status_id = PurchaseorderStatuses::getStatusId('paid');
            $purchaseorder->save();
        }

        // Check to see if the purchaseorder was marked as paid but should no longer be.
        if ($calculatedAmount['total'] > 0 and $calculatedAmount['balance'] > 0 and $purchaseorder->purchaseorder_status_id == PurchaseorderStatuses::getStatusId('paid'))
        {
            $purchaseorder->purchaseorder_status_id = PurchaseorderStatuses::getStatusId('sent');
            $purchaseorder->save();
        }
    }

    public function calculateAll()
    {
        foreach (Purchaseorder::get() as $purchaseorder)
        {
            $this->calculate($purchaseorder);
        }
    }
}
