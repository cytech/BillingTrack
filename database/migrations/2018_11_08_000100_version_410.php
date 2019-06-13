<?php

use BT\Modules\Settings\Models\Setting;
use Illuminate\Database\Migrations\Migration;

class Version410 extends Migration
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

        Setting::saveByKey('jquiTheme', 'cupertino');
        Setting::saveByKey('resultsPerPage', 10);
        Setting::saveByKey('enabledModules', '63');
        Setting::saveByKey('skin','{"headBackground":"purple","headClass":"dark","sidebarBackground":"white","sidebarClass":"light"}');
        Setting::saveByKey('version', '4.1.0');

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
