<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\Invoices\Controllers;

use BT\Events\InvoiceEmailed;
use BT\Events\InvoiceEmailing;
use BT\Http\Controllers\Controller;
use BT\Modules\Invoices\Models\Invoice;
use BT\Modules\MailQueue\Support\MailQueue;
use BT\Requests\SendEmailRequest;
use BT\Support\Contacts;
use BT\Support\Parser;

class InvoiceMailController extends Controller
{
    private $mailQueue;

    public function __construct(MailQueue $mailQueue)
    {
        $this->mailQueue = $mailQueue;
    }

    public function create()
    {
        $invoice = Invoice::find(request('invoice_id'));

        $contacts = new Contacts($invoice->client);

        $parser = new Parser($invoice);

        if (!$invoice->is_overdue)
        {
            $subject = $parser->parse('invoiceEmailSubject');
            $body    = $parser->parse('invoiceEmailBody');
        }
        else
        {
            $subject = $parser->parse('overdueInvoiceEmailSubject');
            $body    = $parser->parse('overdueInvoiceEmailBody');
        }

        return view('invoices._modal_mail')
            ->with('invoiceId', $invoice->id)
            ->with('redirectTo', urlencode(request('redirectTo')))
            ->with('subject', $subject)
            ->with('body', $body)
            ->with('contactDropdownTo', $contacts->contactDropdownTo())
            ->with('contactDropdownCc', $contacts->contactDropdownCc())
            ->with('contactDropdownBcc', $contacts->contactDropdownBcc());
    }

    public function store(SendEmailRequest $request)
    {
        $invoice = Invoice::find($request->input('invoice_id'));

        event(new InvoiceEmailing($invoice));

        $mail = $this->mailQueue->create($invoice, $request->except('invoice_id'));

        if ($this->mailQueue->send($mail->id))
        {
            event(new InvoiceEmailed($invoice));
        }
        else
        {
            return response()->json(['errors' => [[$this->mailQueue->getError()]]], 400);
        }
    }
}
