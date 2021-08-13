<?php

namespace BT\Observers;

use BT\Modules\Currencies\Support\CurrencyConverterFactory;
use BT\Modules\CustomFields\Models\InvoiceCustom;
use BT\Modules\Expenses\Models\Expense;
use BT\Modules\Groups\Models\Group;
use BT\Modules\Invoices\Models\Invoice;
use BT\Modules\Invoices\Support\InvoiceCalculate;
use BT\Modules\Quotes\Models\Quote;
use BT\Modules\Workorders\Models\Workorder;
use BT\Support\DateFormatter;
use BT\Support\Statuses\InvoiceStatuses;

class InvoiceObserver
{
    private $invoiceCalculate;

    public function __construct(InvoiceCalculate $invoiceCalculate)
    {
        $this->invoiceCalculate = $invoiceCalculate;
    }

    /**
     * Handle the invoice "created" event.
     *
     * @param \BT\Modules\Invoices\Models\Invoice $invoice
     * @return void
     */
    public function created(Invoice $invoice): void
    {
        // Create the empty invoice amount record.
        $this->invoiceCalculate->calculate($invoice);

        // Increment the next id.
        Group::incrementNextId($invoice);

        // Create the custom invoice record.
        $invoice->custom()->save(new InvoiceCustom());
    }

    /**
     * Handle the invoice "creating" event.
     *
     * @param \BT\Modules\Invoices\Models\Invoice $invoice
     * @return void
     */
    public function creating(Invoice $invoice): void
    {
        if (!$invoice->client_id) {
            // This needs to throw an exception since this is required.
        }

        if (!$invoice->user_id) {
            $invoice->user_id = auth()->user()->id;
        }

        if (!$invoice->invoice_date) {
            $invoice->invoice_date = date('Y-m-d');
        }

        if (!$invoice->due_at) {
            $invoice->due_at = DateFormatter::incrementDateByDays($invoice->invoice_date->format('Y-m-d'), $invoice->client->client_terms);
        }

        if (!$invoice->company_profile_id) {
            $invoice->company_profile_id = config('bt.defaultCompanyProfile');
        }

        if (!$invoice->group_id) {
            $invoice->group_id = config('bt.invoiceGroup');
        }

        if (!$invoice->number) {
            $invoice->number = Group::generateNumber($invoice->group_id);
        }

        if (!isset($invoice->terms)) {
            $invoice->terms = config('bt.invoiceTerms');
        }

        if (!isset($invoice->footer)) {
            $invoice->footer = config('bt.invoiceFooter');
        }

        if (!$invoice->invoice_status_id) {
            $invoice->invoice_status_id = InvoiceStatuses::getStatusId('draft');
        }

        if (!$invoice->currency_code) {
            $invoice->currency_code = $invoice->client->currency_code;
        }

        if (!$invoice->template) {
            $invoice->template = $invoice->companyProfile->invoice_template;
        }

        if ($invoice->currency_code == config('bt.baseCurrency')) {
            $invoice->exchange_rate = 1;
        } elseif (!$invoice->exchange_rate) {
            $currencyConverter = CurrencyConverterFactory::create();
            $invoice->exchange_rate = $currencyConverter->convert(config('bt.baseCurrency'), $invoice->currency_code);
        }

        $invoice->url_key = str_random(32);
    }

    /**
     * Handle the invoice "deleting" event.
     *
     * @param \BT\Modules\Invoices\Models\Invoice $invoice
     * @return void
     */
    public function deleting(Invoice $invoice): void
    {
        foreach ($invoice->activities as $activity) {
            ($invoice->isForceDeleting()) ? $activity->onlyTrashed()->forceDelete() : $activity->delete();
        }

        foreach ($invoice->attachments as $attachment) {
            ($invoice->isForceDeleting()) ? $attachment->onlyTrashed()->forceDelete() : $attachment->delete();
        }

        foreach ($invoice->mailQueue as $mailQueue) {
            ($invoice->isForceDeleting()) ? $mailQueue->onlyTrashed()->forceDelete() : $mailQueue->delete();
        }

        foreach ($invoice->notes as $note) {
            ($invoice->isForceDeleting()) ? $note->onlyTrashed()->forceDelete() : $note->delete();
        }

        // set invoice_id ref in quote, workorder and expense to 0, denoting deleted
        if ($invoice->quote() && $invoice->isForceDeleting()) $invoice->quote()->update(['invoice_id' => 0]);

        if ($invoice->workorder() && $invoice->isForceDeleting()) $invoice->workorder()->update(['invoice_id' => 0]);

        if ($invoice->expense() && $invoice->isForceDeleting()) $invoice->expense()->update(['invoice_id' => 0]);

        // todo this gets messy with soft deletes...
//        $group = Group::where('id', $invoice->group_id)
//            ->where('last_number', $invoice->number)
//            ->first();
//
//        if ($group) {
//            $group->next_id = $group->next_id - 1;
//            $group->save();
//        }
    }

    /**
     * Handle the invoice "restoring" event.
     *
     * @param \BT\Modules\Invoices\Models\Invoice $invoice
     * @return void
     */
    public function restoring(Invoice $invoice): void
    {
        foreach ($invoice->activities as $activity) {
            $activity->onlyTrashed()->restore();
        }

        foreach ($invoice->attachments as $attachment) {
            $attachment->onlyTrashed()->restore();
        }

        foreach ($invoice->mailQueue as $mailQueue) {
            $mailQueue->onlyTrashed()->restore();
        }

        foreach ($invoice->notes as $note) {
            $note->onlyTrashed()->restore();
        }
    }


}
