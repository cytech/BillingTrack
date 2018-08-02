<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimeTrackingTimersTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'time_tracking_timers';

    /**
     * Run the migrations.
     * @table time_tracking_timers
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('time_tracking_task_id');
            $table->timestamp('start_at')->nullable()->default(null);
            $table->timestamp('end_at')->nullable()->default(null);
            $table->decimal('hours', 8, 2)->default('0');

            $table->index(["time_tracking_task_id"], 'time_tracking_timers_time_tracking_task_id_index');
            $table->softDeletes();
            $table->nullableTimestamps();


            $table->foreign('time_tracking_task_id', 'time_tracking_timers_time_tracking_task_id_index')
                ->references('id')->on('time_tracking_tasks')
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
