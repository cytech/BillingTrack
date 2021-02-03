<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use BT\Modules\Currencies\Models\Currency;
use DB;


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

        DB::table('currencies')->insert(['id' => 1,'code' => 'AUD', 'name' => 'Australian Dollar', 'symbol' => '$', 'placement' => 'before', 'decimal' => '.', 'thousands' => ',' ]);
        DB::table('currencies')->insert(['id' => 2,'code' => 'CAD', 'name' => 'Canadian Dollar', 'symbol' => '$', 'placement' => 'before', 'decimal' => '.', 'thousands' => ',' ]);
        DB::table('currencies')->insert(['id' => 3,'code' => 'EUR', 'name' => 'Euro', 'symbol' => '€', 'placement' => 'before', 'decimal' => '.', 'thousands' => ',' ]);
        DB::table('currencies')->insert(['id' => 4,'code' => 'GBP', 'name' => 'Pound Sterling', 'symbol' => '£', 'placement' => 'before', 'decimal' => '.', 'thousands' => ',' ]);
        DB::table('currencies')->insert(['id' => 5,'code' => 'USD', 'name' => 'US Dollar', 'symbol' => '$', 'placement' => 'before', 'decimal' => '.', 'thousands' => ',' ]);


    }
}
