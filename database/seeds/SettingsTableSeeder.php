<?php

use FI\Modules\Settings\Models\Setting;
use Illuminate\Database\Seeder;

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


        DB::statement('INSERT INTO settings VALUES (1,\'addressFormat\',\'{{ address }}\r\n{{ city }}, {{ state }} {{ postal_code }}\',NULL,NULL,NULL)
            ,(2,\'allowPaymentsWithoutBalance\',\'0\',NULL,NULL,NULL)
            ,(3,\'amountDecimals\',\'2\',NULL,NULL,NULL)
            ,(4,\'attachPdf\',\'1\',NULL,NULL,NULL)
            ,(5,\'automaticEmailOnRecur\',\'1\',NULL,NULL,NULL)
            ,(6,\'baseCurrency\',\'USD\',NULL,NULL,NULL)
            ,(7,\'convertQuoteTerms\',\'quote\',NULL,NULL,NULL)
            ,(8,\'convertQuoteWhenApproved\',\'1\',NULL,NULL,NULL)
            ,(9,\'currencyConversionDriver\',\'FixerIOCurrencyConverter\',NULL,NULL,NULL)
            ,(10,\'dashboardTotals\',\'year_to_date\',NULL,NULL,NULL)
            ,(11,\'dateFormat\',\'m/d/Y\',NULL,NULL,NULL)
            ,(12,\'defaultCompanyProfile\',\'1\',NULL,NULL,NULL)
            ,(13,\'displayClientUniqueName\',\'0\',NULL,NULL,NULL)
            ,(14,\'displayProfileImage\',\'1\',NULL,NULL,NULL)
            ,(15,\'exchangeRateMode\',\'automatic\',NULL,NULL,NULL)
            ,(16,\'headerTitleText\',\'FusionInvoiceFOSS\',NULL,NULL,NULL)
            ,(17,\'invoiceEmailBody\',\'<p>To view your invoice from {{ $invoice->user->name }} for {{ $invoice->amount->formatted_total }}, click the link below:</p>\r\n\r\n<p><a href=\"{{ $invoice->public_url }}\">{{ $invoice->public_url }}</a></p>\',NULL,NULL,NULL)
            ,(18,\'invoiceEmailSubject\',\'Invoice #{{ $invoice->number }}\',NULL,NULL,NULL)
            ,(19,\'invoiceGroup\',\'1\',NULL,NULL,NULL)
            ,(20,\'invoicesDueAfter\',\'30\',NULL,NULL,NULL)
            ,(21,\'invoiceStatusFilter\',\'all_statuses\',NULL,NULL,NULL)
            ,(22,\'invoiceTemplate\',\'default.blade.php\',NULL,NULL,NULL)
            ,(23,\'language\',\'en\',NULL,NULL,NULL)
            ,(24,\'markInvoicesSentPdf\',\'0\',NULL,NULL,NULL)
            ,(25,\'markQuotesSentPdf\',\'0\',NULL,NULL,NULL)
            ,(26,\'merchant\',\'{\"PayPalExpress\":{\"enabled\":0,\"username\":\"\",\"password\":\"\",\"signature\":\"\",\"testMode\":0,\"paymentButtonText\":\"Pay with PayPal\"},\"Stripe\":{\"enabled\":0,\"secretKey\":\"\",\"publishableKey\":\"\",\"requireBillingName\":0,\"requireBillingAddress\":0,\"requireBillingCity\":0,\"requireBillingState\":0,\"requireBillingZip\":0,\"paymentButtonText\":\"Pay with Stripe\"},\"Mollie\":{\"enabled\":0,\"apiKey\":\"\",\"paymentButtonText\":\"Pay with Mollie\"}}\',NULL,NULL,NULL)
            ,(27,\'merchant_Mollie_apiKey\',\'\',NULL,NULL,NULL)
            ,(28,\'merchant_Mollie_enabled\',\'0\',NULL,NULL,NULL)
            ,(29,\'merchant_Mollie_paymentButtonText\',\'Pay with Mollie\',NULL,NULL,NULL)
            ,(30,\'merchant_PayPal_paymentButtonText\',\'Pay with PayPal\',NULL,NULL,NULL)
            ,(31,\'merchant_Stripe_enableBitcoinPayments\',\'0\',NULL,NULL,NULL)
            ,(32,\'merchant_Stripe_enabled\',\'0\',NULL,NULL,NULL)
            ,(33,\'merchant_Stripe_paymentButtonText\',\'Pay with Stripe\',NULL,NULL,NULL)
            ,(34,\'merchant_Stripe_publishableKey\',\'\',NULL,NULL,NULL)
            ,(35,\'merchant_Stripe_secretKey\',\'\',NULL,NULL,NULL)
            ,(36,\'overdueInvoiceEmailBody\',\'<p>This is a reminder to let you know your invoice from {{ $invoice->user->name }} for {{ $invoice->amount->formatted_total }} is overdue. Click the link below to view the invoice:</p>\r\n\r\n<p><a href=\"{{ $invoice->public_url }}\">{{ $invoice->public_url }}</a></p>\',NULL,NULL,NULL)
            ,(37,\'overdueInvoiceEmailSubject\',\'Overdue Invoice Reminder: Invoice #{{ $invoice->number }}\',NULL,NULL,NULL)
            ,(38,\'paperOrientation\',\'portrait\',NULL,NULL,NULL)
            ,(39,\'paperSize\',\'letter\',NULL,NULL,NULL)
            ,(40,\'paymentReceiptBody\',\'<p>Thank you! Your payment of {{ $payment->formatted_amount }} has been applied to Invoice #{{ $payment->invoice->number }}.</p>\',NULL,NULL,NULL)
            ,(41,\'paymentReceiptEmailSubject\',\'Payment Receipt for Invoice #{{ $payment->invoice->number }}\',NULL,NULL,NULL)
            ,(42,\'pdfDriver\',\'domPDF\',NULL,NULL,NULL)
            ,(43,\'profileImageDriver\',\'Gravatar\',NULL,NULL,NULL)
            ,(44,\'quoteApprovedEmailBody\',\'<p><a href=\"{{ $quote->public_url }}\">Quote #{{ $quote->number }}</a> has been APPROVED.</p>\',NULL,NULL,NULL)
            ,(45,\'quoteEmailBody\',\'<p>To view your quote from {{ $quote->user->name }} for {{ $quote->amount->formatted_total }}, click the link below:</p>\r\n\r\n<p><a href=\"{{ $quote->public_url }}\">{{ $quote->public_url }}</a></p>\',NULL,NULL,NULL)
            ,(46,\'quoteEmailSubject\',\'Quote #{{ $quote->number }}\',NULL,NULL,NULL)
            ,(47,\'quoteGroup\',\'2\',NULL,NULL,NULL)
            ,(48,\'quoteRejectedEmailBody\',\'<p><a href=\"{{ $quote->public_url }}\">Quote #{{ $quote->number }}</a> has been REJECTED.</p>\',NULL,NULL,NULL)
            ,(49,\'quotesExpireAfter\',\'15\',NULL,NULL,NULL)
            ,(50,\'quoteStatusFilter\',\'all_statuses\',NULL,NULL,NULL)
            ,(51,\'quoteTemplate\',\'default.blade.php\',NULL,NULL,NULL)
            ,(52,\'resultsPerPage\',\'15\',NULL,NULL,NULL)
            ,(53,\'roundTaxDecimals\',\'3\',NULL,NULL,NULL)
            ,(54,\'skin\',\'skin-purple.min.css\',NULL,NULL,NULL)
            ,(55,\'timezone\',\'America/Phoenix\',NULL,NULL,NULL)
            ,(56,\'upcomingPaymentNoticeEmailBody\',\'<p>This is a notice to let you know your invoice from {{ $invoice->user->name }} for {{ $invoice->amount->formatted_total }} is due on {{ $invoice->formatted_due_at }}. Click the link below to view the invoice:</p>\r\n\r\n<p><a href=\"{{ $invoice->public_url }}\">{{ $invoice->public_url }}</a></p>\',NULL,NULL,NULL)
            ,(57,\'upcomingPaymentNoticeEmailSubject\',\'Upcoming Payment Due Notice: Invoice #{{ $invoice->number }}\',NULL,NULL,NULL)
            ,(58,\'version\',\'4.0.0\',NULL,NULL,NULL)
            ,(59,\'widgetColumnWidthClientActivity\',\'4\',NULL,NULL,NULL)
            ,(60,\'widgetColumnWidthInvoiceSummary\',\'6\',NULL,NULL,NULL)
            ,(61,\'widgetColumnWidthQuoteSummary\',\'6\',NULL,NULL,NULL)
            ,(62,\'widgetDisplayOrderClientActivity\',\'3\',NULL,NULL,NULL)
            ,(63,\'widgetDisplayOrderInvoiceSummary\',\'1\',NULL,NULL,NULL)
            ,(64,\'widgetDisplayOrderQuoteSummary\',\'2\',NULL,NULL,NULL)
            ,(65,\'widgetEnabledClientActivity\',\'0\',NULL,NULL,NULL)
            ,(66,\'widgetEnabledInvoiceSummary\',\'1\',NULL,NULL,NULL)
            ,(67,\'widgetEnabledQuoteSummary\',\'1\',NULL,NULL,NULL)
            ,(68,\'widgetInvoiceSummaryDashboardTotals\',\'year_to_date\',NULL,NULL,NULL)
            ,(69,\'widgetQuoteSummaryDashboardTotals\',\'year_to_date\',NULL,NULL,NULL)');

        //insert workorder settings
        //DB::table('settings')->insert([ 'setting_key' => 'scheduler', 'setting_value' => $scheduler ]);
        DB::table('settings')->insert([ 'setting_key' => 'restolup', 'setting_value' => '0' ]);
        DB::table('settings')->insert([ 'setting_key' => 'emptolup', 'setting_value' => '0' ]);
        DB::table('settings')->insert([ 'setting_key' => 'workorderTemplate', 'setting_value' => 'default.blade.php' ]);
        DB::table('settings')->insert([ 'setting_key' => 'workorderGroup', 'setting_value' => '3' ]);
        DB::table('settings')->insert([ 'setting_key' => 'workordersExpireAfter', 'setting_value' => '15' ]);
        DB::table('settings')->insert([ 'setting_key' => 'workorderTerms', 'setting_value' => 'Default Terms:' ]);
        DB::table('settings')->insert([ 'setting_key' => 'workorderFooter', 'setting_value' => 'Default Footer:' ]);
        DB::table('settings')->insert([ 'setting_key' => 'convertWorkorderTerms', 'setting_value' => 'workorder' ]);
        //DB::table('settings')->insert([ 'setting_key' => 'enableLegacyCalendar', 'setting_value' => $enableLegacyCalendar ]);
        //DB::table('settings')->insert([ 'setting_key' => 'legacyCalendarScript', 'setting_value' => $legacyCalendarScript ]);
        //DB::table('settings')->insert([ 'setting_key' => 'version', 'setting_value' => '2.0.0' ]);
        DB::table('settings')->insert([ 'setting_key' => 'tsCompanyName', 'setting_value' => 'YOURQBCOMPANYNAME' ]);
        DB::table('settings')->insert([ 'setting_key' => 'tsCompanyCreate', 'setting_value' => 'YOURQBCOMPANYCREATETIME' ]);
        DB::table('settings')->insert([ 'setting_key' => 'workorderStatusFilter', 'setting_value' => 'all_statuses' ]);

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
        //insert scheduler settings
        DB::table('settings')->insert(['setting_key' => 'schedulerPastdays', 'setting_value' => '60']);
        DB::table('settings')->insert(['setting_key' => 'schedulerEventLimit', 'setting_value' => '5']);
        DB::table('settings')->insert(['setting_key' => 'schedulerCreateWorkorder', 'setting_value' => '0']);
        DB::table('settings')->insert(['setting_key' => 'schedulerFcThemeSystem', 'setting_value' => 'standard']);
        DB::table('settings')->insert(['setting_key' => 'schedulerFcAspectRatio', 'setting_value' => '1.35']);
        DB::table('settings')->insert(['setting_key' => 'schedulerTimestep', 'setting_value' => '15']);
        DB::table('settings')->insert(['setting_key' => 'schedulerEnabledCoreEvents', 'setting_value' => '15']);
        //new core
        DB::table('settings')->insert(['setting_key' => 'pdfDisposition', 'setting_value' => 'inline']);

    }
}
