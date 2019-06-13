<?php

use BT\Modules\Settings\Models\Setting;
use Illuminate\Database\Migrations\Migration;

class Version411 extends Migration
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

        Setting::saveByKey('convertWorkorderDate', 'jobdate');
        Setting::saveByKey('version', '4.1.1');

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
