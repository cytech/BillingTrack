<?php

namespace Database\Seeders;

use BT\Modules\Settings\Models\Setting;
use Illuminate\Database\Seeder;
use DB;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (count(Setting::all())){
            return;
        }

        Setting::saveByKey('addressFormat',"{{ address }}\r\n{{ city }}, {{ state }} {{ postal_code }}");
        Setting::saveByKey('allowPaymentsWithoutBalance','0');
        Setting::saveByKey('amountDecimals','2');
        Setting::saveByKey('attachPdf','1');
        Setting::saveByKey('automaticEmailOnRecur','1');
        Setting::saveByKey('baseCurrency','USD');
        Setting::saveByKey('convertQuoteTerms','quote');
        Setting::saveByKey('convertQuoteWhenApproved','1');
        Setting::saveByKey('currencyConversionDriver','FixerIOCurrencyConverter');
        Setting::saveByKey('dashboardTotals','year_to_date');
        Setting::saveByKey('dateFormat','m/d/Y');
        Setting::saveByKey('defaultCompanyProfile','1');
        Setting::saveByKey('displayClientUniqueName','0');
        Setting::saveByKey('displayProfileImage','1');
        Setting::saveByKey('exchangeRateMode','automatic');
        Setting::saveByKey('headerTitleText','BillingTrack');
        Setting::saveByKey('invoiceEmailBody','<p>To view your invoice from {{ $invoice->user->name }} for {{ $invoice->amount->formatted_total }}, click the link below:</p><br><br><p><a href="{{ $invoice->public_url }}">{{ $invoice->public_url }}</a></p>');
        Setting::saveByKey('invoiceEmailSubject','Invoice #{{ $invoice->number }}');
        Setting::saveByKey('invoiceGroup','1');
        Setting::saveByKey('invoicesDueAfter','30');
        Setting::saveByKey('invoiceStatusFilter','all_statuses');
        Setting::saveByKey('invoiceTemplate','default.blade.php');
        Setting::saveByKey('language','en');
        Setting::saveByKey('markInvoicesSentPdf','0');
        Setting::saveByKey('markQuotesSentPdf','0');
        Setting::saveByKey('merchant','{"PayPalExpress":{"enabled":0,"username":"","password":"","signature":"","testMode":0,"paymentButtonText":"Pay with PayPal"},"Stripe":{"enabled":0,"secretKey":"","publishableKey":"","requireBillingName":0,"requireBillingAddress":0,"requireBillingCity":0,"requireBillingState":0,"requireBillingZip":0,"paymentButtonText":"Pay with Stripe"},"Mollie":{"enabled":0,"apiKey":"","paymentButtonText":"Pay with Mollie"}}');
        Setting::saveByKey('merchant_Mollie_apiKey','');
        Setting::saveByKey('merchant_Mollie_enabled','0');
        Setting::saveByKey('merchant_Mollie_paymentButtonText','Pay with Mollie');
        Setting::saveByKey('merchant_PayPal_paymentButtonText','Pay with PayPal');
        Setting::saveByKey('merchant_Stripe_enableBitcoinPayments','0');
        Setting::saveByKey('merchant_Stripe_enabled','0');
        Setting::saveByKey('merchant_Stripe_paymentButtonText','Pay with Stripe');
        Setting::saveByKey('merchant_Stripe_publishableKey','');
        Setting::saveByKey('merchant_Stripe_secretKey','');
        Setting::saveByKey('overdueInvoiceEmailBody','<p>This is a reminder to let you know your invoice from {{ $invoice->user->name }} for {{ $invoice->amount->formatted_total }} is overdue. Click the link below to view the invoice:</p><br><br><p><a href="{{ $invoice->public_url }}">{{ $invoice->public_url }}</a></p>');
        Setting::saveByKey('overdueInvoiceEmailSubject','Overdue Invoice Reminder: Invoice #{{ $invoice->number }}');
        Setting::saveByKey('paperOrientation','portrait');
        Setting::saveByKey('paperSize','letter');
        Setting::saveByKey('paymentReceiptBody','<p>Thank you! Your payment of {{ $payment->formatted_amount }} has been applied to Invoice #{{ $payment->invoice->number }}.</p>');
        Setting::saveByKey('paymentReceiptEmailSubject','Payment Receipt for Invoice #{{ $payment->invoice->number }}');
        Setting::saveByKey('pdfDriver','domPDF');
        Setting::saveByKey('profileImageDriver','Gravatar');
        Setting::saveByKey('quoteApprovedEmailBody','<p><a href="{{ $quote->public_url }}">Quote #{{ $quote->number }}</a> has been APPROVED.</p>');
        Setting::saveByKey('quoteEmailBody','<p>To view your quote from {{ $quote->user->name }} for {{ $quote->amount->formatted_total }}, click the link below:</p><br><br><p><a href="{{ $quote->public_url }}">{{ $quote->public_url }}</a></p>');
        Setting::saveByKey('quoteEmailSubject','Quote #{{ $quote->number }}');
        Setting::saveByKey('quoteGroup','2');
        Setting::saveByKey('quoteRejectedEmailBody','<p><a href="{{ $quote->public_url }}">Quote #{{ $quote->number }}</a> has been REJECTED.</p>');
        Setting::saveByKey('quotesExpireAfter','15');
        Setting::saveByKey('quoteStatusFilter','all_statuses');
        Setting::saveByKey('quoteTemplate','default.blade.php');
        Setting::saveByKey('resultsPerPage','15');
        Setting::saveByKey('roundTaxDecimals','3');
        Setting::saveByKey('skin','skin-purple.min.css');
        Setting::saveByKey('timezone','America/Phoenix');
        Setting::saveByKey('upcomingPaymentNoticeEmailBody','<p>This is a notice to let you know your invoice from {{ $invoice->user->name }} for {{ $invoice->amount->formatted_total }} is due on {{ $invoice->formatted_due_at }}. Click the link below to view the invoice:</p><br><br><p><a href="{{ $invoice->public_url }}">{{ $invoice->public_url }}</a></p>');
        Setting::saveByKey('upcomingPaymentNoticeEmailSubject','Upcoming Payment Due Notice: Invoice #{{ $invoice->number }}');
        Setting::saveByKey('version','4.0.0');
        Setting::saveByKey('widgetColumnWidthClientActivity','4');
        Setting::saveByKey('widgetColumnWidthInvoiceSummary','6');
        Setting::saveByKey('widgetColumnWidthQuoteSummary','6');
        Setting::saveByKey('widgetDisplayOrderClientActivity','3');
        Setting::saveByKey('widgetDisplayOrderInvoiceSummary','1');
        Setting::saveByKey('widgetDisplayOrderQuoteSummary','2');
        Setting::saveByKey('widgetEnabledClientActivity','0');
        Setting::saveByKey('widgetEnabledInvoiceSummary','1');
        Setting::saveByKey('widgetEnabledQuoteSummary','1');
        Setting::saveByKey('widgetInvoiceSummaryDashboardTotals','year_to_date');
        Setting::saveByKey('widgetQuoteSummaryDashboardTotals','year_to_date');
        //insert workorder settings

        Setting::saveByKey('restolup', '0' );
        Setting::saveByKey('emptolup', '0' );
        Setting::saveByKey('workorderTemplate', 'default.blade.php' );
        Setting::saveByKey('workorderGroup', '3' );
        Setting::saveByKey('workordersExpireAfter', '15' );
        Setting::saveByKey('workorderTerms', 'Default Terms:' );
        Setting::saveByKey('workorderFooter', 'Default Footer:' );
        Setting::saveByKey('convertWorkorderTerms', 'workorder' );
        Setting::saveByKey('tsCompanyName', 'YOURQBCOMPANYNAME' );
        Setting::saveByKey('tsCompanyCreate', 'YOURQBCOMPANYCREATETIME' );
        Setting::saveByKey('workorderStatusFilter', 'all_statuses' );
        //insert scheduler settings
        Setting::saveByKey('schedulerPastdays', '60');
        Setting::saveByKey('schedulerEventLimit', '5');
        Setting::saveByKey('schedulerCreateWorkorder', '0');
        Setting::saveByKey('schedulerFcThemeSystem', 'standard');
        Setting::saveByKey('schedulerFcAspectRatio', '1.35');
        Setting::saveByKey('schedulerTimestep', '15');
        Setting::saveByKey('schedulerEnabledCoreEvents', '15');
        Setting::saveByKey('schedulerDisplayInvoiced', '0');
        //new core
        Setting::saveByKey('pdfDisposition', 'inline');
        //insert scheduler categories settings
        DB::table('schedule_categories')->insert(['id' => 1,'name' => 'Worker Schedule', 'text_color' => '#000000', 'bg_color' => '#aaffaa']);
        DB::table('schedule_categories')->insert(['id' => 2,'name' => 'General Appointment', 'text_color' => '#000000', 'bg_color' => '#5656ff']);
        DB::table('schedule_categories')->insert(['id' => 3,'name' => 'Employee Appointment', 'text_color' => '#000000', 'bg_color' => '#d4aaff']);
        DB::table('schedule_categories')->insert(['id' => 4, 'name' => 'Quote', 'text_color' => '#ffffff', 'bg_color' => '#716cb1']);
        DB::table('schedule_categories')->insert(['id' => 5, 'name' => 'Workorder', 'text_color' => '#000000', 'bg_color' => '#aaffaa']);
        DB::table('schedule_categories')->insert(['id' => 6, 'name' => 'Invoice', 'text_color' => '#ffffff', 'bg_color' => '#377eb8']);
        DB::table('schedule_categories')->insert(['id' => 7, 'name' => 'Payment', 'text_color' => '#ffffff', 'bg_color' => '#5fa213']);
        DB::table('schedule_categories')->insert(['id' => 8, 'name' => 'Expense', 'text_color' => '#ffffff', 'bg_color' => '#d95d02']);
        DB::table('schedule_categories')->insert(['id' => 9, 'name' => 'Project', 'text_color' => '#ffffff', 'bg_color' => '#676767']);
        DB::table('schedule_categories')->insert(['id' => 10, 'name' => 'Task', 'text_color' => '#ffffff', 'bg_color' => '#a87821']);


    }
}
