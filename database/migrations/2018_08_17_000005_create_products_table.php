<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'products';

    /**
     * Run the migrations.
     * @table products
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name', 85);
            $table->text('description')->nullable()->default(null);
            $table->decimal('price', 7, 2)->nullable()->default(null);
            $table->unsignedInteger('tax_rate_id')->nullable()->default(null);
            $table->unsignedInteger('tax_rate_2_id')->nullable()->default(null);
            $table->string('serialnum', 85)->nullable()->default(null);
            $table->tinyInteger('active')->default('1');
            $table->unsignedInteger('vendor_id')->nullable()->default(null);
            $table->decimal('cost', 7, 2)->nullable()->default(null);
            $table->string('category', 20)->nullable()->default(null);
            $table->string('type', 20)->nullable()->default(null);
            $table->unsignedTinyInteger('numstock')->nullable()->default(null);
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
