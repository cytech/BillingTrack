<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuoteItemsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'quote_items';

    /**
     * Run the migrations.
     * @table quote_items
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('quote_id');
            $table->unsignedInteger('tax_rate_id');
            $table->unsignedInteger('tax_rate_2_id')->default('0');
            $table->string('resource_table')->nullable()->default(null);
            $table->unsignedInteger('resource_id')->nullable()->default(null);
            $table->string('name');
            $table->text('description');
            $table->decimal('quantity', 20, 4)->default('0.0000');
            $table->integer('display_order');
            $table->decimal('price', 20, 4)->default('0.0000');

            $table->index(["quote_id"], 'quote_items_quote_id_index');

            $table->index(["display_order"], 'quote_items_display_order_index');
            $table->softDeletes();
            $table->nullableTimestamps();


            $table->foreign('quote_id', 'quote_items_quote_id_index')
                ->references('id')->on('quotes')
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
