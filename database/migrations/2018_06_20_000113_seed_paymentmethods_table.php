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

        DB::statement('INSERT INTO `payment_methods` VALUES (1,\'Cash\',null,null)
            ,(2,\'Credit Card\',null,null),(3,\'Online Payment\',null,null)');

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
