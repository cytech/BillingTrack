<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use FI\Modules\Currencies\Models\Currency;

class SeedCurrenciesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'currencies';


    /**
     * Run the migrations.
     */
    public function up()
    {
        if (count(Currency::all())){ return; }

        DB::statement('INSERT INTO `$this->set_schema_table` VALUES (1,\'AUD\',\'Australian Dollar\',\'$\',\'before\',\'.\',\',\',NULL,NULL,NULL)
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
