<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\Activity\Models;

use BT\Support\DateFormatter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Activity extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'activities';

    protected $guarded = ['id'];

    public function audit()
    {
        return $this->morphTo();
    }

    public function getFormattedActivityAttribute()
    {
        if ($this->audit)
        {
            switch ($this->audit_type)
            {
                case 'BT\Modules\Quotes\Models\Quote':

                    switch ($this->activity)
                    {
                        case 'public.viewed':
                            return trans('bt.activity_quote_viewed', ['number' => $this->audit->number, 'link' => route('quotes.edit', [$this->audit->id])]);
                            break;

                        case 'public.approved':
                            return trans('bt.activity_quote_approved', ['number' => $this->audit->number, 'link' => route('quotes.edit', [$this->audit->id])]);
                            break;

                        case 'public.rejected':
                            return trans('bt.activity_quote_rejected', ['number' => $this->audit->number, 'link' => route('quotes.edit', [$this->audit->id])]);
                            break;
                    }

                    break;

                case 'BT\Modules\Workorders\Models\Workorder':

                    switch ($this->activity)
                    {
                        case 'public.viewed':
                            return trans('bt.activity_workorder_viewed', ['number' => $this->audit->number, 'link' => route('workorders.edit', [$this->audit->id])]);
                            break;

                        case 'public.approved':
                            return trans('bt.activity_workorder_approved', ['number' => $this->audit->number, 'link' => route('workorders.edit', [$this->audit->id])]);
                            break;

                        case 'public.rejected':
                            return trans('bt.activity_workorder_rejected', ['number' => $this->audit->number, 'link' => route('workorders.edit', [$this->audit->id])]);
                            break;
                    }

                    break;

                case 'BT\Modules\Invoices\Models\Invoice':

                    switch ($this->activity)
                    {
                        case 'public.viewed':
                            return trans('bt.activity_invoice_viewed', ['number' => $this->audit->number, 'link' => route('invoices.edit', [$this->audit->id])]);
                            break;
                        case 'public.paid':
                            return trans('bt.activity_invoice_paid', ['number' => $this->audit->number, 'link' => route('invoices.edit', [$this->audit->id])]);
                            break;
                    }

                    break;
            }
        }

        return '';
    }

    public function getFormattedCreatedAtAttribute()
    {
        return DateFormatter::format($this->created_at, true);
    }
}
