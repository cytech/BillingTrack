<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecurringInvoiceAmountsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'recurring_invoice_amounts';

    /**
     * Run the migrations.
     * @table recurring_invoice_amounts
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
            $table->decimal('subtotal', 20, 4);
            $table->decimal('discount', 20, 4);
            $table->decimal('tax', 20, 4);
            $table->decimal('total', 20, 4);

            $table->index(["recurring_invoice_id"], 'recurring_invoice_amounts_recurring_invoice_id_index');
            $table->softDeletes();
            $table->nullableTimestamps();


            $table->foreign('recurring_invoice_id', 'recurring_invoice_amounts_recurring_invoice_id_index')
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
