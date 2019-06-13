<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\Tasks\Controllers;

use Carbon\Carbon;
use BT\Events\InvoiceCreatedRecurring;
use BT\Http\Controllers\Controller;
use BT\Modules\CustomFields\Models\CustomField;
use BT\Modules\Invoices\Models\Invoice;
use BT\Modules\Invoices\Models\InvoiceItem;
use BT\Modules\MailQueue\Support\MailQueue;
use BT\Modules\RecurringInvoices\Models\RecurringInvoice;
use BT\Support\DateFormatter;
use BT\Support\Parser;
use BT\Support\Statuses\InvoiceStatuses;
use Illuminate\Support\Facades\Log;

class TaskController extends Controller
{
    private $mailQueue;

    public function __construct(MailQueue $mailQueue)
    {
        $this->mailQueue = $mailQueue;
    }

    public function run()
    {
        $this->queueOverdueInvoices();

        $this->queueUpcomingInvoices();

        $this->recurInvoices();
    }

    private function queueUpcomingInvoices()
    {
        $days = config('bt.upcomingPaymentNoticeFrequency');

        if ($days)
        {
            $days = explode(',', $days);

            foreach ($days as $daysFromNow)
            {
                $daysFromNow = trim($daysFromNow);

                if (is_numeric($daysFromNow))
                {
                    $daysFromNow = intval($daysFromNow);

                    $date = Carbon::now()->addDays($daysFromNow)->format('Y-m-d');

                    $invoices = Invoice::with('client')
                        ->where('invoice_status_id', '=', InvoiceStatuses::getStatusId('sent'))
                        ->whereHas('amount', function ($query) {
                            $query->where('balance', '>', '0');
                        })
                        ->where('due_at', $date)
                        ->get();

                    Log::info('BT::MailQueue - Invoices found due ' . $daysFromNow . ' days from now on ' . $date . ': ' . $invoices->count());

                    foreach ($invoices as $invoice)
                    {
                        $parser = new Parser($invoice);

                        $mail = $this->mailQueue->create($invoice, [
                            'to'         => [$invoice->client->email],
                            'cc'         => [config('bt.mailDefaultCc')],
                            'bcc'        => [config('bt.mailDefaultBcc')],
                            'subject'    => $parser->parse('upcomingPaymentNoticeEmailSubject'),
                            'body'       => $parser->parse('upcomingPaymentNoticeEmailBody'),
                            'attach_pdf' => config('bt.attachPdf'),
                        ]);

                        $this->mailQueue->send($mail->id);
                    }
                }
                else
                {
                    Log::info('BT::MailQueue - Upcoming payment due indicator: ' . $daysFromNow);
                }
            }
        }
    }

    private function queueOverdueInvoices()
    {
        $days = config('bt.overdueInvoiceReminderFrequency');

        if ($days)
        {
            $days = explode(',', $days);

            foreach ($days as $daysAgo)
            {
                $daysAgo = trim($daysAgo);

                if (is_numeric($daysAgo))
                {
                    $daysAgo = intval($daysAgo);

                    $date = Carbon::now()->subDays($daysAgo)->format('Y-m-d');

                    $invoices = Invoice::with('client')
                        ->where('invoice_status_id', '=', InvoiceStatuses::getStatusId('sent'))
                        ->whereHas('amount', function ($query) {
                            $query->where('balance', '>', '0');
                        })
                        ->where('due_at', $date)
                        ->get();

                    Log::info('BT::MailQueue - Invoices found due ' . $daysAgo . ' days ago on ' . $date . ': ' . $invoices->count());

                    foreach ($invoices as $invoice)
                    {
                        $parser = new Parser($invoice);

                        $mail = $this->mailQueue->create($invoice, [
                            'to'         => [$invoice->client->email],
                            'cc'         => [config('bt.mailDefaultCc')],
                            'bcc'        => [config('bt.mailDefaultBcc')],
                            'subject'    => $parser->parse('overdueInvoiceEmailSubject'),
                            'body'       => $parser->parse('overdueInvoiceEmailBody'),
                            'attach_pdf' => config('bt.attachPdf'),
                        ]);

                        $this->mailQueue->send($mail->id);

                    }
                }
                else
                {
                    Log::info('BT::MailQueue - Invalid overdue indicator: ' . $daysAgo);
                }
            }
        }
    }

    private function recurInvoices()
    {
        $recurringInvoices = RecurringInvoice::recurNow()->get();

        foreach ($recurringInvoices as $recurringInvoice)
        {
            $invoiceData = [
                'company_profile_id' => $recurringInvoice->company_profile_id,
                'created_at'         => $recurringInvoice->next_date,
                'group_id'           => $recurringInvoice->group_id,
                'user_id'            => $recurringInvoice->user_id,
                'client_id'          => $recurringInvoice->client_id,
                'currency_code'      => $recurringInvoice->currency_code,
                'template'           => $recurringInvoice->template,
                'terms'              => $recurringInvoice->terms,
                'footer'             => $recurringInvoice->footer,
                'summary'            => $recurringInvoice->summary,
                'discount'           => $recurringInvoice->discount,
            ];

            $invoice = Invoice::create($invoiceData);

            CustomField::copyCustomFieldValues($recurringInvoice, $invoice);

            foreach ($recurringInvoice->recurringInvoiceItems as $item)
            {
                $itemData = [
                    'invoice_id'    => $invoice->id,
                    'name'          => $item->name,
                    'description'   => $item->description,
                    'quantity'      => $item->quantity,
                    'price'         => $item->price,
                    'tax_rate_id'   => $item->tax_rate_id,
                    'tax_rate_2_id' => $item->tax_rate_2_id,
                    'display_order' => $item->display_order,
                ];

                InvoiceItem::create($itemData);
            }

            if ($recurringInvoice->stop_date == '0000-00-00' or ($recurringInvoice->stop_date !== '0000-00-00' and ($recurringInvoice->next_date < $recurringInvoice->stop_date)))
            {
                $nextDate = DateFormatter::incrementDate(substr($recurringInvoice->next_date, 0, 10), $recurringInvoice->recurring_period, $recurringInvoice->recurring_frequency);
            }
            else
            {
                $nextDate = '0000-00-00';
            }

            $recurringInvoice->next_date = $nextDate;
            $recurringInvoice->save();

            event(new InvoiceCreatedRecurring($invoice, $recurringInvoice));
        }

        return count($recurringInvoices);
    }
}
