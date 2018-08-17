<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScheduleOccurrencesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'schedule_occurrences';

    /**
     * Run the migrations.
     * @table schedule_occurrences
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('oid');
            $table->unsignedInteger('schedule_id');
            $table->dateTime('start_date')->nullable()->default(null);
            $table->dateTime('end_date')->nullable()->default(null);

            $table->index(["schedule_id"], 'schedule_occurrence_event_id_foreign');
            $table->softDeletes();
            $table->nullableTimestamps();


            $table->foreign('schedule_id', 'schedule_occurrence_event_id_foreign')
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
