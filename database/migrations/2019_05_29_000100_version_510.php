<?php

use BT\Modules\Settings\Models\Setting;
use BT\Modules\Clients\Models\Contact;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class Version510 extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'clients';

    /**
     * Run the migrations.
     * @table payments_custom
     *
     * @return void
     */
    public function up()
    {
        Schema::create('industries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255);
        });

        Schema::create('sizes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255);
        });

        Schema::create('titles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255);
        });

        Schema::create('payment_terms', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('num_days');
            $table->string('name', 255);
        });


        //seed industries, sizes, titles and paymentterms
        Artisan::call('db:seed', [
            '--class' => IndustrySeeder::class
        ]);
        Artisan::call('db:seed', [
            '--class' => SizeSeeder::class
        ]);
        Artisan::call('db:seed', [
            '--class' => TitleSeeder::class
        ]);
        Artisan::call('db:seed', [
            '--class' => PaymentTermsSeeder::class
        ]);

        //add more client fields
        Schema::table($this->set_schema_table, function ($table) {
            $table->text('address_2')->nullable()->default(null)->after('country');
            $table->string('city_2')->nullable()->default(null)->after('address_2');
            $table->string('state_2')->nullable()->default(null)->after('city_2');
            $table->string('zip_2')->nullable()->default(null)->after('state_2');
            $table->string('country_2')->nullable()->default(null)->after('zip_2');
            $table->string('id_number')->nullable()->default(null)->after('language');
            $table->string('vat_number')->nullable()->default(null)->after('id_number');
            $table->tinyInteger('is_company')->default(0)->after('active');
            $table->unsignedInteger('industry_id')->nullable()->default(1)->after('vat_number');
            $table->unsignedInteger('size_id')->nullable()->default(1)->after('industry_id');
            $table->unsignedInteger('paymentterm_id')->nullable()->default(1)->after('size_id');

            $table->foreign('industry_id')->references('id')->on('industries')->onDelete('no action')->onUpdate('no action');
            $table->foreign('size_id')->references('id')->on('sizes')->onDelete('no action')->onUpdate('no action');
            $table->foreign('paymentterm_id')->references('id')->on('payment_terms')->onDelete('no action')->onUpdate('no action');


        });

        //add more contact fields
        Schema::table('contacts', function ($table) {
            $table->string('first_name')->after('client_id');
            $table->string('last_name')->after('first_name');
            $table->string('phone')->nullable()->default(null)->after('email');
            $table->string('fax')->nullable()->default(null)->after('phone');
            $table->string('mobile')->nullable()->default(null)->after('fax');
            $table->tinyInteger('is_primary')->default(0)->after('default_bcc');
            $table->tinyInteger('optin')->default(1)->after('is_primary');
            $table->unsignedInteger('title_id')->nullable()->default(1)->after('mobile');

            $table->foreign('title_id')->references('id')->on('titles')->onDelete('no action')->onUpdate('no action');

        });

        //split existing contact name into first and last
        $contacts = Contact::all();
        foreach ($contacts as $contact) {
            $splitName = explode(' ', $contact->name);
            $contact->first_name = array_shift($splitName);
            $contact->last_name = implode(" ", $splitName);
            $contact->save();
            }


        deleteTempFiles();
        deleteViewCache();

        Setting::saveByKey('version', '5.1.0');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();

        Schema::drop('industries');
        Schema::drop('sizes');
        Schema::drop('titles');
        Schema::drop('payment_terms');

        Schema::table('clients', function($table) {
            $table->dropColumn('address_2');
            $table->dropColumn('city_2');
            $table->dropColumn('state_2');
            $table->dropColumn('zip_2');
            $table->dropColumn('country_2');
            $table->dropColumn('id_number');
            $table->dropColumn('vat_number');
            $table->dropColumn('is_company');
            $table->dropForeign('clients_industry_id_foreign');
            $table->dropForeign('clients_size_id_foreign');
            $table->dropForeign('clients_paymentterm_id_foreign');
            $table->dropColumn('industry_id');
            $table->dropColumn('size_id');
            $table->dropColumn('paymentterm_id');

        });

        Schema::table('contacts', function($table) {
            $table->dropColumn('first_name');
            $table->dropColumn('last_name');
            $table->dropColumn('phone');
            $table->dropColumn('fax');
            $table->dropColumn('mobile');
            $table->dropColumn('is_primary');
            $table->dropColumn('optin');
            $table->dropForeign('contacts_title_id_foreign');
            $table->dropColumn('title_id');


        });

        Schema::enableForeignKeyConstraints();

    }
}
