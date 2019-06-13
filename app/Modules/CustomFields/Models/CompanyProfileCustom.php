<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\CustomFields\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompanyProfileCustom extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'company_profiles_custom';

    protected $primaryKey = 'company_profile_id';

    protected $guarded = [];
}
