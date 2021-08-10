<?php

namespace BT\Observers;


use BT\Events\InvoiceModified;
use BT\Modules\CustomFields\Models\PaymentCustom;
use BT\Modules\MailQueue\Support\MailQueue;
use BT\Modules\Payments\Models\Payment;
use BT\Support\Contacts;
use BT\Support\Parser;

class PaymentObserver
{
    public function __construct(MailQueue $mailQueue)
    {
        $this->mailQueue = $mailQueue;
    }
    /**
     * Handle the payment "created" event.
     *
     * @param  \BT\Modules\Payments\Models\Payment  $payment
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
            or (!request()->exists('email_payment_receipt') and config('bt.automaticEmailPaymentReceipts') and $payment->invoice->client->email)
        )
        {
            $parser = new Parser($payment);

            $contacts = new Contacts($payment->invoice->client);

            $mail = $this->mailQueue->create($payment, [
                'to'         => $contacts->getSelectedContactsTo(),
                'cc'         => $contacts->getSelectedContactsCc(),
                'bcc'        => $contacts->getSelectedContactsBcc(),
                'subject'    => $parser->parse('paymentReceiptEmailSubject'),
                'body'       => $parser->parse('paymentReceiptBody'),
                'attach_pdf' => config('bt.attachPdf'),
            ]);

            $this->mailQueue->send($mail->id);
        }
    }

    public function creating(Payment $payment): void
    {

        if (!$payment->paid_at)
        {
            $payment->paid_at = date('Y-m-d');
        }
    }

    public function updated(Payment $payment): void
    {
        event(new InvoiceModified($payment->invoice));
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

    public function restoring(Payment $payment): void
    {
       foreach ($payment->mailQueue as $mailQueue) {
            $mailQueue->onlyTrashed()->restore();
        }

        foreach ($payment->notes as $note) {
            $note->onlyTrashed()->restore();
        }
    }

}
