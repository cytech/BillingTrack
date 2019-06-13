<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\Quotes\Controllers;

use BT\Http\Controllers\Controller;
use BT\Modules\Quotes\Models\QuoteItem;

class QuoteItemController extends Controller
{
    public function delete()
    {
        QuoteItem::destroy(request('id'));
    }
}
