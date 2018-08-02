<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimeTrackingTasksTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'time_tracking_tasks';

    /**
     * Run the migrations.
     * @table time_tracking_tasks
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('time_tracking_project_id');
            $table->string('name');
            $table->tinyInteger('display_order');
            $table->tinyInteger('billed')->default('0');
            $table->unsignedInteger('invoice_id')->nullable()->default(null);

            $table->index(["time_tracking_project_id"], 'time_tracking_tasks_time_tracking_project_id_index');

            $table->index(["invoice_id"], 'time_tracking_tasks_invoice_id_index');
            $table->softDeletes();
            $table->nullableTimestamps();


            $table->foreign('invoice_id', 'time_tracking_tasks_invoice_id_index')
                ->references('id')->on('invoices')
                ->onDelete('set null')
                ->onUpdate('restrict');

            $table->foreign('time_tracking_project_id', 'time_tracking_tasks_time_tracking_project_id_index')
                ->references('id')->on('time_tracking_projects')
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
