<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScheduleRemindersTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'schedule_reminders';

    /**
     * Run the migrations.
     * @table schedule_reminders
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
            $table->timestamp('reminder_date')->nullable()->default(null);
            $table->text('reminder_location');
            $table->longText('reminder_text');

            $table->index(["schedule_id"], 'schedule_reminder_schedule_id_foreign');
            $table->softDeletes();
            $table->nullableTimestamps();


            $table->foreign('schedule_id', 'schedule_reminder_schedule_id_foreign')
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
