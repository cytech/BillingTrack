<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedSettingsTable extends Migration
{

    /**
     * Run the migrations.
     */
    public function up()
    {

        DB::statement('INSERT INTO `settings` VALUES (1,\'addressFormat\',\'{{ address }}\r\n{{ city }}, {{ state }} {{ postal_code }}\',NULL,NULL)
            ,(2,\'allowPaymentsWithoutBalance\',\'0\',NULL,NULL)
            ,(3,\'amountDecimals\',\'2\',NULL,NULL)
            ,(4,\'attachPdf\',\'1\',NULL,NULL)
            ,(5,\'automaticEmailOnRecur\',\'1\',NULL,NULL)
            ,(6,\'baseCurrency\',\'USD\',NULL,NULL)
            ,(7,\'convertQuoteTerms\',\'quote\',NULL,NULL)
            ,(8,\'convertQuoteWhenApproved\',\'1\',NULL,NULL)
            ,(9,\'currencyConversionDriver\',\'FixerIOCurrencyConverter\',NULL,NULL)
            ,(10,\'dashboardTotals\',\'year_to_date\',NULL,NULL)
            ,(11,\'dateFormat\',\'m/d/Y\',NULL,NULL)
            ,(12,\'defaultCompanyProfile\',\'1\',null,null)
            ,(13,\'displayClientUniqueName\',\'0\',NULL,NULL)
            ,(14,\'displayProfileImage\',\'1\',NULL,NULL)
            ,(15,\'exchangeRateMode\',\'automatic\',NULL,NULL)
            ,(16,\'headerTitleText\',\'FusionInvoiceFOSS\',NULL,NULL)
            ,(17,\'invoiceEmailBody\',\'<p>To view your invoice from {{ $invoice->user->name }} for {{ $invoice->amount->formatted_total }}, click the link below:</p>\r\n\r\n<p><a href=\"{{ $invoice->public_url }}\">{{ $invoice->public_url }}</a></p>\',NULL,NULL)
            ,(18,\'invoiceEmailSubject\',\'Invoice #{{ $invoice->number }}\',NULL,NULL)
            ,(19,\'invoiceGroup\',\'1\',NULL,NULL)
            ,(20,\'invoicesDueAfter\',\'30\',NULL,NULL)
            ,(21,\'invoiceStatusFilter\',\'all_statuses\',NULL,NULL)
            ,(22,\'invoiceTemplate\',\'default.blade.php\',NULL,NULL)
            ,(23,\'language\',\'en\',NULL,NULL)
            ,(24,\'markInvoicesSentPdf\',\'0\',NULL,NULL)
            ,(25,\'markQuotesSentPdf\',\'0\',NULL,NULL)
            ,(26,\'merchant\',\'{\"PayPalExpress\":{\"enabled\":0,\"username\":\"\",\"password\":\"\",\"signature\":\"\",\"testMode\":0,\"paymentButtonText\":\"Pay with PayPal\"},\"Stripe\":{\"enabled\":0,\"secretKey\":\"\",\"publishableKey\":\"\",\"requireBillingName\":0,\"requireBillingAddress\":0,\"requireBillingCity\":0,\"requireBillingState\":0,\"requireBillingZip\":0,\"paymentButtonText\":\"Pay with Stripe\"},\"Mollie\":{\"enabled\":0,\"apiKey\":\"\",\"paymentButtonText\":\"Pay with Mollie\"}}\',NULL,NULL)
            ,(27,\'merchant_Mollie_apiKey\',\'\',NULL,NULL)
            ,(28,\'merchant_Mollie_enabled\',\'0\',NULL,NULL)
            ,(29,\'merchant_Mollie_paymentButtonText\',\'Pay with Mollie\',NULL,NULL)
            ,(30,\'merchant_PayPal_paymentButtonText\',\'Pay with PayPal\',NULL,NULL)
            ,(31,\'merchant_Stripe_enableBitcoinPayments\',\'0\',NULL,NULL)
            ,(32,\'merchant_Stripe_enabled\',\'0\',NULL,NULL)
            ,(33,\'merchant_Stripe_paymentButtonText\',\'Pay with Stripe\',NULL,NULL)
            ,(34,\'merchant_Stripe_publishableKey\',\'\',NULL,NULL)
            ,(35,\'merchant_Stripe_secretKey\',\'\',NULL,NULL)
            ,(36,\'overdueInvoiceEmailBody\',\'<p>This is a reminder to let you know your invoice from {{ $invoice->user->name }} for {{ $invoice->amount->formatted_total }} is overdue. Click the link below to view the invoice:</p>\r\n\r\n<p><a href=\"{{ $invoice->public_url }}\">{{ $invoice->public_url }}</a></p>\',NULL,NULL)
            ,(37,\'overdueInvoiceEmailSubject\',\'Overdue Invoice Reminder: Invoice #{{ $invoice->number }}\',NULL,NULL)
            ,(38,\'paperOrientation\',\'portrait\',NULL,NULL)
            ,(39,\'paperSize\',\'letter\',NULL,NULL)
            ,(40,\'paymentReceiptBody\',\'<p>Thank you! Your payment of {{ $payment->formatted_amount }} has been applied to Invoice #{{ $payment->invoice->number }}.</p>\',NULL,NULL)
            ,(41,\'paymentReceiptEmailSubject\',\'Payment Receipt for Invoice #{{ $payment->invoice->number }}\',NULL,NULL)
            ,(42,\'pdfDriver\',\'domPDF\',NULL,NULL)
            ,(43,\'profileImageDriver\',\'Gravatar\',NULL,NULL)
            ,(44,\'quoteApprovedEmailBody\',\'<p><a href=\"{{ $quote->public_url }}\">Quote #{{ $quote->number }}</a> has been APPROVED.</p>\',NULL,NULL)
            ,(45,\'quoteEmailBody\',\'<p>To view your quote from {{ $quote->user->name }} for {{ $quote->amount->formatted_total }}, click the link below:</p>\r\n\r\n<p><a href=\"{{ $quote->public_url }}\">{{ $quote->public_url }}</a></p>\',NULL,NULL)
            ,(46,\'quoteEmailSubject\',\'Quote #{{ $quote->number }}\',NULL,NULL)
            ,(47,\'quoteGroup\',\'2\',NULL,NULL)
            ,(48,\'quoteRejectedEmailBody\',\'<p><a href=\"{{ $quote->public_url }}\">Quote #{{ $quote->number }}</a> has been REJECTED.</p>\',NULL,NULL)
            ,(49,\'quotesExpireAfter\',\'15\',NULL,NULL)
            ,(50,\'quoteStatusFilter\',\'all_statuses\',NULL,NULL)
            ,(51,\'quoteTemplate\',\'default.blade.php\',NULL,NULL)
            ,(52,\'resultsPerPage\',\'15\',NULL,NULL)
            ,(53,\'roundTaxDecimals\',\'3\',NULL,NULL)
            ,(54,\'skin\',\'skin-purple.min.css\',NULL,NULL)
            ,(55,\'timezone\',\'America/Phoenix\',NULL,NULL)
            ,(56,\'upcomingPaymentNoticeEmailBody\',\'<p>This is a notice to let you know your invoice from {{ $invoice->user->name }} for {{ $invoice->amount->formatted_total }} is due on {{ $invoice->formatted_due_at }}. Click the link below to view the invoice:</p>\r\n\r\n<p><a href=\"{{ $invoice->public_url }}\">{{ $invoice->public_url }}</a></p>\',NULL,NULL)
            ,(57,\'upcomingPaymentNoticeEmailSubject\',\'Upcoming Payment Due Notice: Invoice #{{ $invoice->number }}\',NULL,NULL)
            ,(58,\'version\',\'4.0.0\',NULL,NULL)
            ,(59,\'widgetColumnWidthClientActivity\',\'4\',NULL,NULL)
            ,(60,\'widgetColumnWidthInvoiceSummary\',\'6\',NULL,NULL)
            ,(61,\'widgetColumnWidthQuoteSummary\',\'6\',NULL,NULL)
            ,(62,\'widgetDisplayOrderClientActivity\',\'3\',NULL,NULL)
            ,(63,\'widgetDisplayOrderInvoiceSummary\',\'1\',NULL,NULL)
            ,(64,\'widgetDisplayOrderQuoteSummary\',\'2\',NULL,NULL)
            ,(65,\'widgetEnabledClientActivity\',\'0\',NULL,NULL)
            ,(66,\'widgetEnabledInvoiceSummary\',\'1\',NULL,NULL)
            ,(67,\'widgetEnabledQuoteSummary\',\'1\',NULL,NULL)
            ,(68,\'widgetInvoiceSummaryDashboardTotals\',\'year_to_date\',NULL,NULL)
            ,(69,\'widgetQuoteSummaryDashboardTotals\',\'year_to_date\',NULL,NULL)');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
