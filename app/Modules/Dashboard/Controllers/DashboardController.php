<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\Dashboard\Controllers;

use FI\Http\Controllers\Controller;
use FI\Support\DashboardWidgets;

class DashboardController extends Controller
{
    public function index()
    {

        return view('dashboard.index')
            ->with('widgets', DashboardWidgets::listsByOrder());
    }

}
