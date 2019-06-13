<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\Currencies\Models;

use BT\Modules\Clients\Models\Client;
use BT\Modules\Invoices\Models\Invoice;
use BT\Modules\Quotes\Models\Quote;
use BT\Traits\Sortable;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use Sortable;

    protected $table = 'currencies';

    protected $sortable = ['code', 'name', 'symbol', 'placement', 'decimal', 'thousands'];

    /**
     * Guarded properties
     * @var array
     */
    protected $guarded = ['id'];

    public static function getList()
    {
        return self::orderBy('name')->pluck('name', 'code')->all();
    }

    public function getInUseAttribute()
    {
        if ($this->code == config('bt.baseCurrency'))
        {
            return true;
        }

        if (Client::where('currency_code', '=', $this->code)->count())
        {
            return true;
        }

        if (Quote::where('currency_code', '=', $this->code)->count())
        {
            return true;
        }

        if (Invoice::where('currency_code', '=', $this->code)->count())
        {
            return true;
        }

        return false;
    }

    public function getFormattedPlacementAttribute()
    {
        return ($this->placement == 'before') ? trans('bt.before_amount') : trans('bt.after_amount');
    }
}
