<?php

use BT\Modules\Activity\Models\Activity;
use BT\Modules\Attachments\Models\Attachment;
use BT\Modules\Invoices\Models\InvoiceItem;
use BT\Modules\MailQueue\Models\MailQueue;
use BT\Modules\Notes\Models\Note;
use BT\Modules\Products\Models\InventoryType;
use BT\Modules\Products\Models\Product;
use BT\Modules\Settings\Models\Setting;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class Version520 extends Migration
{

    /**
     * Run the migrations.
     * @table payments_custom
     *
     * @return void
     */
    public function up()
    {
        //fullcalendar changed themeing, removed jqueryui
        $themekey = Setting::getByKey('schedulerFcThemeSystem');
        if ($themekey == 'bootstrap4'){
            Setting::saveByKey('schedulerFcThemeSystem', 'bootstrap');
        }
        if ($themekey == 'jquery-ui'){
            Setting::saveByKey('schedulerFcThemeSystem', 'standard');
        }
        Setting::saveByKey('version', '5.2.0');
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
