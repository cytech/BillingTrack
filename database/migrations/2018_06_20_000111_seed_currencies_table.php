<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedCurrenciesTable extends Migration
{

    /**
     * Run the migrations.
     */
    public function up()
    {

        DB::statement('INSERT INTO `currencies` VALUES (1,\'AUD\',\'Australian Dollar\',\'$\',\'before\',\'.\',\',\',NULL,NULL,NULL)
            ,(2,\'CAD\',\'Canadian Dollar\',\'$\',\'before\',\'.\',\',\',NULL,NULL,NULL)
            ,(3,\'EUR\',\'Euro\',\'€\',\'before\',\'.\',\',\',NULL,NULL,NULL)
            ,(4,\'GBP\',\'Pound Sterling\',\'£\',\'before\',\'.\',\',\',NULL,NULL,NULL)
            ,(5,\'USD\',\'US Dollar\',\'$\',\'before\',\'.\',\',\',NULL,NULL,NULL)');

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
