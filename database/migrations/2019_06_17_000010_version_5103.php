<?php

use BT\Modules\Groups\Models\Group;
use BT\Modules\Settings\Models\Setting;
use Illuminate\Database\Migrations\Migration;

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
        deleteTempFiles();
        deleteViewCache();

        DB::table('groups')->insert(
            [
                'name'         => 'Purchaseorder Default',
                'next_id'      => 1,
                'left_pad'     => 0,
                'format'       => 'PO{NUMBER}',
                'reset_number' => 0
            ]
        );

        Setting::saveByKey('purchaseorderTemplate', 'default.blade.php');
        Setting::saveByKey('purchaseorderGroup', '4');
        Setting::saveByKey('purchaseordersDueAfter', '30');
        Setting::saveByKey('purchaseorderStatusFilter', 'all_statuses');
        Setting::saveByKey('purchaseorderTerms', '');
        Setting::saveByKey('purchaseorderFooter', '');
        Setting::saveByKey('resetPurchaseorderDateEmailDraft', '0');
        Setting::saveByKey('enabledModules', '127');


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
