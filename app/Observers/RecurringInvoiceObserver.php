<?php

namespace BT\Observers;

use BT\Modules\Currencies\Support\CurrencyConverterFactory;
use BT\Modules\CustomFields\Models\RecurringInvoiceCustom;
use BT\Modules\RecurringInvoices\Models\RecurringInvoice;
use BT\Modules\RecurringInvoices\Support\RecurringInvoiceCalculate;

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
     * @param  \BT\Modules\RecurringInvoices\Models\RecurringInvoice  $recurringInvoice
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
     * @param  \BT\Modules\RecurringInvoices\Models\RecurringInvoice  $recurringInvoice
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
            $recurringInvoice->company_profile_id = config('bt.defaultCompanyProfile');
        }

        if (!$recurringInvoice->group_id)
        {
            $recurringInvoice->group_id = config('bt.invoiceGroup');
        }

        if (!isset($recurringInvoice->terms))
        {
            $recurringInvoice->terms = config('bt.invoiceTerms');
        }

        if (!isset($recurringInvoice->footer))
        {
            $recurringInvoice->footer = config('bt.invoiceFooter');
        }

        if (!$recurringInvoice->template)
        {
            $recurringInvoice->template = $recurringInvoice->companyProfile->invoice_template;
        }

        if (!$recurringInvoice->currency_code)
        {
            $recurringInvoice->currency_code = $recurringInvoice->client->currency_code;
        }

        if ($recurringInvoice->currency_code == config('bt.baseCurrency'))
        {
            $recurringInvoice->exchange_rate = 1;
        }
        elseif (!$recurringInvoice->exchange_rate)
        {
            $currencyConverter               = CurrencyConverterFactory::create();
            $recurringInvoice->exchange_rate = $currencyConverter->convert(config('bt.baseCurrency'), $recurringInvoice->currency_code);
        }

    }

    /**
     * Handle the recurring invoice "deleting" event.
     *
     * @param  \BT\Modules\RecurringInvoices\Models\RecurringInvoice  $recurringInvoice
     * @return void
     */
    public function deleting(RecurringInvoice $recurringInvoice): void
    {
        foreach ($recurringInvoice->activities as $activity)
        {
            ($recurringInvoice->isForceDeleting()) ? $activity->onlyTrashed()->forceDelete() : $activity->delete();
        }
    }

    /**
     * Handle the recurring invoice "restoring" event.
     *
     * @param  \BT\Modules\RecurringInvoices\Models\RecurringInvoice  $recurringInvoice
     * @return void
     */
    public function restoring(RecurringInvoice $recurringInvoice): void
    {
        foreach ($recurringInvoice->activities as $activity)
        {
            $activity->onlyTrashed()->restore();
        }
    }
}
