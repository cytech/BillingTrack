<?php

use FI\Modules\Settings\Models\Setting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateAddForeignkeys extends Migration
{


    /**
     * Run the migrations.
     */
    public function up()
    {
        $version = Setting::where('setting_key', 'version')->first();

        if ($version->setting_value == '4.0.0'){ return;}

        Schema::disableForeignKeyConstraints();

        Schema::table('clients_custom', function (Blueprint $table){
            $table->foreign('client_id', 'clients_custom_client_id')
                ->references('id')->on('clients')
                ->onDelete('cascade')
                ->onUpdate('restrict');
        });

        Schema::table('attachments', function (Blueprint $table){
            $table->foreign('user_id', 'fk_attachments_users1_idx')
                ->references('id')->on('users')
                ->onDelete('set null')
                ->onUpdate('cascade');
        });

        Schema::table('contacts', function (Blueprint $table){
            $table->foreign('client_id', 'contacts_client_id_index')
                ->references('id')->on('clients')
                ->onDelete('cascade')
                ->onUpdate('restrict');
        });

        Schema::table('invoices', function (Blueprint $table){
            $table->foreign('client_id', 'invoices_client_id_index')
                ->references('id')->on('clients')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('company_profile_id', 'invoices_company_profile_id_index')
                ->references('id')->on('company_profiles')
                ->onDelete('set null')
                ->onUpdate('cascade');

            $table->foreign('group_id', 'invoices_invoice_group_id_index')
                ->references('id')->on('groups')
                ->onDelete('set null')
                ->onUpdate('cascade');

            $table->foreign('user_id', 'invoices_user_id_index')
                ->references('id')->on('users')
                ->onDelete('set null')
                ->onUpdate('cascade');
        });

        Schema::table('notes', function (Blueprint $table){
            $table->foreign('user_id', 'fk_notes_users1_idx')
                ->references('id')->on('users')
                ->onDelete('set null')
                ->onUpdate('cascade');
        });

        Schema::table('users_custom', function (Blueprint $table){
            $table->foreign('user_id', 'users_custom_user_id')
                ->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('restrict');
        });

        Schema::table('time_tracking_projects', function (Blueprint $table){
            $table->foreign('client_id', 'time_tracking_projects_client_id_index')
                ->references('id')->on('clients')
                ->onDelete('set null')
                ->onUpdate('cascade');

            $table->foreign('company_profile_id', 'time_tracking_projects_company_profile_id_index')
                ->references('id')->on('company_profiles')
                ->onDelete('set null')
                ->onUpdate('cascade');

            $table->foreign('user_id', 'time_tracking_projects_user_id_index')
                ->references('id')->on('users')
                ->onDelete('set null')
                ->onUpdate('cascade');
        });

        Schema::table('quotes', function (Blueprint $table){
            $table->foreign('client_id', 'quotes_client_id_index')
                ->references('id')->on('clients')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('company_profile_id', 'quotes_company_profile_id_index')
                ->references('id')->on('company_profiles')
                ->onDelete('set null')
                ->onUpdate('cascade');

            $table->foreign('group_id', 'quotes_invoice_group_id_index')
                ->references('id')->on('groups')
                ->onDelete('set null')
                ->onUpdate('cascade');

            $table->foreign('user_id', 'quotes_user_id_index')
                ->references('id')->on('users')
                ->onDelete('set null')
                ->onUpdate('cascade');
        });

        Schema::table('recurring_invoices', function (Blueprint $table){
            $table->foreign('client_id', 'recurring_invoices_client_id_index')
                ->references('id')->on('clients')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('company_profile_id', 'recurring_invoices_company_profile_id_index')
                ->references('id')->on('company_profiles')
                ->onDelete('set null')
                ->onUpdate('cascade');

            $table->foreign('group_id', 'fk_recurring_invoices_groups1_idx')
                ->references('id')->on('groups')
                ->onDelete('set null')
                ->onUpdate('cascade');

            $table->foreign('user_id', 'recurring_invoices_user_id_index')
                ->references('id')->on('users')
                ->onDelete('set null')
                ->onUpdate('cascade');
        });

        Schema::table('company_profiles_custom', function (Blueprint $table){

            $table->foreign('company_profile_id', 'company_profiles_custom_company_profile_id')
                ->references('id')->on('company_profiles')
                ->onDelete('cascade')
                ->onUpdate('restrict');
        });

        Schema::table('merchant_clients', function (Blueprint $table){
            $table->foreign('client_id', 'merchant_clients_client_id_index')
                ->references('id')->on('clients')
                ->onDelete('cascade')
                ->onUpdate('restrict');
        });

        Schema::table('invoice_items', function (Blueprint $table){
            $table->foreign('invoice_id', 'invoice_items_invoice_id_index')
                ->references('id')->on('invoices')
                ->onDelete('cascade')
                ->onUpdate('restrict');
        });

        Schema::table('recurring_invoice_amounts', function (Blueprint $table){
            $table->foreign('recurring_invoice_id', 'recurring_invoice_amounts_recurring_invoice_id_index')
                ->references('id')->on('recurring_invoices')
                ->onDelete('cascade')
                ->onUpdate('restrict');
        });

        Schema::table('quote_amounts', function (Blueprint $table){
            $table->foreign('quote_id', 'quote_amounts_quote_id_index')
                ->references('id')->on('quotes')
                ->onDelete('cascade')
                ->onUpdate('restrict');
        });

        Schema::table('clients_time_tracking_taskscustom', function (Blueprint $table){

            $table->foreign('invoice_id', 'time_tracking_tasks_invoice_id_index')
                ->references('id')->on('invoices')
                ->onDelete('set null')
                ->onUpdate('restrict');

            $table->foreign('time_tracking_project_id', 'time_tracking_tasks_time_tracking_project_id_index')
                ->references('id')->on('time_tracking_projects')
                ->onDelete('cascade')
                ->onUpdate('restrict');
        });

        Schema::table('recurring_invoices_custom', function (Blueprint $table){
            $table->foreign('recurring_invoice_id', 'recurring_invoices_custom_recurring_invoice_id')
                ->references('id')->on('recurring_invoices')
                ->onDelete('cascade')
                ->onUpdate('restrict');
        });

        Schema::table('invoice_transactions', function (Blueprint $table){
            $table->foreign('invoice_id', 'fk_invoice_transactions_invoices1_idx')
                ->references('id')->on('invoices')
                ->onDelete('cascade')
                ->onUpdate('restrict');
        });

        Schema::table('invoices_custom', function (Blueprint $table){

            $table->foreign('invoice_id', 'invoices_custom_invoice_id')
                ->references('id')->on('invoices')
                ->onDelete('cascade')
                ->onUpdate('restrict');
        });

        Schema::table('expenses', function (Blueprint $table){
            $table->foreign('company_profile_id', 'expenses_company_profile_id_index')
                ->references('id')->on('company_profiles')
                ->onDelete('set null')
                ->onUpdate('cascade');

            $table->foreign('category_id', 'expenses_category_id_index')
                ->references('id')->on('expense_categories')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreign('user_id', 'fk_expenses_users1_idx')
                ->references('id')->on('users')
                ->onDelete('set null')
                ->onUpdate('cascade');

            $table->foreign('invoice_id', 'fk_expenses_invoices1_idx')
                ->references('id')->on('invoices')
                ->onDelete('set null')
                ->onUpdate('restrict');
        });

        Schema::table('invoice_amounts', function (Blueprint $table){
            $table->foreign('invoice_id', 'invoice_amounts_invoice_id_index')
                ->references('id')->on('invoices')
                ->onDelete('cascade')
                ->onUpdate('restrict');
        });

        Schema::table('quote_items', function (Blueprint $table){
            $table->foreign('quote_id', 'quote_items_quote_id_index')
                ->references('id')->on('quotes')
                ->onDelete('cascade')
                ->onUpdate('restrict');
        });

        Schema::table('quotes_custom', function (Blueprint $table){
            $table->foreign('quote_id', 'quotes_custom_quote_id')
                ->references('id')->on('quotes')
                ->onDelete('cascade')
                ->onUpdate('restrict');
        });

        Schema::table('recurring_invoice_items', function (Blueprint $table){
            $table->foreign('recurring_invoice_id', 'recurring_invoice_items_recurring_invoice_id_index')
                ->references('id')->on('recurring_invoices')
                ->onDelete('cascade')
                ->onUpdate('restrict');
        });

        Schema::table('payments', function (Blueprint $table){
            $table->foreign('invoice_id', 'payments_invoice_id_index')
                ->references('id')->on('invoices')
                ->onDelete('cascade')
                ->onUpdate('restrict');

            $table->foreign('payment_method_id', 'payments_payment_method_id_index')
                ->references('id')->on('payment_methods')
                ->onDelete('restrict')
                ->onUpdate('cascade');
        });

        Schema::table('expenses_custom', function (Blueprint $table){
            $table->foreign('expense_id', 'expenses_custom_expense_id')
                ->references('id')->on('expenses')
                ->onDelete('cascade')
                ->onUpdate('restrict');
        });

        Schema::table('merchant_payments', function (Blueprint $table){
            $table->foreign('payment_id', 'merchant_payments_payment_id_index')
                ->references('id')->on('payments')
                ->onDelete('cascade')
                ->onUpdate('restrict');
        });

        Schema::table('time_tracking_timers', function (Blueprint $table){
            $table->foreign('time_tracking_task_id', 'time_tracking_timers_time_tracking_task_id_index')
                ->references('id')->on('time_tracking_tasks')
                ->onDelete('cascade')
                ->onUpdate('restrict');
        });

        Schema::table('invoice_item_amounts', function (Blueprint $table){
            $table->foreign('item_id', 'invoice_item_amounts_item_id_index')
                ->references('id')->on('invoice_items')
                ->onDelete('cascade')
                ->onUpdate('restrict');
        });

        Schema::table('quote_item_amounts', function (Blueprint $table){
            $table->foreign('item_id', 'quote_item_amounts_item_id_index')
                ->references('id')->on('quote_items')
                ->onDelete('cascade')
                ->onUpdate('restrict');
        });

        Schema::table('recurring_invoice_item_amounts', function (Blueprint $table){
            $table->foreign('item_id', 'recurring_invoice_item_amounts_item_id_index')
                ->references('id')->on('recurring_invoice_items')
                ->onDelete('cascade')
                ->onUpdate('restrict');
        });

        Schema::table('payments_custom', function (Blueprint $table){
            $table->foreign('payment_id', 'payments_custom_payment_id')
                ->references('id')->on('payments')
                ->onDelete('cascade')
                ->onUpdate('restrict');
        });

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
