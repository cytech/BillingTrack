<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call([
             SettingsTableSeeder::class,
             CurrenciesTableSeeder::class,
             GroupsTableSeeder::class,
             PaymentMethodsTableSeeder::class,
             ]);
    }
}
