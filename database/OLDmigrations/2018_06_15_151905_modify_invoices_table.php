<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
USE FI\Modules\Quotes\Models\Quote;
use FI\Modules\Invoices\Models\Invoice;

class ModifyInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->tinyInteger('invoice_type_id')->after('group_id')->default(INVOICE_TYPE_INVOICE);
            $table->integer('invoice_id_ref')->after('invoice_date')->nullable();
        });

//        $quotes = Quote::all();
//
//        foreach ($quotes as $quote){
//            $invoice = new Invoice();
//            $invoice->fill($quote->toArray())->except('quote_date');
//            dd($invoice);
//            $invoice->invoice_date = $quote->quote_date;
//            $invoice->invoice_id_ref = $quote->invoice_id;
//            $invoice->invoice_status_id = $quote->quote_status_id;
//            $invoice->invoice_due_at = $quote->expires_at;
//            $invoice->invoice_type_id = INVOICE_TYPE_QUOTE;
//
//            $invoice->save();
//        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->dropColumn('invoice_type_id');
            $table->dropColumn('invoice_id_ref');
        });
    }
}
