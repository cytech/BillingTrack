<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\Quotes\Controllers;

use FI\Http\Controllers\Controller;
use FI\Modules\Quotes\Models\QuoteItem;

class QuoteItemController extends Controller
{
    public function delete()
    {
        QuoteItem::destroy(request('id'));
    }
}
