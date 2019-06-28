<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseorderItemsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'purchaseorder_items';

    /**
     * Run the migrations.
     * @table purchaseorder_items
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
            $table->unsignedInteger('tax_rate_id');
            $table->unsignedInteger('tax_rate_2_id')->default('0');
            $table->string('resource_table')->nullable()->default(null);
            $table->unsignedInteger('resource_id')->nullable()->default(null);
            $table->string('name');
            $table->text('description');
            $table->decimal('quantity', 20, 4)->default('0.0000');
            $table->decimal('cost', 20, 4)->default('0.0000');
            $table->decimal('rec_qty', 20, 4)->default('0.0000');
            $table->integer('rec_status_id');
            $table->integer('display_order')->default('0');

            $table->index(["display_order"], 'purchaseorder_items_display_order_index');

            $table->index(["purchaseorder_id"], 'purchaseorder_items_purchaseorder_id_index');
            $table->softDeletes();
            $table->nullableTimestamps();


            $table->foreign('purchaseorder_id', 'purchaseorder_items_purchaseorder_id_index')
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
