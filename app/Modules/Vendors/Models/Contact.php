<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\Vendors\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use SoftDeletes;

    protected $table = 'vendor_contacts';

    protected $dates = ['deleted_at'];

    protected $guarded = ['id'];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function vendor()
    {
        return $this->belongsTo('FI\Modules\Vendors\Models\Vendor');
    }

    public function title()
    {
        return $this->belongsTo('FI\Modules\Titles\Models\Title');
    }

    public function notes()
    {
        return $this->morphMany('FI\Modules\Notes\Models\Note', 'notable');
    }

    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

    public function getFormattedContactAttribute()
    {
        return $this->name . ' <' . $this->email . '>';
    }

    public function getFormattedDefaultBccAttribute()
    {
        return ($this->default_bcc) ? trans('fi.yes') : trans('fi.no');
    }

    public function getFormattedDefaultCcAttribute()
    {
        return ($this->default_cc) ? trans('fi.yes') : trans('fi.no');
    }

    public function getFormattedDefaultToAttribute()
    {
        return ($this->default_to) ? trans('fi.yes') : trans('fi.no');
    }

    public function getFormattedIsPrimaryAttribute()
    {
        return ($this->is_primary) ? trans('fi.yes') : trans('fi.no');
    }

    public function getFormattedOptinAttribute()
    {
        return ($this->optin) ? trans('fi.yes') : trans('fi.no');
    }
}
