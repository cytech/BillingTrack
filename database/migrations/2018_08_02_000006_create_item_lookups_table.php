<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemLookupsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'item_lookups';

    /**
     * Run the migrations.
     * @table item_lookups
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
            $table->text('description');
            $table->decimal('price', 20, 4)->default('0.0000');
            $table->integer('tax_rate_id')->default('0');
            $table->integer('tax_rate_2_id')->default('0');
            $table->string('resource_table')->nullable()->default(null);
            $table->unsignedInteger('resource_id')->nullable()->default(null);

            $table->index(["tax_rate_id"], 'item_lookups_tax_rate_id_index');

            $table->index(["tax_rate_2_id"], 'item_lookups_tax_rate_2_id_index');
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
