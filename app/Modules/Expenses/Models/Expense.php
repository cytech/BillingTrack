<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\Expenses\Models;

use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use BT\Events\CheckAttachment;
use BT\Support\CurrencyFormatter;
use BT\Support\DateFormatter;
use BT\Support\NumberFormatter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expense extends Model
{
    use SoftDeletes;

    use SoftCascadeTrait;

    protected $softCascade = ['attachments', 'custom'];

    protected $table = 'expenses';

    protected $guarded = ['id'];

    protected $dates = ['deleted_at'];

    protected $appends = ['formatted_description', 'formatted_expense_date', 'formatted_amount', 'is_billable', 'has_been_billed'];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function attachments()
    {
        return $this->morphMany('BT\Modules\Attachments\Models\Attachment', 'attachable');
    }

    public function category()
    {
        return $this->belongsTo('BT\Modules\Categories\Models\Category');
    }

    public function client()
    {
        return $this->belongsTo('BT\Modules\Clients\Models\Client');
    }

    public function companyProfile()
    {
        return $this->belongsTo('BT\Modules\CompanyProfiles\Models\CompanyProfile');
    }

    public function custom()
    {
        return $this->hasOne('BT\Modules\CustomFields\Models\ExpenseCustom');
    }

    public function invoice()
    {
        return $this->belongsTo('BT\Modules\Invoices\Models\Invoice');
    }

    public function vendor()
    {
        return $this->belongsTo('BT\Modules\Vendors\Models\Vendor');
    }

    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

    public function getAttachmentPathAttribute()
    {
        return attachment_path('expenses/' . $this->id);
    }

    public function getAttachmentPermissionOptionsAttribute()
    {
        return [
            '0' => trans('bt.not_visible'),
            '1' => trans('bt.visible'),
        ];
    }

    public function getFormattedAmountAttribute()
    {
        return CurrencyFormatter::format($this->amount);
    }

    public function getFormattedTaxAttribute()
    {
        return CurrencyFormatter::format($this->tax);
    }

    public function getFormattedDescriptionAttribute()
    {
        return nl2br($this->description);
    }

    public function getFormattedExpenseDateAttribute()
    {
        return DateFormatter::format($this->expense_date);
    }

    public function getFormattedNumericAmountAttribute()
    {
        return NumberFormatter::format($this->amount);
    }

    public function getFormattedNumericTaxAttribute()
    {
        return NumberFormatter::format($this->tax);
    }

    public function getHasBeenBilledAttribute()
    {
        if ($this->invoice_id)
        {
            return true;
        }

        return false;
    }

    public function getIsBillableAttribute()
    {
        if ($this->client_id)
        {
            return true;
        }

        return false;
    }

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */

    public function scopeCategoryId($query, $categoryId = null)
    {
        if ($categoryId)
        {
            $query->where('category_id', $categoryId);
        }

        return $query;
    }

    public function scopeCompanyProfileId($query, $companyProfileId = null)
    {
        if ($companyProfileId)
        {
            $query->where('company_profile_id', $companyProfileId);
        }

        return $query;
    }

    public function scopeDefaultQuery($query)
    {
        return $query->select('expenses.*', 'categories.name AS category_name',
            'vendors.name AS vendor_name', 'clients.unique_name AS client_name')
            ->join('categories', 'categories.id', '=', 'expenses.category_id')
            ->leftJoin('vendors', 'vendors.id', '=', 'expenses.vendor_id')
            ->leftJoin('clients', 'clients.id', '=', 'expenses.client_id');
    }

    public function scopeKeywords($query, $keywords = null)
    {
        if ($keywords)
        {
            $keywords = strtolower($keywords);

            $query->where('expenses.expense_date', 'like', '%' . $keywords . '%')
                ->orWhere('expenses.description', 'like', '%' . $keywords . '%')
                ->orWhere('vendors.name', 'like', '%' . $keywords . '%')
                ->orWhere('clients.name', 'like', '%' . $keywords . '%')
                ->orWhere('categories.name', 'like', '%' . $keywords . '%');
        }

        return $query;
    }

    public function scopeStatus($query, $status = null)
    {
        if ($status)
        {
            switch ($status)
            {
                case 'billed':
                    $query->where('invoice_id', '<>', 0);
                    break;
                case 'not_billed':
                    $query->where('client_id', '<>', 0)->where('invoice_id', '=', 0)->orWhere('invoice_id', '=', null);
                    break;
                case 'not_billable':
                    $query->where('client_id', 0);
                    break;
            }
        }

        return $query;
    }

    public function scopeVendorId($query, $vendorId = null)
    {
        if ($vendorId)
        {
            $query->where('vendor_id', $vendorId);
        }

        return $query;
    }

    public function scopeDateRange($query, $fromDate, $toDate)
    {
        return $query->where('expense_date', '>=', $fromDate)
            ->where('expense_date', '<=', $toDate);
    }
}
