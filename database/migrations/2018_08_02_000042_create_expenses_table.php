<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpensesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'expenses';

    /**
     * Run the migrations.
     * @table expenses
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->date('expense_date');
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedInteger('category_id');
            $table->unsignedInteger('client_id')->default('0');
            $table->unsignedInteger('vendor_id')->default('0');
            $table->unsignedInteger('invoice_id')->nullable()->default(null);
            $table->string('description')->nullable()->default(null);
            $table->decimal('amount', 15, 2);
            $table->decimal('tax', 20, 4);
            $table->unsignedInteger('company_profile_id')->nullable();

            $table->index(["category_id"], 'expenses_category_id_index');

            $table->index(["invoice_id"], 'fk_expenses_invoices1_idx');

            $table->index(["company_profile_id"], 'expenses_company_profile_id_index');

            $table->index(["user_id"], 'fk_expenses_users1_idx');
            $table->softDeletes();
            $table->nullableTimestamps();


            $table->foreign('company_profile_id', 'expenses_company_profile_id_index')
                ->references('id')->on('company_profiles')
                ->onDelete('set null')
                ->onUpdate('cascade');

            $table->foreign('category_id', 'expenses_category_id_index')
                ->references('id')->on('expense_categories')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreign('user_id', 'fk_expenses_users1_idx')
                ->references('id')->on('users')
                ->onDelete('set null')
                ->onUpdate('cascade');

            $table->foreign('invoice_id', 'fk_expenses_invoices1_idx')
                ->references('id')->on('invoices')
                ->onDelete('set null')
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
