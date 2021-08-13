<?php

use BT\Modules\Settings\Models\Setting;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class Version532 extends Migration
{

    /**
     * Run the migrations.
     * @table payments_custom
     *
     * @return void
     */
    public function up()
    {
        Schema::table('workorders', function (Blueprint $table) {
            $table->integer('invoice_id')->unsigned()->default('0')->change();
        });

        Setting::saveByKey('version', '5.3.2');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {
         Schema::table('quotes', function (Blueprint $table) {
             $table->integer('invoice_id')->default('0')->change();
         });

         Setting::saveByKey('version', '5.3.1');
     }
}
