<?php

use Illuminate\Database\Seeder;
use FI\Modules\Currencies\Models\Currency;


class CurrenciesTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (count(Currency::all())){ return; }

        DB::statement('INSERT INTO currencies VALUES (1,\'AUD\',\'Australian Dollar\',\'$\',\'before\',\'.\',\',\',NULL,NULL,NULL)
            ,(2,\'CAD\',\'Canadian Dollar\',\'$\',\'before\',\'.\',\',\',NULL,NULL,NULL)
            ,(3,\'EUR\',\'Euro\',\'€\',\'before\',\'.\',\',\',NULL,NULL,NULL)
            ,(4,\'GBP\',\'Pound Sterling\',\'£\',\'before\',\'.\',\',\',NULL,NULL,NULL)
            ,(5,\'USD\',\'US Dollar\',\'$\',\'before\',\'.\',\',\',NULL,NULL,NULL)');
    }
}
