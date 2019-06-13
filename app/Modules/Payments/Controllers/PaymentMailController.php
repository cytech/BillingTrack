<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\Payments\Controllers;

use BT\Http\Controllers\Controller;
use BT\Modules\MailQueue\Support\MailQueue;
use BT\Modules\Payments\Models\Payment;
use BT\Requests\SendEmailRequest;
use BT\Support\Contacts;
use BT\Support\Parser;

class PaymentMailController extends Controller
{
    private $mailQueue;

    public function __construct(MailQueue $mailQueue)
    {
        $this->mailQueue = $mailQueue;
    }

    public function create()
    {
        $payment = Payment::find(request('payment_id'));

        $contacts = new Contacts($payment->invoice->client);

        $parser = new Parser($payment);

        return view('payments._modal_mail')
            ->with('paymentId', $payment->id)
            ->with('redirectTo', request('redirectTo'))
            ->with('subject', $parser->parse('paymentReceiptEmailSubject'))
            ->with('body', $parser->parse('paymentReceiptBody'))
            ->with('contactDropdownTo', $contacts->contactDropdownTo())
            ->with('contactDropdownCc', $contacts->contactDropdownCc())
            ->with('contactDropdownBcc', $contacts->contactDropdownBcc());
    }

    public function store(SendEmailRequest $request)
    {
        $payment = Payment::find($request->input('payment_id'));

        $mail = $this->mailQueue->create($payment, $request->except('payment_id'));

        if (!$this->mailQueue->send($mail->id))
        {
            return response()->json(['errors' => [[$this->mailQueue->getError()]]], 400);
        }
    }
}
