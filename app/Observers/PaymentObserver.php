<?php

namespace FI\Observers;


use FI\Events\InvoiceModified;
use FI\Modules\CustomFields\Models\PaymentCustom;
use FI\Modules\Payments\Models\Payment;
use FI\Support\Contacts;
use FI\Support\Parser;

class PaymentObserver
{
    /**
     * Handle the payment "created" event.
     *
     * @param  \FI\Modules\Payments\Models\Payment  $payment
     * @return void
     */
    public function created(Payment $payment): void
    {
        event(new InvoiceModified($payment->invoice));

        // Create the default custom record.
        $payment->custom()->save(new PaymentCustom());

        if (auth()->guest() or auth()->user()->user_type == 'client')
        {
            $payment->invoice->activities()->create(['activity' => 'public.paid']);
        }

        if (request('email_payment_receipt') == 'true'
            or (!request()->exists('email_payment_receipt') and config('fi.automaticEmailPaymentReceipts') and $payment->invoice->client->email)
        )
        {
            $parser = new Parser($payment);

            $contacts = new Contacts($payment->invoice->client);

            $mail = $payment->mailQueue->create($payment, [
                'to'         => $contacts->getSelectedContactsTo(),
                'cc'         => $contacts->getSelectedContactsCc(),
                'bcc'        => $contacts->getSelectedContactsBcc(),
                'subject'    => $parser->parse('paymentReceiptEmailSubject'),
                'body'       => $parser->parse('paymentReceiptBody'),
                'attach_pdf' => config('fi.attachPdf'),
            ]);

            $payment->mailQueue->send($mail->id);
        }
    }

    public function creating(Payment $payment): void
    {

        if (!$payment->paid_at)
        {
            $payment->paid_at = date('Y-m-d');
        }
    }

    public function deleting(Payment $payment): void
    {
        foreach ($payment->mailQueue as $mailQueue)
        {
            ($payment->isForceDeleting()) ? $mailQueue->onlyTrashed()->forceDelete() : $mailQueue->delete();
        }

        foreach ($payment->notes as $note)
        {
            ($payment->isForceDeleting()) ? $note->onlyTrashed()->forceDelete() : $note->delete();
        }
    }

    public function deleted(Payment $payment): void
    {
        if ($payment->invoice)
        {
            event(new InvoiceModified($payment->invoice));
        }
    }


}
