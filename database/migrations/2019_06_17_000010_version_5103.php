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
        Schema::disableForeignKeyConstraints();

        DB::table('groups')->insert(
            [
                'name'         => 'Purchaseorder Default',
                'next_id'      => 1,
                'left_pad'     => 0,
                'format'       => 'PO{NUMBER}',
                'reset_number' => 0
            ]
        );

        Schema::create('inventory_types' , function (Blueprint $table){
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name', 85)->nullable()->default(null);
            $table->tinyInteger('tracked')->default('0');
        });

        //seed inventory types
        Artisan::call('db:seed', [
            '--class' => InventoryTypesSeeder::class
        ]);

        Schema::table('products' , function (Blueprint $table){
            $table->decimal( 'numstock', 20, 4)->unsigned(false)->change();
            $table->unsignedInteger( 'inventorytype_id')->after('category_id')->default(1);
            $table->index(["inventorytype_id"], 'products_inventorytype_id_index');
            $table->foreign('inventorytype_id', 'products_inventorytype_id_index')
                ->references('id')->on('inventory_types')
                ->onDelete('restrict')
                ->onUpdate('cascade');
        });

        $products = Product::all();
        $inventorytypes = InventoryType::all();

        foreach ($products as $item){
            if ($inventorytypes->contains('name', $item->type)){
                $item->inventorytype_id = $inventorytypes->where('name', $item->type)->first()->id;
                $item->save();
            }else{
                $inventorytype = new InventoryType();
                $inventorytype->name = $item->type;
                $inventorytype->tracked = 0;
                $inventorytype->save();
                $item->inventorytype_id = $inventorytype->id;
                $item->save();
                $inventorytypes = InventoryType::all();
            }
        }

        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('type');
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
            $table->string('purchaseorder_template')->default('default.blade.php')->after('invoice_template');
        });

        Schema::table('invoice_items', function (Blueprint $table) {
            $table->tinyInteger('is_tracked')->default('0')->after('resource_id');
        });

        // set existing product table items to tracked
        DB::update('update invoice_items set is_tracked = 1 where resource_table = "products" and resource_id > 0');

        Setting::saveByKey('purchaseorderTemplate', 'default.blade.php');
        Setting::saveByKey('purchaseorderGroup', '4');
        Setting::saveByKey('purchaseordersDueAfter', '30');
        Setting::saveByKey('purchaseorderStatusFilter', 'all_statuses');
        Setting::saveByKey('purchaseorderTerms', '');
        Setting::saveByKey('purchaseorderFooter', '');
        Setting::saveByKey('resetPurchaseorderDateEmailDraft', '0');
        Setting::saveByKey('enabledModules', '127');
        Setting::saveByKey('updateProductsDefault', '1');
        Setting::saveByKey('updateInvProductsDefault', '1');
        Setting::saveByKey('purchaseorderEmailSubject', 'Purchase Order #{{ $purchaseorder->number }}');
        Setting::saveByKey('purchaseorderEmailBody', '<p>Please find the attached purchase order from {{ $purchaseorder->user->name }}</p>');
        Setting::saveByKey('skin','{"headBackground":"purple","headClass":"dark","sidebarBackground":"white","sidebarClass":"light","sidebarMode":"open"}');
        Setting::saveByKey('currencyConversionKey','');

        DB::table('schedule_categories')->where('id', 8)->update(['name' => 'Expense and Purchaseorder']);


        //modify existing polymorphic _types for changed namespace
        //notable_type, audit_type, mailable_type, attachable_type to BT\....
        $notes = Note::all();
        $activities = Activity::all();
        $mailqueues = MailQueue::all();
        $attachments = Attachment::all();

        foreach ($notes as $note){
            $note->notable_type = str_replace('FI\\', 'BT\\', $note->notable_type);
            $note->save();
        }
        foreach ($activities as $activity){
            $activity->audit_type = str_replace('FI\\', 'BT\\', $activity->audit_type);
            $activity->save();
        }
        foreach ($mailqueues as $mailqueue){
            $mailqueue->mailable_type = str_replace('FI\\', 'BT\\', $mailqueue->mailable_type);
            $mailqueue->save();
        }
        foreach ($attachments as $attachment){
            $attachment->attachable_type = str_replace('FI\\', 'BT\\', $attachment->attachable_type);
            $attachment->save();
        }

        deleteTempFiles();
        deleteViewCache();

        Schema::enableForeignKeyConstraints();

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
