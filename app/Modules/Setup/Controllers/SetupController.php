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

use FI\Http\Controllers\Controller;
use FI\Modules\CompanyProfiles\Models\CompanyProfile;
use FI\Modules\Settings\Models\Setting;
use FI\Modules\Setup\Requests\LicenseRequest;
use FI\Modules\Setup\Requests\ProfileRequest;
use FI\Modules\Users\Models\User;
use FI\Support\Migrations;
use DB;

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

    public function postXferAccount()
    {
        $oldschema = request('olddbname');
        $newschema = env('DB_DATABASE');

        DB::statement('set foreign_key_checks = 0');
        DB::statement('truncate table users');
        DB::statement('truncate table settings');
        DB::statement('truncate table currencies');
        DB::statement('truncate table groups');
        DB::statement('truncate table payment_methods');

        $oldtables = [
            'activities' => 'id, audit_type, activity, audit_id, info, created_at, updated_at',
            'addons' => 'id, created_at, updated_at, name, author_name, author_url, navigation_menu, system_menu, path, enabled, navigation_reports',
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
//            'schedule' => '',
//            'schedule_categories' => '',
//            'schedule_occurrences' => '',
//            'schedule_reminders' => '',
//            'schedule_resources' => '',
//            'schedule_settings' => '',
            'settings' => 'id, created_at, updated_at, setting_key, setting_value',
            'tax_rates' => 'id, created_at, updated_at, name, percent, is_compound, calculate_vat',
            //'time_tracking_projects' => '',
            //'time_tracking_tasks' => '',
            //'time_tracking_timers' => '',
            'users' => 'id, created_at, updated_at, email, password, name, remember_token, api_public_key, api_secret_key, client_id',
            'users_custom' => 'user_id, created_at, updated_at',
//            'workorder_amounts' => '',
//            'workorder_employees' => '',
//            'workorder_item_amounts' => '',
//            'workorder_items' => '',
//            'workorder_resources' => '',
//            'workorder_settings' => '',
//            'workorder_tax_rates' => '',
//            'workorders' => '',
//            'workorders_custom' => '',
        ];

        foreach ($oldtables as $table => $columndef){
            DB::statement('insert into `'. $newschema .'`.'.$table.' ('.$columndef.')
                                SELECT '.$columndef.' FROM `'. $oldschema .'`.'.$table.';');
        }

        DB::statement('set foreign_key_checks = 1');

        Setting::saveByKey('version', '4.0.0');

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