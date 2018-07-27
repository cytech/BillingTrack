<?php

/**
 * This file is part of Scheduler Addon for FusionInvoice.
 * (c) Cytech <cytech@cytech-eng.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Widgets\Dashboard\SchedulerSummary\Controllers;

use FI\Http\Controllers\Controller;


class WidgetController extends Controller
{


    public function renderPartial()
    {

        return view('SchedulerSummaryWidget');
    }
}