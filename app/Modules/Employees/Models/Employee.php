<?php

/**
 * This file is part of Workorders Addon for FusionInvoice.
 * (c) Cytech <cytech@cytech-eng.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\Employees\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    /**
     * Guarded properties
     * @var array
     */
    protected $guarded = ['id'];

	protected $table = 'employees';

    public function workorderitem()
    {
        return $this->belongsTo('FI\Modules\Workorders\Models\WorkorderItem','resource_id', 'id')
            ->where('resource_table','=','employees');
    }


}
