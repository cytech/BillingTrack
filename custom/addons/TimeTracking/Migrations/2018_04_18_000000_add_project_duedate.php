<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddProjectDuedate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('time_tracking_projects' , function (Blueprint $table){
            $table->timestamp('due_at')->default('0000-00-00 00:00:00')->after('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('time_tracking_projects', function (Blueprint $table) {
            $table->dropColumn('due_at');
        });
    }
}
