<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\CompanyProfiles\Controllers;

use BT\Http\Controllers\Controller;
use BT\Modules\CompanyProfiles\Models\CompanyProfile;

class LogoController extends Controller
{
    public function logo($id)
    {
        $companyProfile = CompanyProfile::find($id);

        if ($companyProfile->logo)
        {
            return response(file_get_contents(storage_path($companyProfile->logo)), 200)->header('Content-Type', 'image/jpeg');
        }

        return null;
    }
}
