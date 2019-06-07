<?php

namespace FI\Providers;

use FI\Modules\Attachments\Models\Attachment;
use FI\Modules\CompanyProfiles\Models\CompanyProfile;
use FI\Modules\Expenses\Models\Expense;
use FI\Modules\Invoices\Models\Invoice;
use FI\Modules\Invoices\Models\InvoiceItem;
use FI\Modules\Notes\Models\Note;
use FI\Modules\Payments\Models\Payment;
use FI\Modules\Quotes\Models\Quote;
use FI\Modules\Quotes\Models\QuoteItem;
use FI\Modules\RecurringInvoices\Models\RecurringInvoice;
use FI\Modules\RecurringInvoices\Models\RecurringInvoiceItem;
use FI\Modules\Settings\Models\Setting;
use FI\Modules\TimeTracking\Models\TimeTrackingProject;
use FI\Modules\TimeTracking\Models\TimeTrackingTask;
use FI\Modules\Users\Models\User;
use FI\Modules\Workorders\Models\Workorder;
use FI\Modules\Workorders\Models\WorkorderItem;
use FI\Observers\AttachmentObserver;
use FI\Observers\ClientObserver;
use FI\Modules\Clients\Models\Client;
use FI\Observers\CompanyProfileObserver;
use FI\Observers\ExpenseObserver;
use FI\Observers\InvoiceItemObserver;
use FI\Observers\InvoiceObserver;
use FI\Observers\NoteObserver;
use FI\Observers\PaymentObserver;
use FI\Observers\QuoteItemObserver;
use FI\Observers\QuoteObserver;
use FI\Observers\RecurringInvoiceItemObserver;
use FI\Observers\RecurringInvoiceObserver;
use FI\Observers\SettingObserver;
use FI\Observers\TimeTrackingProjectObserver;
use FI\Observers\TimeTrackingTaskObserver;
use FI\Observers\UserObserver;
use FI\Observers\WorkorderItemObserver;
use FI\Observers\WorkorderObserver;
use Illuminate\Support\ServiceProvider;

class ObserverServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Client::observe(ClientObserver::class);
        Attachment::observe(AttachmentObserver::class);
        Expense::observe(ExpenseObserver::class);
        CompanyProfile::observe(CompanyProfileObserver::class);
        Payment::observe(PaymentObserver::class);
        Invoice::observe(InvoiceObserver::class);
        Note::observe(NoteObserver::class);
        Quote::observe(QuoteObserver::class);
        RecurringInvoice::observe(RecurringInvoiceObserver::class);
        Setting::observe(SettingObserver::class);
        TimeTrackingProject::observe(TimeTrackingProjectObserver::class);
        User::observe(UserObserver::class);
        Workorder::observe(WorkorderObserver::class);
        InvoiceItem::observe(InvoiceItemObserver::class);
        QuoteItem::observe(QuoteItemObserver::class);
        RecurringInvoiceItem::observe(RecurringInvoiceItemObserver::class);
        WorkorderItem::observe(WorkorderItemObserver::class);
        TimeTrackingTask::observe(TimeTrackingTaskObserver::class);
    }
}
