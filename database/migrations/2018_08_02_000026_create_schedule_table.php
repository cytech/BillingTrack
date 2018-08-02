<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScheduleTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'schedule';

    /**
     * Run the migrations.
     * @table schedule
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('title', 150);
            $table->text('description')->nullable()->default(null);
            $table->unsignedTinyInteger('isRecurring')->default('0');
            $table->string('rrule')->nullable()->default(null);
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('category_id')->default('1');
            $table->string('url')->nullable()->default(null);
            $table->tinyInteger('will_call')->default('0');

            $table->index(["category_id"], 'fk_schedule_schedule_categories1_idx');

            $table->index(["user_id"], 'fk_schedule_users1_idx');
            $table->softDeletes();
            $table->nullableTimestamps();


            $table->foreign('category_id', 'fk_schedule_schedule_categories1_idx')
                ->references('id')->on('schedule_categories')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('user_id', 'fk_schedule_users1_idx')
                ->references('id')->on('users')
                ->onDelete('no action')
                ->onUpdate('no action');
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
