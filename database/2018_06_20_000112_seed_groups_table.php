<?php

use FI\Modules\Groups\Models\Group;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedGroupsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'groups';


    /**
     * Run the migrations.
     */
    public function up()
    {
        if (count(Group::all())){ return; }

        DB::statement('INSERT INTO `$this->set_schema_table` VALUES (1,\'Invoice Default\',1,0,\'INV{NUMBER}\',0,0,0,0,0,\'\',NULL,NULL,NULL)
            ,(2,\'Quote Default\',1,0,\'QUO{NUMBER}\',0,0,0,0,0,\'\',NULL,NULL,NULL)');

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
