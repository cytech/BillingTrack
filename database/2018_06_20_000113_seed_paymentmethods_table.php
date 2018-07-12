<?php

use FI\Modules\PaymentMethods\Models\PaymentMethod;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedPaymentmethodsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'payment_methods';


    /**
     * Run the migrations.
     */
    public function up()
    {
        if (count(PaymentMethod::all())){ return; }

        DB::statement('INSERT INTO `$this->set_schema_table` VALUES (1,\'Cash\',NULL,NULL,NULL)
            ,(2,\'Credit Card\',NULL,NULL,NULL),(3,\'Online Payment\',NULL,NULL,NULL)');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
