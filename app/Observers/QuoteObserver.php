<?php

namespace BT\Observers;

use BT\Modules\Currencies\Support\CurrencyConverterFactory;
use BT\Modules\CustomFields\Models\QuoteCustom;
use BT\Modules\Groups\Models\Group;
use BT\Modules\Quotes\Models\Quote;
use BT\Modules\Quotes\Support\QuoteCalculate;
use BT\Support\DateFormatter;
use BT\Support\Statuses\QuoteStatuses;

class QuoteObserver
{
    public function __construct(QuoteCalculate $quoteCalculate)
    {
        $this->quoteCalculate = $quoteCalculate;
    }

    /**
     * Handle the quote "created" event.
     *
     * @param  \BT\Modules\Quotes\Models\Quote  $quote
     * @return void
     */
    public function created(Quote $quote): void
    {
        // Create the empty quote amount record
        $this->quoteCalculate->calculate($quote);

        // Increment the next id
        Group::incrementNextId($quote);

        // Create the custom quote record.
        $quote->custom()->save(new QuoteCustom());
    }

    /**
     * Handle the quote "created" event.
     *
     * @param  \BT\Modules\Quotes\Models\Quote  $quote
     * @return void
     */
    public function creating(Quote $quote): void
    {
        if (!$quote->client_id)
        {
            // This needs to throw an exception since this is required.
        }

        if (!$quote->user_id)
        {
            $quote->user_id = auth()->user()->id;
        }

        if (!$quote->quote_date)
        {
            $quote->quote_date = date('Y-m-d');
        }

        if (!$quote->expires_at)
        {
            $quote->expires_at = DateFormatter::incrementDateByDays($quote->quote_date->format('Y-m-d'), config('bt.quotesExpireAfter'));
        }

        if (!$quote->company_profile_id)
        {
            $quote->company_profile_id = config('bt.defaultCompanyProfile');
        }

        if (!$quote->group_id)
        {
            $quote->group_id = config('bt.quoteGroup');
        }

        if (!$quote->number)
        {
            $quote->number = Group::generateNumber($quote->group_id);
        }

        if (!isset($quote->terms))
        {
            $quote->terms = config('bt.quoteTerms');
        }

        if (!isset($quote->footer))
        {
            $quote->footer = config('bt.quoteFooter');
        }

        if (!$quote->quote_status_id)
        {
            $quote->quote_status_id = QuoteStatuses::getStatusId('draft');
        }

        if (!$quote->currency_code)
        {
            $quote->currency_code = $quote->client->currency_code;
        }

        if (!$quote->template)
        {
            $quote->template = $quote->companyProfile->quote_template;
        }

        if ($quote->currency_code == config('bt.baseCurrency'))
        {
            $quote->exchange_rate = 1;
        }
        elseif (!$quote->exchange_rate)
        {
            $currencyConverter    = CurrencyConverterFactory::create();
            $quote->exchange_rate = $currencyConverter->convert(config('bt.baseCurrency'), $quote->currency_code);
        }

        $quote->url_key = str_random(32);

    }

    /**
     * Handle the quote "deleting" event.
     *
     * @param  \BT\Modules\Quotes\Models\Quote  $quote
     * @return void
     */
    public function deleting(Quote $quote): void
    {
        foreach ($quote->activities as $activity) {
            ($quote->isForceDeleting()) ? $activity->onlyTrashed()->forceDelete() : $activity->delete();
        }

        foreach ($quote->attachments as $attachment){
            ($quote->isForceDeleting()) ? $attachment->onlyTrashed()->forceDelete() : $attachment->delete();
        }

        foreach ($quote->mailQueue as $mailQueue){
            ($quote->isForceDeleting()) ? $mailQueue->onlyTrashed()->forceDelete() : $mailQueue->delete();
        }

        foreach ($quote->notes as $note){
            ($quote->isForceDeleting()) ? $note->onlyTrashed()->forceDelete() : $note->delete();
        }

        // todo this gets messy with soft deletes...
//        $group = Group::where('id', $quote->group_id)
//            ->where('last_number', $quote->number)
//            ->first();
//
//        if ($group)
//        {
//            $group->next_id = $group->next_id - 1;
//            $group->save();
//        }
    }

    /**
     * Handle the quote "restoring" event.
     *
     * @param \BT\Modules\Quotes\Models\Quote $quote
     * @return void
     */
    public function restoring(Quote $quote): void
    {
        foreach ($quote->activities as $activity) {
            $activity->onlyTrashed()->restore();
        }

        foreach ($quote->attachments as $attachment) {
            $attachment->onlyTrashed()->restore();
        }

        foreach ($quote->mailQueue as $mailQueue) {
            $mailQueue->onlyTrashed()->restore();
        }

        foreach ($quote->notes as $note) {
            $note->onlyTrashed()->restore();
        }
    }

}
