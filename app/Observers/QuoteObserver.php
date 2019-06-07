<?php

namespace FI\Observers;

use FI\Modules\Currencies\Support\CurrencyConverterFactory;
use FI\Modules\CustomFields\Models\QuoteCustom;
use FI\Modules\Groups\Models\Group;
use FI\Modules\Quotes\Models\Quote;
use FI\Modules\Quotes\Support\QuoteCalculate;
use FI\Support\DateFormatter;
use FI\Support\Statuses\QuoteStatuses;

class QuoteObserver
{
    public function __construct(QuoteCalculate $quoteCalculate)
    {
        $this->quoteCalculate = $quoteCalculate;
    }

    /**
     * Handle the quote "created" event.
     *
     * @param  \FI\Modules\Quotes\Models\Quote  $quote
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
     * @param  \FI\Modules\Quotes\Models\Quote  $quote
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
            $quote->expires_at = DateFormatter::incrementDateByDays($quote->quote_date->format('Y-m-d'), config('fi.quotesExpireAfter'));
        }

        if (!$quote->company_profile_id)
        {
            $quote->company_profile_id = config('fi.defaultCompanyProfile');
        }

        if (!$quote->group_id)
        {
            $quote->group_id = config('fi.quoteGroup');
        }

        if (!$quote->number)
        {
            $quote->number = Group::generateNumber($quote->group_id);
        }

        if (!isset($quote->terms))
        {
            $quote->terms = config('fi.quoteTerms');
        }

        if (!isset($quote->footer))
        {
            $quote->footer = config('fi.quoteFooter');
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

        if ($quote->currency_code == config('fi.baseCurrency'))
        {
            $quote->exchange_rate = 1;
        }
        elseif (!$quote->exchange_rate)
        {
            $currencyConverter    = CurrencyConverterFactory::create();
            $quote->exchange_rate = $currencyConverter->convert(config('fi.baseCurrency'), $quote->currency_code);
        }

        $quote->url_key = str_random(32);

    }

    /**
     * Handle the quote "deleted" event.
     *
     * @param  \FI\Modules\Quotes\Models\Quote  $quote
     * @return void
     */
    public function deleteing(Quote $quote): void
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

        $group = Group::where('id', $quote->group_id)
            ->where('last_number', $quote->number)
            ->first();

        if ($group)
        {
            $group->next_id = $group->next_id - 1;
            $group->save();
        }
    }

}
