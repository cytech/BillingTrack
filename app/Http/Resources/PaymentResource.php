<?php

namespace BT\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'paid_at' => $this->paid_at,
            'invoice_number' => $this->invoice->number,
            'invoice_date' => $this->invoice->formatted_invoice_date,
            'client_name' => $this->invoice->client->name,
            'test' => 'This is a test line',
            'invoice_summary' => $this->invoice->summary,
            'amount' => $this->formatted_amount,
            'payment_method' => $this->paymentMethod->name,
            'note' => $this->note,
        ];
        //return parent::toArray($request);
    }
}
