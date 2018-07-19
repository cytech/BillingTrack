<?php

/**
 * This file is part of Workorders Addon for FusionInvoice.
 * (c) Cytech <cytech@cytech-eng.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Addons\Workorders\Models;

use Illuminate\Database\Eloquent\Model;

class WorkorderCustom extends Model
{
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