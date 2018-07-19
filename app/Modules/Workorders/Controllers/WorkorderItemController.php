<?php

/**
 * This file is part of Workorders Addon for FusionInvoice.
 * (c) Cytech <cytech@cytech-eng.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
 

namespace Addons\Workorders\Controllers;

use FI\Http\Controllers\Controller;
use Addons\Workorders\Models\WorkorderItem;

class WorkorderItemController extends Controller
{
    public function delete()
    {
        WorkorderItem::destroy(request('id'));
    }
}