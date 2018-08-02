<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecurringInvoiceItemsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'recurring_invoice_items';

    /**
     * Run the migrations.
     * @table recurring_invoice_items
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('recurring_invoice_id');
            $table->unsignedInteger('tax_rate_id')->default('0');
            $table->unsignedInteger('tax_rate_2_id')->default('0');
            $table->string('resource_table')->nullable()->default(null);
            $table->unsignedInteger('resource_id')->nullable()->default(null);
            $table->string('name');
            $table->text('description');
            $table->decimal('quantity', 20, 4);
            $table->integer('display_order')->default('0');
            $table->decimal('price', 20, 4);

            $table->index(["display_order"], 'recurring_invoice_items_display_order_index');

            $table->index(["recurring_invoice_id"], 'recurring_invoice_items_recurring_invoice_id_index');
            $table->softDeletes();
            $table->nullableTimestamps();


            $table->foreign('recurring_invoice_id', 'recurring_invoice_items_recurring_invoice_id_index')
                ->references('id')->on('recurring_invoices')
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
