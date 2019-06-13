<?php

use BT\Modules\Categories\Models\Category;
use BT\Modules\CustomFields\Models\VendorCustom;
use BT\Modules\Products\Models\Product;
use BT\Modules\Vendors\Models\Vendor;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class Version5102 extends Migration
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


        Schema::rename('expense_categories', 'categories');
        Schema::rename('expense_vendors', 'vendors');

        Schema::table('products', function (Blueprint $table) {
            $table->unsignedInteger('category_id')->after('cost')->nullable()->default(null);
            $table->index(["category_id"], 'products_category_id_index');
            $table->foreign('category_id', 'products_category_id_index')
                ->references('id')->on('categories')
                ->onDelete('restrict')
                ->onUpdate('cascade');
        });

        $products = Product::all();
        $categories = Category::all();

        foreach ($products as $item){
            if ($categories->contains('name', $item->category)){
                $item->category_id = $categories->where('name', $item->category)->first()->id;
                $item->save();
            }else{
                $category = new Category();
                $category->name = $item->category;
                $category->save();
                $item->category_id = $category->id;
                $item->save();
                $categories = Category::all();
            }
        }

        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('category');
        });

        Schema::table('vendors', function (Blueprint $table) {
            $table->text('address')->nullable()->default(null)->after('name');
            $table->string('city')->nullable()->default(null)->after('address');
            $table->string('state')->nullable()->default(null)->after('city');
            $table->string('zip')->nullable()->default(null)->after('state');
            $table->string('country')->nullable()->default(null)->after('zip');
            $table->text('address_2')->nullable()->default(null)->after('country');
            $table->string('city_2')->nullable()->default(null)->after('address_2');
            $table->string('state_2')->nullable()->default(null)->after('city_2');
            $table->string('zip_2')->nullable()->default(null)->after('state_2');
            $table->string('country_2')->nullable()->default(null)->after('zip_2');
            $table->string('phone')->nullable()->default(null)->after('country_2');
            $table->string('fax')->nullable()->default(null)->after('phone');
            $table->string('mobile')->nullable()->default(null)->after('fax');
            $table->string('email')->nullable()->default(null)->after('mobile');
            $table->string('web')->nullable()->default(null)->after('email');
            $table->tinyInteger('active')->default('1')->after('web');
            $table->string('currency_code')->nullable()->default(null)->after('active');
            $table->string('language')->nullable()->default(null)->after('currency_code');
            $table->string('id_number')->nullable()->default(null)->after('language');
            $table->string('vat_number')->nullable()->default(null)->after('id_number');
            $table->unsignedInteger('paymentterm_id')->nullable()->default(1)->after('vat_number');


            $table->index(["active"], 'vendors_active_index');
            $table->index(["name"], 'vendors_name_index');

            $table->foreign('paymentterm_id')->references('id')->on('payment_terms')->onDelete('no action')->onUpdate('no action');
        });

        Schema::create('vendor_contacts', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('vendor_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('name');
            $table->string('email');
            $table->string('phone')->nullable()->default(null);
            $table->string('fax')->nullable()->default(null);
            $table->string('mobile')->nullable()->default(null);
            $table->unsignedInteger('title_id')->nullable()->default(1);
            $table->tinyInteger('default_to')->default(0);
            $table->tinyInteger('default_cc')->default(0);
            $table->tinyInteger('default_bcc')->default(0);
            $table->tinyInteger('is_primary')->default(0);
            $table->tinyInteger('optin')->default(1);

            $table->index(["vendor_id"], 'contacts_vendor_id_index');

            $table->softDeletes();
            $table->nullableTimestamps();


            $table->foreign('vendor_id', 'contacts_vendor_id_index')
                ->references('id')->on('vendors')
                ->onDelete('cascade')
                ->onUpdate('restrict');

            $table->foreign('title_id')->references('id')->on('titles')->onDelete('no action')->onUpdate('no action');

        });

        Schema::create('vendors_custom', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('vendor_id');
            $table->softDeletes();
            $table->nullableTimestamps();


            $table->foreign('vendor_id', 'vendors_custom_vendor_id')
                ->references('id')->on('vendors')
                ->onDelete('cascade')
                ->onUpdate('restrict');
        });

        //create existing vendor custom default record
        $vendors = Vendor::all();

        foreach ($vendors as $vendor){
            $vendor->custom()->save(new VendorCustom());
        }

        //copy product cost to price
        $products = Product::all();

        foreach ($products as $product){
            if (!$product->price || empty($product->price) || is_null($product->price)){
                $product->price = $product->cost;
                $product->save();
            }
        }

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::rename('categories','expense_categories');
        Schema::rename('vendors','expense_vendors');

    }
}
