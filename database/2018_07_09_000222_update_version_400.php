<?php

use FI\Modules\Settings\Models\Setting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateVersion400 extends Migration
{


    /**
     * Run the migrations.
     */
    public function up()
    {
        $version = Setting::where('setting_key', 'version')->first();

        if ($version->setting_value == '4.0.0'){ return;}

        deleteTempFiles();
        deleteViewCache();

        Schema::disableForeignKeyConstraints();

        Schema::table('invoices', function (Blueprint $table){
            $table->integer('invoice_id_ref')->nullable()->default(null)->after('group_id');
            $table->tinyInteger('invoice_type_id')->default('1')->after('invoice_date');
        });

        Setting::saveByKey('version', '4.0.0');


        Schema::enableForeignKeyConstraints();

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
