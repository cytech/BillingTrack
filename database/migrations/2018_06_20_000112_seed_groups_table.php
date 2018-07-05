<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedGroupsTable extends Migration
{

    /**
     * Run the migrations.
     */
    public function up()
    {

        DB::statement('INSERT INTO `groups` VALUES (1,\'Invoice Default\',1,0,\'INV{NUMBER}\',0,0,0,0,0,\'\',NULL,NULL,NULL)
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
