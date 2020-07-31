<?php

use Illuminate\Database\Seeder;
use BT\Modules\PaymentMethods\Models\PaymentMethod;

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

        DB::statement('INSERT INTO "payment_methods" VALUES (1,\'Cash\',NULL,NULL,NULL)
            ,(2,\'Check\',NULL,NULL,NULL)
            ,(3,\'Credit Card\',NULL,NULL,NULL)
            ,(4,\'Online Payment\',NULL,NULL,NULL)');
    }
}
