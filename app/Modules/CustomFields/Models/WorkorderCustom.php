<?php

/**
 * This file is part of Workorders Addon for FusionInvoice.
 * (c) Cytech <cytech@cytech-eng.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\CustomFields\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkorderCustom extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    /**
     * The table name
     * @var string
     */
    protected $table = 'workorders_custom';

    /**
     * The primary key
     * @var string
     */
    protected $primaryKey = 'workorder_id';

    /**
     * Guarded properties
     * @var array
     */
    protected $guarded = [];
}