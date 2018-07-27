<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMerchantPaymentsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'merchant_payments';

    /**
     * Run the migrations.
     * @table merchant_payments
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
            $table->unsignedInteger('payment_id');
            $table->string('merchant_key');
            $table->string('merchant_value');

            $table->index(["merchant_key"], 'merchant_payments_merchant_key_index');

            $table->index(["payment_id"], 'merchant_payments_payment_id_index');

            $table->index(["driver"], 'merchant_payments_driver_index');
            $table->softDeletes();
            $table->nullableTimestamps();


            $table->foreign('payment_id', 'merchant_payments_payment_id_index')
                ->references('id')->on('payments')
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
