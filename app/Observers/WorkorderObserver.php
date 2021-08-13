<?php

namespace BT\Observers;


use BT\Modules\Currencies\Support\CurrencyConverterFactory;
use BT\Modules\CustomFields\Models\WorkorderCustom;
use BT\Modules\Groups\Models\Group;
use BT\Modules\Quotes\Models\Quote;
use BT\Modules\Workorders\Models\Workorder;
use BT\Modules\Workorders\Support\WorkorderCalculate;
use BT\Support\DateFormatter;
use BT\Support\Statuses\WorkorderStatuses;

class WorkorderObserver
{
    public function __construct(WorkorderCalculate $workorderCalculate)
    {
        $this->workorderCalculate = $workorderCalculate;
    }

    /**
     * Handle the workorder "created" event.
     *
     * @param \BT\Modules\Workorders\Models\Workorder $workorder
     * @return void
     */
    public function created(Workorder $workorder): void
    {
        // Create the empty workorder amount record
        $this->workorderCalculate->calculate($workorder);

        // Increment the next id
        Group::incrementNextId($workorder);

        // Create the custom workorder record.
        $workorder->custom()->save(new WorkorderCustom());
    }

    /**
     * Handle the workorder "creating" event.
     *
     * @param \BT\Modules\Workorders\Models\Workorder $workorder
     * @return void
     */
    public function creating(Workorder $workorder): void
    {
        if (!$workorder->client_id) {
            // This needs to throw an exception since this is required.
        }

        if (!$workorder->user_id) {
            $workorder->user_id = auth()->user()->id;
        }

        if (!$workorder->workorder_date) {
            $workorder->workorder_date = date('Y-m-d');
        }

        if (!$workorder->job_date) {
            $workorder->job_date = date('Y-m-d');
        }

        if (!$workorder->start_time) {
            $workorder->start_time = '08:00';
        }

        if (!$workorder->end_time) {
            $workorder->end_time = '09:00';
        }

        if (!$workorder->expires_at) {
            $workorder->expires_at = DateFormatter::incrementDateByDays($workorder->workorder_date->format('Y-m-d'), config('bt.workordersExpireAfter'));
        }

        if (!$workorder->company_profile_id) {
            $workorder->company_profile_id = config('bt.defaultCompanyProfile');
        }

        if (!$workorder->group_id) {
            $workorder->group_id = config('bt.workorderGroup');
        }

        if (!$workorder->number) {
            $workorder->number = Group::generateNumber($workorder->group_id);
        }

        if (!isset($workorder->terms)) {
            $workorder->terms = config('bt.workorderTerms');
        }

        if (!isset($workorder->footer)) {
            $workorder->footer = config('bt.workorderFooter');
        }

        if (!$workorder->workorder_status_id) {
            $workorder->workorder_status_id = WorkorderStatuses::getStatusId('draft');
        }

        if (!$workorder->currency_code) {
            $workorder->currency_code = $workorder->client->currency_code;
        }

        if (!$workorder->template) {
            $workorder->template = config('bt.workorderTemplate');
        }

        if ($workorder->currency_code == config('bt.baseCurrency')) {
            $workorder->exchange_rate = 1;
        } elseif (!$workorder->exchange_rate) {
            $currencyConverter = CurrencyConverterFactory::create();
            $workorder->exchange_rate = $currencyConverter->convert(config('bt.baseCurrency'), $workorder->currency_code);
        }

        $workorder->url_key = str_random(32);

    }


    /**
     * Handle the workorder "deleting" event.
     *
     * @param \BT\Modules\Workorders\Models\Workorder $workorder
     * @return void
     */
    public function deleting(Workorder $workorder): void
    {
        foreach ($workorder->activities as $activity) {
            ($workorder->isForceDeleting()) ? $activity->onlyTrashed()->forceDelete() : $activity->delete();
        }

        foreach ($workorder->attachments as $attachment) {
            ($workorder->isForceDeleting()) ? $attachment->onlyTrashed()->forceDelete() : $attachment->delete();
        }

        foreach ($workorder->mailQueue as $mailQueue) {
            ($workorder->isForceDeleting()) ? $mailQueue->onlyTrashed()->forceDelete() : $mailQueue->delete();
        }

        foreach ($workorder->notes as $note) {
            ($workorder->isForceDeleting()) ? $note->onlyTrashed()->forceDelete() : $note->delete();
        }

        // set invoice_id ref in quote, workorder and expense to 0, denoting deleted
        if ($workorder->quote() && $workorder->isForceDeleting()) $workorder->quote()->update(['workorder_id' => 0]);

        // todo this gets messy with soft deletes...
//        $group = Group::where('id', $workorder->group_id)
//            ->where('last_number', $workorder->number)
//            ->first();
//
//        if ($group)
//        {
//            $group->next_id = $group->next_id - 1;
//            $group->save();
//        }
    }

    /**
     * Handle the workorder "restoring" event.
     *
     * @param \BT\Modules\Workorders\Models\Workorder $workorder
     * @return void
     */
    public function restoring(Workorder $workorder): void
    {
        foreach ($workorder->activities as $activity) {
            $activity->onlyTrashed()->restore();
        }

        foreach ($workorder->attachments as $attachment) {
            $attachment->onlyTrashed()->restore();
        }

        foreach ($workorder->mailQueue as $mailQueue) {
            $mailQueue->onlyTrashed()->restore();
        }

        foreach ($workorder->notes as $note) {
            $note->onlyTrashed()->restore();
        }
    }
}
