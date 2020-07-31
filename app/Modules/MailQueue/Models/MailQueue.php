<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\MailQueue\Models;

use BT\Support\DateFormatter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MailQueue extends Model
{
    use SoftDeletes;

    protected $table = 'mail_queue';

    protected $guarded = [];

    protected $appends = ['formatted_created_at', 'formatted_from', 'formatted_to', 'formatted_cc', 'formatted_bcc', 'formatted_sent'];

    /*
    |--------------------------------------------------------------------------
    | Static Methods
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */
    public function mailable()
    {
        return $this->morphTo();
    }

    public function getFormattedCreatedAtAttribute()
    {
        return DateFormatter::format($this->attributes['created_at'], true);
    }

    public function getFormattedFromAttribute()
    {
        $from = json_decode($this->attributes['from']);

        return $from->email;
    }

    public function getFormattedToAttribute()
    {
        return implode(', ', json_decode($this->attributes['to']));
    }

    public function getFormattedCcAttribute()
    {
        return implode(', ', json_decode($this->attributes['cc']));
    }

    public function getFormattedBccAttribute()
    {
        return implode(', ', json_decode($this->attributes['bcc']));
    }

    public function getFormattedSentAttribute()
    {
        return ($this->attributes['sent']) ? trans('bt.yes') : trans('bt.no');
    }

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */

    public function scopeKeywords($query, $keywords = null)
    {
        if ($keywords)
        {
            $keywords = strtolower($keywords);

            $query->where('created_at', 'like', '%' . $keywords . '%')
                ->orWhere('from', 'like', '%' . $keywords . '%')
                ->orWhere('to', 'like', '%' . $keywords . '%')
                ->orWhere('cc', 'like', '%' . $keywords . '%')
                ->orWhere('bcc', 'like', '%' . $keywords . '%')
                ->orWhere('subject', 'like', '%' . $keywords . '%');
        }

        return $query;
    }

}
