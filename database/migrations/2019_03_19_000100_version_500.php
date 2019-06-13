<?php

use BT\Modules\Settings\Models\Setting;
use Illuminate\Database\Migrations\Migration;

class Version500 extends Migration
{

    /**
     * Run the migrations.
     * @table payments_custom
     *
     * @return void
     */
    public function up()
    {
        deleteTempFiles();
        deleteViewCache();

        Setting::saveByKey('version', '5.0.0');

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
