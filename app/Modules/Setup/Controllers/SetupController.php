<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\Setup\Controllers;

use BT\Http\Controllers\Controller;
use BT\Modules\CompanyProfiles\Models\CompanyProfile;
use BT\Modules\Scheduler\Models\Category;
use BT\Modules\Scheduler\Models\Schedule;
use BT\Modules\Settings\Models\Setting;
use BT\Modules\Setup\Requests\LicenseRequest;
use BT\Modules\Setup\Requests\ProfileRequest;
use BT\Modules\Users\Models\User;
use BT\Modules\Workorders\Models\Workorder;
use BT\Support\Migrations;
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
        $versionRequired = '7.3';
        $dbDriver        = config('database.default');
        $dbConfig        = config('database.connections.' . $dbDriver);

        if (version_compare(phpversion(), $versionRequired, '<'))
        {
            $errors[] = sprintf(trans('bt.php_version_error'), $versionRequired);
        }

        if (!$dbConfig['host'] or !$dbConfig['database'] or !$dbConfig['username'] or !$dbConfig['password'])
        {
            $errors[] = trans('bt.database_not_configured');
        }

        $query = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME =  ?";
        try {
            DB::select($query, [$dbConfig['database']]);
        } catch (\PDOException $e) {
            $errors[] = trans('bt.database_schema_not_configured');
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
