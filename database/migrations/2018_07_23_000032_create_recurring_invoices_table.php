<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecurringInvoicesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'recurring_invoices';

    /**
     * Run the migrations.
     * @table recurring_invoices
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedInteger('client_id');
            $table->unsignedInteger('group_id')->nullable();
            $table->unsignedInteger('company_profile_id')->nullable();
            $table->text('terms')->nullable()->default(null);
            $table->text('footer')->nullable()->default(null);
            $table->string('currency_code');
            $table->decimal('exchange_rate', 10, 7);
            $table->string('template');
            $table->string('summary')->nullable()->default(null);
            $table->decimal('discount', 15, 2)->default('0.00');
            $table->integer('recurring_frequency');
            $table->integer('recurring_period');
            $table->date('next_date');
            $table->date('stop_date');

            $table->index(["client_id"], 'recurring_invoices_client_id_index');

            $table->index(["group_id"], 'fk_recurring_invoices_groups1_idx');

            $table->index(["company_profile_id"], 'recurring_invoices_company_profile_id_index');

            $table->index(["user_id"], 'recurring_invoices_user_id_index');
            $table->softDeletes();
            $table->nullableTimestamps();


            $table->foreign('client_id', 'recurring_invoices_client_id_index')
                ->references('id')->on('clients')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('company_profile_id', 'recurring_invoices_company_profile_id_index')
                ->references('id')->on('company_profiles')
                ->onDelete('set null')
                ->onUpdate('cascade');

            $table->foreign('group_id', 'fk_recurring_invoices_groups1_idx')
                ->references('id')->on('groups')
                ->onDelete('set null')
                ->onUpdate('cascade');

            $table->foreign('user_id', 'recurring_invoices_user_id_index')
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
