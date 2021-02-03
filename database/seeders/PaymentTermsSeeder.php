<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use BT\Modules\PaymentTerms\Models\PaymentTerm;
use Eloquent;

class PaymentTermsSeeder extends Seeder
{
    public function run()
    {
        Eloquent::unguard();

        $paymentterms = [
            ['num_days' => 0, 'name' => ''],
            ['num_days' => 0, 'name' => 'COD'],
            ['num_days' => 0, 'name' => 'Due On Receipt'],
            ['num_days' => 7, 'name' => 'Net 7'],
            ['num_days' => 10, 'name' => 'Net 10'],
            ['num_days' => 15, 'name' => 'Net 15'],
            ['num_days' => 30, 'name' => 'Net 30'],
            ['num_days' => 60, 'name' => 'Net 60'],
            ['num_days' => 90, 'name' => 'Net 90'],
        ];

        foreach ($paymentterms as $paymentterm) {
            $record = PaymentTerm::whereName($paymentterm['name'])->first();
            if (! $record) {
                PaymentTerm::create($paymentterm);
            }
        }

        Eloquent::reguard();
    }
}
