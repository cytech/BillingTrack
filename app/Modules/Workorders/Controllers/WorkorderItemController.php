<?php

/**
 * This file is part of Workorders Addon for FusionInvoice.
 * (c) Cytech <cytech@cytech-eng.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
 

namespace FI\Modules\Workorders\Controllers;

use FI\Http\Controllers\Controller;
use FI\Modules\Workorders\Models\WorkorderItem;

class WorkorderItemController extends Controller
{
    public function delete()
    {
        WorkorderItem::destroy(request('id'));
    }
}