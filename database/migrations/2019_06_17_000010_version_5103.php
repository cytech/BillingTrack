<?php

use BT\Modules\Settings\Models\Setting;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class Version5103 extends Migration
{

    /**
     * Run the migrations.
     * @table payments_custom
     *
     * @return void
     */
    public function up()
    {

        DB::table('groups')->insert(
            [
                'name'         => 'Purchaseorder Default',
                'next_id'      => 1,
                'left_pad'     => 0,
                'format'       => 'PO{NUMBER}',
                'reset_number' => 0
            ]
        );

        Schema::table('products' , function (Blueprint $table){
           $table->decimal( 'numstock', 20, 4)->change();
        });

        Schema::table('schedule_resources' , function (Blueprint $table){
            $table->decimal( 'qty', 20, 4)->change();
        });

        Schema::table('company_profiles', function (Blueprint $table) {
            $table->text('address_2')->nullable()->default(null)->after('country');
            $table->string('city_2')->nullable()->default(null)->after('address_2');
            $table->string('state_2')->nullable()->default(null)->after('city_2');
            $table->string('zip_2')->nullable()->default(null)->after('state_2');
            $table->string('country_2')->nullable()->default(null)->after('zip_2');
            $table->string('email')->nullable()->default(null)->after('mobile');
            $table->string('currency_code')->nullable()->default(null)->after('web');
            $table->string('language')->nullable()->default(null)->after('currency_code');
            $table->string('id_number')->nullable()->default(null)->after('language');
            $table->string('vat_number')->nullable()->default(null)->after('id_number');
        });

        Setting::saveByKey('purchaseorderTemplate', 'default.blade.php');
        Setting::saveByKey('purchaseorderGroup', '4');
        Setting::saveByKey('purchaseordersDueAfter', '30');
        Setting::saveByKey('purchaseorderStatusFilter', 'all_statuses');
        Setting::saveByKey('purchaseorderTerms', '');
        Setting::saveByKey('purchaseorderFooter', '');
        Setting::saveByKey('resetPurchaseorderDateEmailDraft', '0');
        Setting::saveByKey('enabledModules', '127');
        Setting::saveByKey('updateProductsDefault', '1');
        Setting::saveByKey('purchaseorderEmailSubject', 'Purchase Order #{{ $purchaseorder->number }}');
        Setting::saveByKey('purchaseorderEmailBody', '<p>Please find the attached purchase order from {{ $purchaseorder->user->name }}</p>');

        DB::table('schedule_categories')->where('id', 8)->update(['name' => 'Expense and Purchaseorder']);

        deleteTempFiles();
        deleteViewCache();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {
       //
     }
}
