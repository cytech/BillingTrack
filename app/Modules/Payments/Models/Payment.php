<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\Payments\Models;

use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Carbon\Carbon;
use BT\Support\CurrencyFormatter;
use BT\Support\DateFormatter;
use BT\Support\FileNames;
use BT\Support\HTML;
use BT\Support\NumberFormatter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Payment extends Model
{
    use SoftDeletes;

    use SoftCascadeTrait;

    protected $softCascade = ['custom', 'mailQueue', 'notes'];

    /**
     * Guarded properties
     * @var array
     */
    protected $guarded = ['id'];

    protected $dates = ['paid_at','deleted_at'];

    protected $appends = ['formatted_paid_at','formatted_amount'];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function client()
    {
        return $this->belongsTo('BT\Modules\Clients\Models\Client');
    }

    public function custom()
    {
        return $this->hasOne('BT\Modules\CustomFields\Models\PaymentCustom');
    }

    public function invoice()
    {
        return $this->belongsTo('BT\Modules\Invoices\Models\Invoice');
    }

    public function mailQueue()
    {
        return $this->morphMany('BT\Modules\MailQueue\Models\MailQueue', 'mailable');
    }

    public function notes()
    {
        return $this->morphMany('BT\Modules\Notes\Models\Note', 'notable');
    }

    public function paymentMethod()
    {
        return $this->belongsTo('BT\Modules\PaymentMethods\Models\PaymentMethod');
    }

    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

    public function getFormattedPaidAtAttribute()
    {
        return DateFormatter::format($this->attributes['paid_at']);
    }

    public function getFormattedAmountAttribute()
    {
        return CurrencyFormatter::format($this->attributes['amount'], $this->invoice->currency);
    }

    public function getFormattedNumericAmountAttribute()
    {
        return NumberFormatter::format($this->attributes['amount']);
    }

    public function getFormattedNoteAttribute()
    {
        return nl2br($this->attributes['note']);
    }

    public function getUserAttribute()
    {
        return $this->invoice->user;
    }

    public function getHtmlAttribute()
    {
        return HTML::invoice($this->invoice);
    }

    public function getPdfFilenameAttribute()
    {
        return FileNames::invoice($this->invoice);
    }

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */

    public function scopeYearToDate($query)
    {
        return $query->where('paid_at', '>=', date('Y') . '-01-01')
            ->where('paid_at', '<=', date('Y') . '-12-31');
    }

    public function scopeThisQuarter($query)
    {
        return $query->where('paid_at', '>=', Carbon::now()->firstOfQuarter())
            ->where('paid_at', '<=', Carbon::now()->lastOfQuarter());
    }

    public function scopeDateRange($query, $from, $to)
    {
        return $query->where('paid_at', '>=', $from)->where('paid_at', '<=', $to);
    }

    public function scopeYear($query, $year)
    {
        return $query->where('paid_at', '>=', $year . '-01-01')
            ->where('paid_at', '<=', $year . '-12-31');
    }

    public function scopeKeywords($query, $keywords)
    {
        if ($keywords)
        {
            $keywords = strtolower($keywords);

            $query->where('payments.created_at', 'like', '%' . $keywords . '%')
                ->orWhereIn('invoice_id', function ($query) use ($keywords)
                {
                    $query->select('id')->from('invoices')->where(DB::raw('lower(number)'), 'like', '%' . $keywords . '%')
                        ->orWhere('summary', 'like', '%' . $keywords . '%')
                        ->orWhereIn('client_id', function ($query) use ($keywords)
                        {
                            $query->select('id')->from('clients')->where(DB::raw("CONCAT_WS('^',LOWER(name),LOWER(unique_name))"), 'like', '%' . $keywords . '%');
                        });
                })
                ->orWhereIn('payment_method_id', function ($query) use ($keywords)
                {
                    $query->select('id')->from('payment_methods')->where(DB::raw('lower(name)'), 'like', '%' . $keywords . '%');
                });
        }

        return $query;
    }

    public function scopeClientId($query, $clientId)
    {
        if ($clientId)
        {
            $query->whereHas('invoice', function ($query) use ($clientId)
            {
                $query->where('client_id', $clientId);
            });
        }

        return $query;
    }

    public function scopeInvoiceId($query, $invoiceId)
    {
        if ($invoiceId)
        {
            $query->whereHas('invoice', function ($query) use ($invoiceId)
            {
                $query->where('id', $invoiceId);
            });
        }

        return $query;
    }

    public function scopeInvoiceNumber($query, $invoiceNumber)
    {
        if ($invoiceNumber)
        {
            $query->whereHas('invoice', function ($query) use ($invoiceNumber)
            {
                $query->where('number', $invoiceNumber);
            });
        }

        return $query;
    }
}
