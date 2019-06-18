<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseorderTransactionsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'purchaseorder_transactions';

    /**
     * Run the migrations.
     * @table purchaseorder_transactions
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
            $table->tinyInteger('is_successful');
            $table->string('transaction_reference')->nullable()->default(null);

            $table->index(["purchaseorder_id"], 'fk_purchaseorder_transactions_purchaseorders1_idx');
            $table->softDeletes();
            $table->nullableTimestamps();


            $table->foreign('purchaseorder_id', 'fk_purchaseorder_transactions_purchaseorders1_idx')
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
