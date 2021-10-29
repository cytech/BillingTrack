<?php

namespace BT\Observers;

use BT\Modules\Currencies\Support\CurrencyConverterFactory;
use BT\Modules\CustomFields\Models\PurchaseorderCustom;
use BT\Modules\Expenses\Models\Expense;
use BT\Modules\Groups\Models\Group;
use BT\Modules\Purchaseorders\Models\Purchaseorder;
use BT\Modules\Purchaseorders\Support\PurchaseorderCalculate;
use BT\Modules\Quotes\Models\Quote;
use BT\Support\DateFormatter;
use BT\Support\Statuses\PurchaseorderStatuses;

class PurchaseorderObserver
{
    private $purchaseorderCalculate;

    public function __construct(PurchaseorderCalculate $purchaseorderCalculate)
    {
        $this->purchaseorderCalculate = $purchaseorderCalculate;
    }
    /**
     * Handle the purchaseorder "created" event.
     *
     * @param  \BT\Modules\Purchaseorders\Models\Purchaseorder  $purchaseorder
     * @return void
     */
    public function created(Purchaseorder $purchaseorder): void
    {
        // Create the empty purchaseorder amount record.
        $this->purchaseorderCalculate->calculate($purchaseorder);

        // Increment the next id.
        Group::incrementNextId($purchaseorder);

        // Create the custom purchaseorder record.
        $purchaseorder->custom()->save(new PurchaseorderCustom());
    }

    /**
     * Handle the purchaseorder "creating" event.
     *
     * @param  \BT\Modules\Purchaseorders\Models\Purchaseorder  $purchaseorder
     * @return void
     */
    public function creating(Purchaseorder $purchaseorder): void
    {
        if (!$purchaseorder->vendor_id)
        {
            // This needs to throw an exception since this is required.
        }

        if (!$purchaseorder->user_id)
        {
            $purchaseorder->user_id = auth()->user()->id;
        }

        if (!$purchaseorder->purchaseorder_date)
        {
            $purchaseorder->purchaseorder_date = date('Y-m-d');
        }

        if (!$purchaseorder->due_at)
        {
            $purchaseorder->due_at = DateFormatter::incrementDateByDays($purchaseorder->purchaseorder_date->format('Y-m-d'), $purchaseorder->vendor->vendor_terms);
        }

        if (!$purchaseorder->company_profile_id)
        {
            $purchaseorder->company_profile_id = config('bt.defaultCompanyProfile');
        }

        if (!$purchaseorder->group_id)
        {
            $purchaseorder->group_id = config('bt.purchaseorderGroup');
        }

        if (!$purchaseorder->number)
        {
            $purchaseorder->number = Group::generateNumber($purchaseorder->group_id);
        }

        if (!isset($purchaseorder->terms))
        {
            $purchaseorder->terms = config('bt.purchaseorderTerms');
        }

        if (!isset($purchaseorder->footer))
        {
            $purchaseorder->footer = config('bt.purchaseorderFooter');
        }

        if (!$purchaseorder->purchaseorder_status_id)
        {
            $purchaseorder->purchaseorder_status_id = PurchaseorderStatuses::getStatusId('draft');
        }

        if (!$purchaseorder->currency_code)
        {
            $purchaseorder->currency_code = $purchaseorder->vendor->currency_code;
        }

        if (!$purchaseorder->template)
        {
            $purchaseorder->template = $purchaseorder->companyProfile->purchaseorder_template;
        }

        if ($purchaseorder->currency_code == config('bt.baseCurrency'))
        {
            $purchaseorder->exchange_rate = 1;
        }
        elseif (!$purchaseorder->exchange_rate)
        {
            $currencyConverter      = CurrencyConverterFactory::create();
            $purchaseorder->exchange_rate = $currencyConverter->convert(config('bt.baseCurrency'), $purchaseorder->currency_code);
        }

        $purchaseorder->url_key = str_random(32);
    }

    /**
     * Handle the purchaseorder "deleting" event.
     *
     * @param  \BT\Modules\Purchaseorders\Models\Purchaseorder  $purchaseorder
     * @return void
     */
    public function deleting(Purchaseorder $purchaseorder): void
    {
        foreach ($purchaseorder->activities as $activity)
        {
            ($purchaseorder->isForceDeleting()) ? $activity->onlyTrashed()->forceDelete() : $activity->delete();
        }

        foreach ($purchaseorder->attachments as $attachment)
        {
            ($purchaseorder->isForceDeleting()) ? $attachment->onlyTrashed()->forceDelete() : $attachment->delete();
        }

        foreach ($purchaseorder->mailQueue as $mailQueue)
        {
            ($purchaseorder->isForceDeleting()) ? $mailQueue->onlyTrashed()->forceDelete() : $mailQueue->delete();
        }

        foreach ($purchaseorder->notes as $note)
        {
            ($purchaseorder->isForceDeleting()) ? $note->onlyTrashed()->forceDelete() : $note->delete();
        }

        // todo this gets messy with soft deletes...
//        $group = Group::where('id', $purchaseorder->group_id)
//            ->where('last_number', $purchaseorder->number)
//            ->first();
//
//        if ($group)
//        {
//            $group->next_id = $group->next_id - 1;
//            $group->save();
//        }
    }

    /**
     * Handle the purchaseorder "restoring" event.
     *
     * @param \BT\Modules\Purchaseorders\Models\Purchaseorder $purchaseorder
     * @return void
     */
    public function restoring(Purchaseorder $purchaseorder): void
    {
        foreach ($purchaseorder->activities as $activity) {
            $activity->onlyTrashed()->restore();
        }

        foreach ($purchaseorder->attachments as $attachment) {
            $attachment->onlyTrashed()->restore();
        }

        foreach ($purchaseorder->mailQueue as $mailQueue) {
            $mailQueue->onlyTrashed()->restore();
        }

        foreach ($purchaseorder->notes as $note) {
            $note->onlyTrashed()->restore();
        }
    }

}
