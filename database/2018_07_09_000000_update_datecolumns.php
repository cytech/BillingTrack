<?php

use FI\Modules\Settings\Models\Setting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateDatecolumns extends Migration
{

    /**
     * get current database name
     *
     */
    public function __construct() {
        $this->db_name = DB::getDatabaseName();
    }

    /**
     * Run the migrations.
     */
    public function up()
    {
        $version = Setting::where('setting_key', 'version')->first();

        if ($version->setting_value == '4.0.0'){ return;}

        $tables = DB::select("SELECT TABLE_NAME FROM information_schema.TABLES 
                            WHERE TABLE_SCHEMA = :db ",['db' => $this->db_name]);

        foreach (array_pluck($tables, 'TABLE_NAME') as $table){
            if ($table == 'migrations'){continue;}

            $set_last_column = DB::select("SELECT COLUMN_NAME, ORDINAL_POSITION FROM information_schema.COLUMNS 
                            WHERE TABLE_SCHEMA = :db AND TABLE_NAME = :tname
                            ORDER BY ORDINAL_POSITION DESC LIMIT 1",['db' => $this->db_name, 'tname' => $table]);

            $last_column = $set_last_column[0]->COLUMN_NAME;

            if ($last_column != 'updated_at') {
                DB::statement("ALTER TABLE `$table` CHANGE COLUMN updated_at updated_at TIMESTAMP NULL DEFAULT NULL AFTER `$last_column`");
                DB::statement("ALTER TABLE `$table` CHANGE COLUMN created_at created_at TIMESTAMP NULL DEFAULT NULL AFTER `$last_column`");
            }
            if ($last_column != 'deleted_at') {
                DB::statement("ALTER TABLE `$table` ADD COLUMN deleted_at TIMESTAMP NULL DEFAULT NULL AFTER updated_at");
            }
        }

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
