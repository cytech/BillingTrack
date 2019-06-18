<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseordersTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'purchaseorders';

    /**
     * Run the migrations.
     * @table purchaseorders
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->date('purchaseorder_date');
            $table->integer('purchaseorder_id_ref')->nullable()->default(null);
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedInteger('vendor_id');
            $table->unsignedInteger('group_id')->nullable();
            $table->tinyInteger('purchaseorder_type_id')->default('1');
            $table->integer('purchaseorder_status_id');
            $table->date('due_at');
            $table->string('number');
            $table->text('terms')->nullable()->default(null);
            $table->text('footer')->nullable()->default(null);
            $table->string('url_key');
            $table->string('currency_code')->nullable()->default(null);
            $table->decimal('exchange_rate', 10, 7)->default('1.0000000');
            $table->string('template')->nullable()->default(null);
            $table->string('summary')->nullable()->default(null);
            $table->tinyInteger('viewed')->default('0');
            $table->decimal('discount', 15, 2)->default('0.00');
            $table->unsignedInteger('company_profile_id')->nullable();

            $table->index(["user_id"], 'purchaseorders_user_id_index');

            $table->index(["group_id"], 'purchaseorders_purchaseorder_group_id_index');

            $table->index(["vendor_id"], 'purchaseorders_vendor_id_index');

            $table->index(["company_profile_id"], 'purchaseorders_company_profile_id_index');

            $table->index(["purchaseorder_status_id"], 'purchaseorders_purchaseorder_status_id_index');
            $table->softDeletes();
            $table->nullableTimestamps();


            $table->foreign('vendor_id', 'purchaseorders_vendor_id_index')
                ->references('id')->on('vendors')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('company_profile_id', 'purchaseorders_company_profile_id_index')
                ->references('id')->on('company_profiles')
                ->onDelete('set null')
                ->onUpdate('cascade');

            $table->foreign('group_id', 'purchaseorders_purchaseorder_group_id_index')
                ->references('id')->on('groups')
                ->onDelete('set null')
                ->onUpdate('cascade');

            $table->foreign('user_id', 'purchaseorders_user_id_index')
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
