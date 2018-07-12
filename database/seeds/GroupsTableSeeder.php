<?php

use Illuminate\Database\Seeder;
use FI\Modules\Groups\Models\Group;

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

        DB::statement('INSERT INTO groups VALUES (1,\'Invoice Default\',1,0,\'INV{NUMBER}\',0,0,0,0,0,\'\',NULL,NULL,NULL)
            ,(2,\'Quote Default\',1,0,\'QUO{NUMBER}\',0,0,0,0,0,\'\',NULL,NULL,NULL)');
    }
}
