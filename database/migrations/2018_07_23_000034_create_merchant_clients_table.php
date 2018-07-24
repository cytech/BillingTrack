<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMerchantClientsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'merchant_clients';

    /**
     * Run the migrations.
     * @table merchant_clients
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('driver');
            $table->unsignedInteger('client_id');
            $table->string('merchant_key');
            $table->string('merchant_value');

            $table->index(["merchant_key"], 'merchant_clients_merchant_key_index');

            $table->index(["client_id"], 'merchant_clients_client_id_index');

            $table->index(["driver"], 'merchant_clients_driver_index');
            $table->softDeletes();
            $table->nullableTimestamps();


            $table->foreign('client_id', 'merchant_clients_client_id_index')
                ->references('id')->on('clients')
                ->onDelete('cascade')
                ->onUpdate('restrict');
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
