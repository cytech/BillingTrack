<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseorderAmountsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'purchaseorder_amounts';

    /**
     * Run the migrations.
     * @table purchaseorder_amounts
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('purchaseorder_id');
            $table->decimal('subtotal', 20, 4)->default('0.0000');
            $table->decimal('discount', 20, 4)->default('0.0000');
            $table->decimal('tax', 20, 4)->default('0.0000');
            $table->decimal('total', 20, 4)->default('0.0000');
            $table->decimal('paid', 20, 4)->default('0.0000');
            $table->decimal('balance', 20, 4)->default('0.0000');

            $table->index(["purchaseorder_id"], 'purchaseorder_amounts_purchaseorder_id_index');
            $table->softDeletes();
            $table->nullableTimestamps();


            $table->foreign('purchaseorder_id', 'purchaseorder_amounts_purchaseorder_id_index')
                ->references('id')->on('purchaseorders')
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
