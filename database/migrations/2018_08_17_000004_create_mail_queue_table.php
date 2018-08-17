<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMailQueueTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'mail_queue';

    /**
     * Run the migrations.
     * @table mail_queue
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('mailable_id');
            $table->string('mailable_type');
            $table->string('from');
            $table->string('to');
            $table->string('cc');
            $table->string('bcc');
            $table->string('subject');
            $table->longText('body');
            $table->tinyInteger('attach_pdf');
            $table->tinyInteger('sent')->default('0');
            $table->text('error')->nullable()->default(null);
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
