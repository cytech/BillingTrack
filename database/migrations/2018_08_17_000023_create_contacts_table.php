<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'contacts';

    /**
     * Run the migrations.
     * @table contacts
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('client_id');
            $table->string('name');
            $table->string('email');
            $table->tinyInteger('default_to')->default(0);
            $table->tinyInteger('default_cc')->default(0);
            $table->tinyInteger('default_bcc')->default(0);

            $table->index(["client_id"], 'contacts_client_id_index');
            $table->softDeletes();
            $table->nullableTimestamps();


            $table->foreign('client_id', 'contacts_client_id_index')
                ->references('id')->on('clients')
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
