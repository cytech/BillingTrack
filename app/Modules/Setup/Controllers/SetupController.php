<?php

/**
 * This file is part of FusionInvoiceFOSS.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\Setup\Controllers;

use Artisan;
use FI\Http\Controllers\Controller;
use FI\Modules\CompanyProfiles\Models\CompanyProfile;
use FI\Modules\ItemLookups\Models\ItemLookup;
use FI\Modules\Settings\Models\Setting;
use FI\Modules\Setup\Requests\LicenseRequest;
use FI\Modules\Setup\Requests\ProfileRequest;
use FI\Modules\Users\Models\User;
use FI\Support\Migrations;
use DB;
use Illuminate\Http\Request;
use Schema;

class SetupController extends Controller
{
    private $migrations;

    public function __construct(Migrations $migrations)
    {
        $this->migrations = $migrations;
    }

    public function index()
    {
        return view('setup.index')
            ->with('license', file_get_contents(public_path('LICENSE')));
    }

    public function postIndex(LicenseRequest $request)
    {
        return redirect()->route('setup.prerequisites');
    }

    public function prerequisites()
    {
        $errors          = [];
        $versionRequired = '5.5.9';
        $dbDriver        = config('database.default');
        $dbConfig        = config('database.connections.' . $dbDriver);

        if (version_compare(phpversion(), $versionRequired, '<'))
        {
            $errors[] = sprintf(trans('fi.php_version_error'), $versionRequired);
        }

        if (!$dbConfig['host'] or !$dbConfig['database'] or !$dbConfig['username'] or !$dbConfig['password'])
        {
            $errors[] = trans('fi.database_not_configured');
        }

        if (!$errors)
        {
            return redirect()->route('setup.migration');
        }

        return view('setup.prerequisites')
            ->with('errors', $errors);
    }

    public function migration()
    {
        return view('setup.migration');
    }

    public function postMigration()
    {
        if ($this->migrations->runMigrations(database_path('migrations')))
        {
            return response()->json([], 200);
        }

        return response()->json(['exception' => $this->migrations->getException()->getMessage()], 400);
    }

    public function neworxfer(){
        return view('setup.neworxfer');
    }

    public function xferaccount()
    {
            return view('setup.xferaccount');

    }

    public function postXferAccount(Request $request)
    {
        //Artisan::call('config:cache');
        //olddbname entered in form
        $oldschema = $request->olddbname;
        //$newschema = env('DB_DATABASE');
        $newschema = DB::getDatabaseName();

        $query = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME =  ?";
        $db = DB::select($query, [$oldschema]);
        if(empty($db))
            return redirect()->back()
                ->with( 'alert', 'Database Schema not found. Enter a valid schema name to transfer' );

        //create connection to oldschema
        $otfdb = new OTFDB(['database' => $oldschema]);


        //truncate seeded tables
        DB::statement('set foreign_key_checks = 0');
        DB::statement('truncate table users');
        DB::statement('truncate table settings');
        DB::statement('truncate table currencies');
        DB::statement('truncate table groups');
        DB::statement('truncate table payment_methods');

        //oldschema column defs for migrate
        $oldtables = [
            'activities' => 'id, audit_type, activity, audit_id, info, created_at, updated_at',
            //'addons' => 'id, created_at, updated_at, name, author_name, author_url, navigation_menu, system_menu, path, enabled, navigation_reports',
            'attachments' => 'id, created_at, updated_at, user_id, attachable_id, attachable_type, filename, mimetype, size, url_key, client_visibility',
            'clients' => 'id, created_at,updated_at,name,address,city,state,zip,country,phone,fax,mobile,email,web,url_key,active,currency_code,unique_name,language',
            'clients_custom' => 'client_id, created_at, updated_at',
            'company_profiles' => 'id, created_at, updated_at, company, address, city, state, zip, country, phone, fax, mobile, web, logo, quote_template, invoice_template',
            'company_profiles_custom' => 'company_profile_id, created_at, updated_at',
            'contacts' => 'id, created_at, updated_at, client_id, name, email, default_to, default_cc, default_bcc',
            'currencies' => 'id, created_at, updated_at, code, name, symbol, placement, `decimal`, thousands',
            'custom_fields' => 'id, created_at, updated_at, tbl_name, column_name, field_label, field_type, field_meta',
            'expense_categories' => 'id, created_at, updated_at, name',
            'expense_vendors' => 'id, created_at, updated_at, name',
            'expenses' => 'id, created_at, updated_at, expense_date, user_id, category_id, client_id, vendor_id, invoice_id, description, amount, tax, company_profile_id',
            'expenses_custom' => 'expense_id, created_at, updated_at',
            'groups' => 'id, created_at, updated_at, name, next_id, left_pad, format, reset_number, last_id, last_year, last_month, last_week, last_number',
            'invoice_amounts' => 'id, created_at, updated_at, invoice_id, subtotal, discount, tax, total, paid, balance',
            'invoice_item_amounts' => 'id, created_at, updated_at, item_id, subtotal, tax_1, tax_2, tax, total',
            'invoice_items' => 'id, created_at, updated_at, invoice_id, tax_rate_id, tax_rate_2_id,  name, description, quantity, display_order, price',
            //'invoice_tax_rates' => '',
            'invoice_transactions' => 'id, created_at, updated_at, invoice_id, is_successful, transaction_reference',
            'invoices' => 'id, created_at, updated_at, invoice_date, user_id, client_id, group_id, invoice_status_id, due_at, number, terms, footer, url_key, currency_code, exchange_rate, template, summary, viewed, discount, company_profile_id',
            'invoices_custom' => 'invoice_id, created_at, updated_at',
            'item_lookups' => 'id, created_at, updated_at, name, description, price,  tax_rate_id, tax_rate_2_id',
            'mail_queue' => 'id, created_at, updated_at, mailable_id, mailable_type, `from`, `to`, cc, bcc, subject, body, attach_pdf, sent, error',
            'merchant_clients' => 'id, created_at, updated_at, driver, client_id, merchant_key, merchant_value',
            'merchant_payments' => 'id, created_at, updated_at, driver, payment_id, merchant_key, merchant_value',
            //'migrations' => '',
            'notes' => 'id, created_at, updated_at, user_id, notable_id, notable_type, note, private',
            'payment_methods' => 'id, created_at, updated_at, name',
            'payments' => 'id, created_at, updated_at, invoice_id, payment_method_id, paid_at, note, amount',
            'payments_custom' => 'payment_id, created_at, updated_at',
            'quote_amounts' => 'id, created_at, updated_at, quote_id, subtotal, discount, tax, total',
            'quote_item_amounts' => 'id, created_at, updated_at, item_id, subtotal, tax_1, tax_2, tax, total',
            'quote_items' => 'id, created_at, updated_at, quote_id, tax_rate_id, tax_rate_2_id, name, description, quantity, display_order, price',
            //'quote_tax_rates' => '',
            'quotes' => 'id, created_at, updated_at, quote_date, invoice_id, user_id, client_id, group_id, quote_status_id, expires_at, number, footer, url_key, currency_code, exchange_rate, terms, template, summary, viewed, discount, company_profile_id',
            'quotes_custom' => 'quote_id, created_at, updated_at',
            'recurring_invoice_amounts' => 'id, created_at, updated_at, recurring_invoice_id, subtotal, discount, tax, total',
            'recurring_invoice_item_amounts' => 'id, created_at, updated_at, item_id, subtotal, tax_1, tax_2, tax, total',
            'recurring_invoice_items' => 'id, created_at, updated_at, recurring_invoice_id, tax_rate_id, tax_rate_2_id, name, description, quantity, display_order, price',
            'recurring_invoices' => 'id, created_at, updated_at, user_id, client_id, group_id, company_profile_id, terms, footer, currency_code, exchange_rate, template, summary, discount, recurring_frequency, recurring_period, next_date, stop_date',
            'recurring_invoices_custom' => 'recurring_invoice_id, created_at, updated_at',
            //'recurring_invoices_old' => '',
            'schedule' => 'id, title, description, isRecurring, rrule, user_id, category_id, url, will_call, created_at, updated_at, deleted_at',
            'schedule_categories' => 'id, name, text_color, bg_color',
            'schedule_occurrences' => 'oid, schedule_id, start_date, end_date, created_at, updated_at',
            'schedule_reminders' => 'id, schedule_id, reminder_date, reminder_location, reminder_text, created_at, updated_at',
            'schedule_resources' => 'id, schedule_id, fid, resource_table, resource_id, value, qty',
            'schedule_settings' => 'id, created_at, updated_at, setting_key, setting_value',
            'settings' => 'id, created_at, updated_at, setting_key, setting_value',
            'tax_rates' => 'id, created_at, updated_at, name, percent, is_compound, calculate_vat',
            'time_tracking_projects' => 'id, created_at, updated_at, company_profile_id, user_id, client_id, name, due_at, hourly_rate, status_id',
            'time_tracking_tasks' => 'id, created_at, updated_at, time_tracking_project_id, name, display_order, billed, invoice_id',
            'time_tracking_timers' => 'id, created_at, updated_at, time_tracking_task_id, start_at, end_at, hours, description',
            'users' => 'id, created_at, updated_at, email, password, name, remember_token, api_public_key, api_secret_key, client_id',
            'users_custom' => 'user_id, created_at, updated_at',
            'workorder_amounts' => 'id, created_at, updated_at, workorder_id, subtotal, discount, tax, total',
            'workorder_employees' => 'id, created_at, updated_at, number, first_name, last_name, full_name, short_name, title, billing_rate, schedule, active, driver',
            'workorder_item_amounts' => 'id, created_at, updated_at, item_id, subtotal, tax_1, tax_2, tax, total',
            'workorder_items' => 'id, created_at, updated_at, workorder_id, tax_rate_id, tax_rate_2_id, resource_table, resource_id, name, description, quantity, display_order, price',
            'workorder_resources' => 'id, created_at, updated_at, name, description, serialnum, active, cost, category, type, numstock',
            'workorder_settings' => 'id, created_at, updated_at, setting_key, setting_value',
            //'workorder_tax_rates' => '',
            'workorders' => 'id, created_at, updated_at, workorder_date, invoice_id, user_id, client_id, group_id, workorder_status_id, expires_at, number, footer, url_key, currency_code, exchange_rate, terms, template, summary, viewed, discount, job_date, start_time, end_time, will_call, company_profile_id, deleted_at',
            'workorders_custom' => 'workorder_id, created_at, updated_at',
        ];

        //check if workorder addon installed by looking for invoice_items->resource_table column
        if ($otfdb->getConnection()->getSchemaBuilder()->hasColumn('invoice_items','resource_table')){
            $oldtables['invoice_items'] = 'id, created_at, updated_at, invoice_id, tax_rate_id, tax_rate_2_id, resource_table, resource_id, name, description, quantity, display_order, price';
            $oldtables['item_lookups'] = 'id, created_at, updated_at, name, description, price, resource_table, resource_id, tax_rate_id, tax_rate_2_id';
        }

        foreach ($oldtables as $table => $columndef){
            if (Schema::hasTable($table)) {
                //insert
                DB::statement('insert into `' . $newschema . '`.' . $table . ' (' . $columndef . ')
                                SELECT ' . $columndef . ' FROM `' . $oldschema . '`.' . $table . ';');
                //if payments add value to new client_id column
                if($table == 'payments'){
                    DB::statement('UPDATE payments o JOIN invoices d 
                                  ON d.id = o.invoice_id
                                  SET o.client_id = d.client_id;');
                }
                //if workorder addon was installed, update resource table from resources to products
                if($table == 'workorder_items' || $table == 'invoice_items'|| $table == 'item_lookups'){
                    DB::statement('update `'. $table .'` set resource_table = \'products\' where resource_table = \'resources\';');
                }

            }elseif (!Schema::hasTable($table)){
                //table name change overrides
                $newtable = '';
                ($table ==  'workorder_employees') ? $newtable = 'employees':null ;
                ($table ==  'workorder_resources') ? $newtable = 'products':null ;
                if ($newtable)
                DB::statement('insert into `' . $newschema . '`.' . $newtable . ' (' . $columndef . ')
                                SELECT ' . $columndef . ' FROM `' . $oldschema . '`.' . $table . ';');
            }
        }

        DB::statement('set foreign_key_checks = 1');

        Setting::saveByKey('version', '4.0.0');

        config(['database.connections.'.$oldschema => null]);

        return redirect()->route('setup.complete');
    }

    public function account()
    {
        if (!User::count())
        {
            return view('setup.account');
        }

        return redirect()->route('setup.complete');
    }

    public function postAccount(ProfileRequest $request)
    {
        if (!User::count())
        {
            $input = request()->all();

            unset($input['user']['password_confirmation']);

            $user = new User($input['user']);

            $user->password = $input['user']['password'];

            $user->save();

            $companyProfile = CompanyProfile::create($input['company_profile']);

            Setting::saveByKey('defaultCompanyProfile', $companyProfile->id);
        }

        return redirect()->route('setup.complete');
    }

    public function complete()
    {
        return view('setup.complete');
    }


}