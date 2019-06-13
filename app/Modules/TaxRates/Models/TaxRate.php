<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\TaxRates\Models;

use BT\Modules\Invoices\Models\InvoiceItem;
use BT\Modules\Quotes\Models\QuoteItem;
use BT\Modules\RecurringInvoices\Models\RecurringInvoiceItem;
use BT\Support\NumberFormatter;
use BT\Traits\Sortable;
use Illuminate\Database\Eloquent\Model;

class TaxRate extends Model
{
    use Sortable;

    /**
     * Guarded properties
     * @var array
     */
    protected $guarded = ['id'];

    protected $sortable = ['name', 'percent', 'is_compound'];

    /*
    |--------------------------------------------------------------------------
    | Static Methods
    |--------------------------------------------------------------------------
    */

    public static function getList()
    {
        return ['0' => trans('bt.none')] + self::pluck('name', 'id')->all();
    }

    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

    public function getFormattedPercentAttribute()
    {
        return NumberFormatter::format($this->attributes['percent'], null, 3) . '%';
    }

    public function getFormattedNumericPercentAttribute()
    {
        return NumberFormatter::format($this->attributes['percent'], null, 3);
    }

    public function getFormattedIsCompoundAttribute()
    {
        return ($this->attributes['is_compound']) ? trans('bt.yes') : trans('bt.no');
    }

    public function getInUseAttribute()
    {
        if (InvoiceItem::where('tax_rate_id', $this->id)->orWhere('tax_rate_2_id', $this->id)->count())
        {
            return true;
        }

        if (RecurringInvoiceItem::where('tax_rate_id', $this->id)->orWhere('tax_rate_2_id', $this->id)->count())
        {
            return true;
        }

        if (QuoteItem::where('tax_rate_id', $this->id)->orWhere('tax_rate_2_id', $this->id)->count())
        {
            return true;
        }

        if (config('bt.itemTaxRate') == $this->id or config('bt.itemTax2Rate') == $this->id)
        {
            return true;
        }

        return false;
    }
}
