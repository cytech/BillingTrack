<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'clients';

    /**
     * Run the migrations.
     * @table clients
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
            $table->text('address')->nullable()->default(null);
            $table->string('city')->nullable()->default(null);
            $table->string('state')->nullable()->default(null);
            $table->string('zip')->nullable()->default(null);
            $table->string('country')->nullable()->default(null);
            $table->string('phone')->nullable()->default(null);
            $table->string('fax')->nullable()->default(null);
            $table->string('mobile')->nullable()->default(null);
            $table->string('email')->nullable()->default(null);
            $table->string('web')->nullable()->default(null);
            $table->string('url_key');
            $table->tinyInteger('active')->default('1');
            $table->string('currency_code')->nullable()->default(null);
            $table->string('unique_name')->nullable()->default(null);
            $table->string('language')->nullable()->default(null);

            $table->index(["unique_name"], 'clients_unique_name_index');

            $table->index(["active"], 'clients_active_index');

            $table->index(["name"], 'clients_name_index');
            $table->softDeletes();
            $table->nullableTimestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {
       Schema::dropIfExists($this->set_schema_table);
     }
}
