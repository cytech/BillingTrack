<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkordersTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'workorders';

    /**
     * Run the migrations.
     * @table workorders
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->date('workorder_date');
            $table->integer('invoice_id')->default('0');
            $table->integer('user_id');
            $table->integer('client_id');
            $table->integer('group_id');
            $table->integer('workorder_status_id');
            $table->date('expires_at');
            $table->string('number');
            $table->text('footer')->nullable()->default(null);
            $table->string('url_key');
            $table->string('currency_code')->nullable()->default(null);
            $table->decimal('exchange_rate', 10, 7)->default('1.0000000');
            $table->text('terms')->nullable()->default(null);
            $table->string('template')->nullable()->default(null);
            $table->string('summary')->nullable()->default(null);
            $table->tinyInteger('viewed')->default('0');
            $table->decimal('discount', 15, 2)->default('0.00');
            $table->date('job_date');
            $table->time('start_time');
            $table->time('end_time');
            $table->tinyInteger('will_call')->default('0');
            $table->integer('company_profile_id');

            $table->index(["group_id"], 'workorders_group_id_index');

            $table->index(["company_profile_id"], 'workorders_company_profile_id_index');

            $table->index(["number"], 'workorders_number_index');

            $table->index(["user_id"], 'workorders_user_id_index');

            $table->index(["client_id"], 'workorders_client_id_index');
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
