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
use FI\Modules\Scheduler\Models\Category;
use FI\Modules\Scheduler\Models\Schedule;
use FI\Modules\Settings\Models\Setting;
use FI\Modules\Setup\Requests\LicenseRequest;
use FI\Modules\Setup\Requests\ProfileRequest;
use FI\Modules\Users\Models\User;
use FI\Modules\Workorders\Models\Workorder;
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
        if (Schema::hasTable('users')) {
            $mode = 'upgrade';
        } else {
            $mode = 'setup';
        }
        return view('setup.migration')->with('mode', $mode);
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
        $maxtime =  ini_get('max_execution_time');
        ini_set('max_execution_time', '300'); // extremely large database transfer fails at default 30 seconds
        //olddbname entered in form
        $oldschema = $request->olddbname;
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
            'schedule_resources' => 'id, schedule_id, resource_table, resource_id, value, qty',
            //'schedule_settings' => 'id, created_at, updated_at, setting_key, setting_value',
            'settings' => 'id, created_at, updated_at, setting_key, setting_value',
            'tax_rates' => 'id, created_at, updated_at, name, percent, is_compound, calculate_vat',
            'time_tracking_projects' => 'id, created_at, updated_at, company_profile_id, user_id, client_id, name, due_at, hourly_rate, status_id',
            'time_tracking_tasks' => 'id, created_at, updated_at, time_tracking_project_id, name, display_order, billed, invoice_id',
            'time_tracking_timers' => 'id, created_at, updated_at, time_tracking_task_id, start_at, end_at, hours',
            'users' => 'id, created_at, updated_at, email, password, name, remember_token, api_public_key, api_secret_key, client_id',
            'users_custom' => 'user_id, created_at, updated_at',
            'workorder_amounts' => 'id, created_at, updated_at, workorder_id, subtotal, discount, tax, total',
            'workorder_employees' => 'id, created_at, updated_at, number, first_name, last_name, full_name, short_name, title, billing_rate, schedule, active, driver',
            'workorder_item_amounts' => 'id, created_at, updated_at, item_id, subtotal, tax_1, tax_2, tax, total',
            'workorder_items' => 'id, created_at, updated_at, workorder_id, tax_rate_id, tax_rate_2_id, resource_table, resource_id, name, description, quantity, display_order, price',
            'workorder_resources' => 'id, created_at, updated_at, name, description, serialnum, active, cost, category, type, numstock',
            //'workorder_settings' => 'id, created_at, updated_at, setting_key, setting_value',
            //'workorder_tax_rates' => '',
            'workorders' => 'id, created_at, updated_at, workorder_date, invoice_id, user_id, client_id, group_id, workorder_status_id, expires_at, number, footer, url_key, currency_code, exchange_rate, terms, template, summary, viewed, discount, job_date, start_time, end_time, will_call, company_profile_id, deleted_at',
            'workorders_custom' => 'workorder_id, created_at, updated_at',
        ];

        //have to check for custom columns because FusionInvoice creates them on demand
        $customtables = ['clients_custom', 'company_profiles_custom', 'expenses_custom', 'invoices_custom', 'payments_custom',
            'quotes_custom', 'recurring_invoices_custom', 'users_custom', 'workorders_custom'];

        foreach ($customtables as $table) {
            $addcolumns[$table] = '';
            for ($i = 1; $i <= 10; $i++) { //10 is number of custom columns to look for, there is no limit in FusionInvoice
                $testcolumn = 'column_' . $i;
                if ($otfdb->getConnection()->getSchemaBuilder()->hasColumn($table, $testcolumn)) {
                    $type = $otfdb->getConnection()->getSchemaBuilder()->getColumnType($table, $testcolumn);
                    Schema::table($table, function ($t) use ($type, $testcolumn){
                        if ($type == 'text')
                        {
                            $t->text($testcolumn)->nullable();
                        }
                        else
                        {
                            $t->string($testcolumn)->nullable();
                        }
                    });
                    $addcolumns[$table] .= ', ' . $testcolumn ;
                }
            }
            if (!empty( $addcolumns[$table])){
                $oldtables[$table] = substr($table, 0,-8) . '_id, created_at, updated_at'.  $addcolumns[$table];
            }
        }

        //check if workorder addon installed by looking for invoice_items->resource_table column
        if ($otfdb->getConnection()->getSchemaBuilder()->hasColumn('invoice_items','resource_table')){
            $oldtables['invoice_items'] = 'id, created_at, updated_at, invoice_id, tax_rate_id, tax_rate_2_id, resource_table, resource_id, name, description, quantity, display_order, price';
            $oldtables['item_lookups'] = 'id, created_at, updated_at, name, description, price, resource_table, resource_id, tax_rate_id, tax_rate_2_id';

        }

        foreach ($oldtables as $table => $columndef){
            if (Schema::hasTable($table) && $otfdb->getConnection()->getSchemaBuilder()->hasTable($table)) {
                //insert
                DB::statement('truncate ' . $table);
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
                //move existing and add scheduler categories
                if ($table == 'schedule_categories'){
                    //move user defined category ids
                    $usercats = Category::where('id', '>', 9)->get();
                    foreach ($usercats->reverse() as $cats){
                        $cats->id = $cats->id + 2;
                        $cats->save();
                    }
                    //add workorder category
                    $usercats = Category::where('id', '>=', 5)->where('id', '<=', 9)->get();
                    foreach ($usercats->reverse() as $cats){
                        $cats->id = $cats->id + 1;
                        $cats->save();
                    }

                    DB::table('schedule_categories')->insert(['id' => 5, 'name' => 'Workorder', 'text_color' => '#000000', 'bg_color' => '#aaffaa']);
                    DB::table('schedule_categories')->where('name', 'Client Appointment')->update(['name' => 'Employee Appointment']);

                    $catcount = Category::count();

                    DB::statement('ALTER TABLE `' . $newschema . '`.schedule_categories AUTO_INCREMENT = '. ($catcount + 1) .';');

                    //update schedule category ids
                    $schedcats = Schedule::where('category_id', '>', 9)->get();
                    foreach ($schedcats as $scats){
                        $scats->category_id = $scats->category_id + 2;
                        $scats->save();
                    }
                }
                if ($table == 'settings'){
                    DB::table('settings')->insert([ 'setting_key' => 'workorderTemplate', 'setting_value' => 'default.blade.php' ]);
                    DB::table('settings')->insert([ 'setting_key' => 'workorderGroup', 'setting_value' => '3' ]);
                    DB::table('settings')->insert([ 'setting_key' => 'workordersExpireAfter', 'setting_value' => '15' ]);
                    DB::table('settings')->insert([ 'setting_key' => 'workorderTerms', 'setting_value' => 'Default Terms:' ]);
                    DB::table('settings')->insert([ 'setting_key' => 'workorderFooter', 'setting_value' => 'Default Footer:' ]);
                    DB::table('settings')->insert([ 'setting_key' => 'convertWorkorderTerms', 'setting_value' => 'workorder' ]);
                    DB::table('settings')->insert([ 'setting_key' => 'tsCompanyName', 'setting_value' => 'YOURQBCOMPANYNAME' ]);
                    DB::table('settings')->insert([ 'setting_key' => 'tsCompanyCreate', 'setting_value' => 'YOURQBCOMPANYCREATETIME' ]);
                    DB::table('settings')->insert([ 'setting_key' => 'workorderStatusFilter', 'setting_value' => 'all_statuses' ]);
                    DB::table('settings')->insert([ 'setting_key' => 'restolup', 'setting_value' => '0' ]);
                    DB::table('settings')->insert([ 'setting_key' => 'emptolup', 'setting_value' => '0' ]);
                    DB::table('settings')->insert(['setting_key' => 'schedulerPastdays', 'setting_value' => '60']);
                    DB::table('settings')->insert(['setting_key' => 'schedulerEventLimit', 'setting_value' => '5']);
                    DB::table('settings')->insert(['setting_key' => 'schedulerCreateWorkorder', 'setting_value' => '0']);
                    DB::table('settings')->insert(['setting_key' => 'schedulerFcThemeSystem', 'setting_value' => 'standard']);
                    DB::table('settings')->insert(['setting_key' => 'schedulerFcAspectRatio', 'setting_value' => '1.35']);
                    DB::table('settings')->insert(['setting_key' => 'schedulerTimestep', 'setting_value' => '15']);
                    DB::table('settings')->insert(['setting_key' => 'schedulerEnabledCoreEvents', 'setting_value' => '15']);
                    DB::table('settings')->insert(['setting_key' => 'schedulerDisplayInvoiced', 'setting_value' => '0']);
                    DB::table('settings')->insert(['setting_key' => 'pdfDisposition', 'setting_value' => 'inline']);
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
        //these need to happen after all tables are populated
        //delete orphaned workorders (with no client)
        //below not running, try statement
        //DB::raw('delete FROM workorders WHERE NOT EXISTS (SELECT NULL FROM clients WHERE clients.id = workorders.client_id)');
        DB::statement('delete FROM `' . $newschema . '`.workorders WHERE NOT EXISTS (SELECT NULL FROM `' . $newschema . '`.clients 
                        WHERE `' . $newschema . '`.clients.id = `' . $newschema . '`.workorders.client_id)');

        //delete old workorder schedule items. replaced with coreevents
        $schedules = Schedule::where('id', '<', 1000000)->get();
        foreach ($schedules as $schedule){
            $schedule->occurrences()->forceDelete();
            $schedule->reminders()->forceDelete();
            $schedule->resources()->forceDelete();
            $schedule->forceDelete();
        }
        //softcascade any existing trashed schedule events
        $trashedsched = Schedule::onlyTrashed()->get();
        foreach ($trashedsched as $schedule){
            $schedule->delete();
        }
        //softcascade any existing trashed workorders
        $trashedworkorders = Workorder::onlyTrashed()->get();
        foreach ($trashedworkorders as $workorder){
            $workorder->delete();
        }



        DB::statement('set foreign_key_checks = 1');

        Setting::saveByKey('version', '4.0.0');

        config(['database.connections.'.$oldschema => null]);

        ini_set('max_execution_time', $maxtime); //set back to original

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