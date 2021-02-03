<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use BT\Modules\PaymentMethods\Models\PaymentMethod;
use DB;

class PaymentMethodsTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (count(PaymentMethod::all())){ return; }

        DB::table('payment_methods')->insert(['id' => 1,'name' => 'Cash']);
        DB::table('payment_methods')->insert(['id' => 2,'name' => 'Check']);
        DB::table('payment_methods')->insert(['id' => 3,'name' => 'Credit Card']);
        DB::table('payment_methods')->insert(['id' => 4,'name' => 'Online Payment']);

    }
}
