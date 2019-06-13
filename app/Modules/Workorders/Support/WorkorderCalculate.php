<?php

/**
 * This file is part of BillingTrack.
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


namespace BT\Modules\Workorders\Support;

use BT\Modules\Workorders\Models\Workorder;
use BT\Modules\Workorders\Models\WorkorderAmount;
use BT\Modules\Workorders\Models\WorkorderItem;
use BT\Modules\Workorders\Models\WorkorderItemAmount;

class WorkorderCalculate
{
    public function calculate($workorder)
    {
        $workorderItems = WorkorderItem::select('workorder_items.*',
            'tax_rates_1.percent AS tax_rate_1_percent',
            'tax_rates_2.percent AS tax_rate_2_percent',
            'tax_rates_2.is_compound AS tax_rate_2_is_compound',
	        'tax_rates_1.calculate_vat AS tax_rate_1_calculate_vat')
            ->leftJoin('tax_rates AS tax_rates_1', 'workorder_items.tax_rate_id', '=', 'tax_rates_1.id')
            ->leftJoin('tax_rates AS tax_rates_2', 'workorder_items.tax_rate_2_id', '=', 'tax_rates_2.id')
            ->where('workorder_id', $workorder->id)
            ->get();

        $calculator = new WorkorderCalculator;
        $calculator->setId($workorder->id);
        $calculator->setDiscount($workorder->discount);

        foreach ($workorderItems as $workorderItem)
        {
            $taxRatePercent     = ($workorderItem->tax_rate_id) ? $workorderItem->tax_rate_1_percent : 0;
            $taxRate2Percent    = ($workorderItem->tax_rate_2_id) ? $workorderItem->tax_rate_2_percent : 0;
            $taxRate2IsCompound = ($workorderItem->tax_rate_2_is_compound) ? 1 : 0;
	        $taxRate1CalculateVat = ($workorderItem->tax_rate_1_calculate_vat) ? 1 : 0;

            $calculator->addItem($workorderItem->id, $workorderItem->quantity, $workorderItem->price, $taxRatePercent, $taxRate2Percent, $taxRate2IsCompound, $taxRate1CalculateVat);
        }

        $calculator->calculate();

        // Get the calculated values
        $calculatedItemAmounts = $calculator->getCalculatedItemAmounts();
        $calculatedAmount      = $calculator->getCalculatedAmount();

        // Update the item amount records
        foreach ($calculatedItemAmounts as $calculatedItemAmount)
        {
            $workorderItemAmount = WorkorderItemAmount::firstOrNew(['item_id' => $calculatedItemAmount['item_id']]);
            $workorderItemAmount->fill($calculatedItemAmount);
            $workorderItemAmount->save();
        }

        // Update the overall workorder amount record
        $workorderAmount = WorkorderAmount::firstOrNew(['workorder_id' => $workorder->id]);
        $workorderAmount->fill($calculatedAmount);
        $workorderAmount->save();
    }

    public function calculateAll()
    {

        foreach (Workorder::get() as $workorder)
        {
            $this->calculate($workorder);
        }
    }
}
