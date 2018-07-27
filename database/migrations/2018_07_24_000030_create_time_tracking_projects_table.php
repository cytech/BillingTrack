<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimeTrackingProjectsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'time_tracking_projects';

    /**
     * Run the migrations.
     * @table time_tracking_projects
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('company_profile_id')->nullable();
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedInteger('client_id')->nullable();
            $table->string('name');
            $table->timestamp('due_at')->nullable()->default(null);
            $table->decimal('hourly_rate', 8, 2);
            $table->integer('status_id');

            $table->index(["user_id"], 'time_tracking_projects_user_id_index');

            $table->index(["company_profile_id"], 'time_tracking_projects_company_profile_id_index');

            $table->index(["client_id"], 'time_tracking_projects_client_id_index');
            $table->softDeletes();
            $table->nullableTimestamps();


            $table->foreign('client_id', 'time_tracking_projects_client_id_index')
                ->references('id')->on('clients')
                ->onDelete('set null')
                ->onUpdate('cascade');

            $table->foreign('company_profile_id', 'time_tracking_projects_company_profile_id_index')
                ->references('id')->on('company_profiles')
                ->onDelete('set null')
                ->onUpdate('cascade');

            $table->foreign('user_id', 'time_tracking_projects_user_id_index')
                ->references('id')->on('users')
                ->onDelete('set null')
                ->onUpdate('cascade');
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
