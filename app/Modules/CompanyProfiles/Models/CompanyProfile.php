<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\CompanyProfiles\Models;

use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use BT\Modules\Expenses\Models\Expense;
use BT\Modules\Invoices\Models\Invoice;
use BT\Modules\Quotes\Models\Quote;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompanyProfile extends Model
{
    use SoftDeletes;

    use SoftCascadeTrait;

    protected $softCascade = ['custom'];

    protected $guarded = ['id'];

    public static function getList()
    {
        return self::orderBy('company')->pluck('company', 'id')->all();
    }

    public static function inUse($id)
    {
        if (Invoice::where('company_profile_id', $id)->count())
        {
            return true;
        }

        if (Quote::where('company_profile_id', $id)->count())
        {
            return true;
        }

        if (Expense::where('company_profile_id', $id)->count())
        {
            return true;
        }

        if (config('bt.defaultCompanyProfile') == $id)
        {
            return true;
        }

        return false;
    }

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function custom()
    {
        return $this->hasOne('BT\Modules\CustomFields\Models\CompanyProfileCustom');
    }

    public function currency()
    {
        return $this->belongsTo('BT\Modules\Currencies\Models\Currency', 'currency_code', 'code');
    }

    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

    public function getFormattedAddressAttribute()
    {
        return nl2br(formatAddress($this));
    }

    public function getFormattedAddress2Attribute()
    {
        return nl2br(formatAddress2($this));
    }

    public function getLogoUrlAttribute()
    {
        if ($this->logo)
        {
            return route('companyProfiles.logo', [$this->id]);
        }
    }

    public function logo($width = null, $height = null)
    {
        if ($this->logo and file_exists(storage_path($this->logo)))
        {
            $logo = base64_encode(file_get_contents(storage_path($this->logo)));

            $style = '';

            if ($width and !$height)
            {
                $style = 'width: ' . $width . 'px;';
            }
            elseif ($width and $height)
            {
                $style = 'width: ' . $width . 'px; height: ' . $height . 'px;';
            }

            return '<img id="cp-logo" src="data:image/png;base64,' . $logo . '" style="' . $style . '">';
        }

        return null;
    }
}
