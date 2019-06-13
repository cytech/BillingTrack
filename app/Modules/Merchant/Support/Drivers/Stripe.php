<?php

namespace BT\Modules\Merchant\Support\Drivers;

use BT\Modules\Invoices\Models\Invoice;
use BT\Modules\Merchant\Models\MerchantClient;
use BT\Modules\Merchant\Models\MerchantPayment;
use BT\Modules\Merchant\Support\MerchantDriver;
use BT\Modules\Payments\Models\Payment;
use Stripe\Charge;
use Stripe\Customer;

class Stripe extends MerchantDriver
{
    protected $isRedirect = false;

    public function getSettings()
    {
        return ['publishableKey', 'secretKey'];
    }

    public function verify(Invoice $invoice)
    {
        \Stripe\Stripe::setApiKey($this->getSetting('secretKey'));

        $clientMerchantId = MerchantClient::getByKey($this->getName(), $invoice->client_id, 'id');

        if ($clientMerchantId)
        {
            try
            {
                $customer = Customer::retrieve($clientMerchantId);
            }
            catch (\Exception $e)
            {
                // Don't need to do anything here.
            }
        }

        if (!isset($customer) or $customer->deleted)
        {
            $customer = $this->createCustomer($invoice, request('token'));
        }
        else
        {
            $customer->source = request('token');
            $customer->save();
        }

        try
        {
            $charge = Charge::create([
                'customer'    => $customer->id,
                'amount'      => $invoice->amount->balance * 100,
                'currency'    => $invoice->currency_code,
                'description' => trans('bt.invoice') . ' #' . $invoice->number,
            ]);

            $payment = Payment::create([
                'client_id'         => $invoice->client->id,
                'invoice_id'        => $invoice->id,
                'amount'            => $charge->amount / 100,
                'payment_method_id' => config('bt.onlinePaymentMethod'),
            ]);

            MerchantPayment::saveByKey($this->getName(), $payment->id, 'id', $charge->id);

            return true;
        }
        catch (\Exception $e)
        {
            return false;
        }
    }

    private function createCustomer($invoice, $source)
    {
        $customer = Customer::create([
            'description' => $invoice->client->name,
            'email'       => $invoice->client->email,
            'source'      => $source,
        ]);

        MerchantClient::saveByKey($this->getName(), $invoice->client_id, 'id', $customer->id);

        return $customer;
    }
}
