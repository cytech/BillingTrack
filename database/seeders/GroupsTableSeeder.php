<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use BT\Modules\Groups\Models\Group;
use DB;

class GroupsTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (count(Group::all())){ return; }

        DB::table('groups')->insert(['id' => 1,'name' => 'Invoice Default', 'next_id' => 1, 'left_pad' => 0, 'format' => 'INV{NUMBER}', 'last_id' => 0, 'last_year' => 0, 'last_month' => 0, 'last_week' => 0, 'last_number' => 0]);
        DB::table('groups')->insert(['id' => 2,'name' => 'Quote Default', 'next_id' => 1, 'left_pad' => 0, 'format' => 'QUO{NUMBER}', 'last_id' => 0, 'last_year' => 0, 'last_month' => 0, 'last_week' => 0, 'last_number' => 0]);
        DB::table('groups')->insert(['id' => 3,'name' => 'Workorder Default', 'next_id' => 1, 'left_pad' => 0, 'format' => 'WO{NUMBER}', 'last_id' => 0, 'last_year' => 0, 'last_month' => 0, 'last_week' => 0, 'last_number' => 0]);

    }
}
