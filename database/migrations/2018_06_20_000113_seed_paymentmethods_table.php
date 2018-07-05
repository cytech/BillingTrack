<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedPaymentmethodsTable extends Migration
{

    /**
     * Run the migrations.
     */
    public function up()
    {

        DB::statement('INSERT INTO `payment_methods` VALUES (1,\'Cash\',NULL,NULL,NULL)
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
