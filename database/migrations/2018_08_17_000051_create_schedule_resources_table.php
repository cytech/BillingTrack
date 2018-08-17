<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScheduleResourcesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'schedule_resources';

    /**
     * Run the migrations.
     * @table schedule_resources
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('schedule_id');
            $table->string('resource_table', 45)->nullable()->default(null);
            $table->integer('resource_id')->nullable()->default(null);
            $table->string('value')->nullable()->default(null);
            $table->integer('qty')->nullable()->default(null);

            $table->index(["schedule_id"], 'schedule_resource_schedule_id_foreign');
            $table->softDeletes();
            $table->nullableTimestamps();


            $table->foreign('schedule_id', 'schedule_resource_schedule_id_foreign')
                ->references('id')->on('schedule')
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
