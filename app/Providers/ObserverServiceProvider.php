<?php

namespace BT\Providers;

use BT\Modules\Attachments\Models\Attachment;
use BT\Modules\CompanyProfiles\Models\CompanyProfile;
use BT\Modules\Expenses\Models\Expense;
use BT\Modules\Invoices\Models\Invoice;
use BT\Modules\Invoices\Models\InvoiceItem;
use BT\Modules\Notes\Models\Note;
use BT\Modules\Payments\Models\Payment;
use BT\Modules\Purchaseorders\Models\Purchaseorder;
use BT\Modules\Purchaseorders\Models\PurchaseorderItem;
use BT\Modules\Quotes\Models\Quote;
use BT\Modules\Quotes\Models\QuoteItem;
use BT\Modules\RecurringInvoices\Models\RecurringInvoice;
use BT\Modules\RecurringInvoices\Models\RecurringInvoiceItem;
use BT\Modules\Settings\Models\Setting;
use BT\Modules\TimeTracking\Models\TimeTrackingProject;
use BT\Modules\TimeTracking\Models\TimeTrackingTask;
use BT\Modules\Users\Models\User;
use BT\Modules\Vendors\Models\Vendor;
use BT\Modules\Workorders\Models\Workorder;
use BT\Modules\Workorders\Models\WorkorderItem;
use BT\Observers\AttachmentObserver;
use BT\Observers\ClientObserver;
use BT\Modules\Clients\Models\Client;
use BT\Observers\CompanyProfileObserver;
use BT\Observers\ExpenseObserver;
use BT\Observers\InvoiceItemObserver;
use BT\Observers\InvoiceObserver;
use BT\Observers\NoteObserver;
use BT\Observers\PaymentObserver;
use BT\Observers\PurchaseorderItemObserver;
use BT\Observers\PurchaseorderObserver;
use BT\Observers\QuoteItemObserver;
use BT\Observers\QuoteObserver;
use BT\Observers\RecurringInvoiceItemObserver;
use BT\Observers\RecurringInvoiceObserver;
use BT\Observers\SettingObserver;
use BT\Observers\TimeTrackingProjectObserver;
use BT\Observers\TimeTrackingTaskObserver;
use BT\Observers\UserObserver;
use BT\Observers\VendorObserver;
use BT\Observers\WorkorderItemObserver;
use BT\Observers\WorkorderObserver;
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
        Vendor::observe(VendorObserver::class);
        Purchaseorder::observe(PurchaseorderObserver::class);
        PurchaseorderItem::observe(PurchaseorderItemObserver::class);


    }
}
