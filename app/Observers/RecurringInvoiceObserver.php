<?php

namespace FI\Observers;

use FI\Modules\Currencies\Support\CurrencyConverterFactory;
use FI\Modules\CustomFields\Models\RecurringInvoiceCustom;
use FI\Modules\RecurringInvoices\Models\RecurringInvoice;
use FI\Modules\RecurringInvoices\Support\RecurringInvoiceCalculate;

class RecurringInvoiceObserver
{
    private $recurringInvoiceCalculate;

    public function __construct(RecurringInvoiceCalculate $recurringInvoiceCalculate)
    {
        $this->recurringInvoiceCalculate = $recurringInvoiceCalculate;
    }

    /**
     * Handle the recurring invoice "created" event.
     *
     * @param  \FI\Modules\RecurringInvoices\Models\RecurringInvoice  $recurringInvoice
     * @return void
     */
    public function created(RecurringInvoice $recurringInvoice): void
    {
        // Create the empty invoice amount record.
        $this->recurringInvoiceCalculate->calculate($recurringInvoice->id);

        // Create the custom record.
        $recurringInvoice->custom()->save(new RecurringInvoiceCustom());
    }

    /**
     * Handle the recurring invoice "creating" event.
     *
     * @param  \FI\Modules\RecurringInvoices\Models\RecurringInvoice  $recurringInvoice
     * @return void
     */
    public function creating(RecurringInvoice $recurringInvoice): void
    {
        if (!$recurringInvoice->user_id)
        {
            $recurringInvoice->user_id = auth()->user()->id;
        }

        if (!$recurringInvoice->company_profile_id)
        {
            $recurringInvoice->company_profile_id = config('fi.defaultCompanyProfile');
        }

        if (!$recurringInvoice->group_id)
        {
            $recurringInvoice->group_id = config('fi.invoiceGroup');
        }

        if (!isset($recurringInvoice->terms))
        {
            $recurringInvoice->terms = config('fi.invoiceTerms');
        }

        if (!isset($recurringInvoice->footer))
        {
            $recurringInvoice->footer = config('fi.invoiceFooter');
        }

        if (!$recurringInvoice->template)
        {
            $recurringInvoice->template = $recurringInvoice->companyProfile->invoice_template;
        }

        if (!$recurringInvoice->currency_code)
        {
            $recurringInvoice->currency_code = $recurringInvoice->client->currency_code;
        }

        if ($recurringInvoice->currency_code == config('fi.baseCurrency'))
        {
            $recurringInvoice->exchange_rate = 1;
        }
        elseif (!$recurringInvoice->exchange_rate)
        {
            $currencyConverter               = CurrencyConverterFactory::create();
            $recurringInvoice->exchange_rate = $currencyConverter->convert(config('fi.baseCurrency'), $recurringInvoice->currency_code);
        }

    }

    /**
     * Handle the recurring invoice "deleted" event.
     *
     * @param  \FI\Modules\RecurringInvoices\Models\RecurringInvoice  $recurringInvoice
     * @return void
     */
    public function deleteing(RecurringInvoice $recurringInvoice): void
    {
        foreach ($recurringInvoice->activities as $activity)
        {
            ($recurringInvoice->isForceDeleting()) ? $activity->onlyTrashed()->forceDelete() : $activity->delete();
        }
    }
}
