<?php

/**
 * This file is part of Scheduler Addon for FusionInvoice.
 * (c) Cytech <cytech@cytech-eng.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


namespace FI\Modules\Scheduler\Models;

use Illuminate\Database\Eloquent\Model;

class ScheduleResource extends Model {

    protected $table = 'schedule_resources';

    public $timestamps = false;

	protected $guarded = ['id'];


    public function schedule()
    {
        return $this->belongsTo('FI\Modules\Scheduler\Models\Schedule', 'schedule_id', 'id');
    }


}
