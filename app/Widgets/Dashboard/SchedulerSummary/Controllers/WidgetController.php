<?php

/**
 * This file is part of BillingTrack.
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Widgets\Dashboard\SchedulerSummary\Controllers;

use BT\Http\Controllers\Controller;


class WidgetController extends Controller
{


    public function renderPartial()
    {

        return view('SchedulerSummaryWidget');
    }
}
