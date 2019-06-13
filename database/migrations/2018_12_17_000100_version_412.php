<?php

use BT\Modules\Settings\Models\Setting;
use Illuminate\Database\Migrations\Migration;

class Version412 extends Migration
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

        Setting::saveByKey('version', '4.1.2');

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
