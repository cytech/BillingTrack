<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuotesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'quotes';

    /**
     * Run the migrations.
     * @table quotes
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->date('quote_date');
            $table->unsignedInteger('workorder_id')->default('0');
            $table->unsignedInteger('invoice_id')->default('0');
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedInteger('client_id');
            $table->unsignedInteger('group_id')->nullable();
            $table->integer('quote_status_id');
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
            $table->unsignedInteger('company_profile_id')->nullable();

            $table->index(["user_id"], 'quotes_user_id_index');

            $table->index(["group_id"], 'quotes_invoice_group_id_index');

            $table->index(["number"], 'quotes_number_index');

            $table->index(["company_profile_id"], 'quotes_company_profile_id_index');

            $table->index(["client_id"], 'quotes_client_id_index');
            $table->softDeletes();
            $table->nullableTimestamps();


            $table->foreign('client_id', 'quotes_client_id_index')
                ->references('id')->on('clients')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('company_profile_id', 'quotes_company_profile_id_index')
                ->references('id')->on('company_profiles')
                ->onDelete('set null')
                ->onUpdate('cascade');

            $table->foreign('group_id', 'quotes_invoice_group_id_index')
                ->references('id')->on('groups')
                ->onDelete('set null')
                ->onUpdate('cascade');

            $table->foreign('user_id', 'quotes_user_id_index')
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
