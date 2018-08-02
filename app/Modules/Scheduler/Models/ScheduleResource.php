<?php

/**
 * This file is part of FusionInvoiceFOSS.
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


namespace FI\Modules\Scheduler\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ScheduleResource extends Model {

    use SoftDeletes;

    protected $table = 'schedule_resources';

    public $timestamps = false;

	protected $guarded = ['id'];

    protected $dates = ['deleted_at'];


    public function schedule()
    {
        return $this->belongsTo('FI\Modules\Scheduler\Models\Schedule', 'schedule_id', 'id');
    }


}
