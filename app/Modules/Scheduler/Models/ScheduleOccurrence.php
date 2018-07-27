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
use Carbon\Carbon;


class ScheduleOccurrence extends Model {

	public $timestamps = true;

    protected $primaryKey = 'oid';

    protected $table = 'schedule_occurrences';

	protected $guarded = ['oid'];

	protected $dates = ['start_date','end_date'];

	//need after schedule->withOccurrences change..
	public function getStartDateAttribute() {
		return Carbon::parse( $this->attributes['start_date'] )->format( 'Y-m-d H:i' );
	}

	public function getEndDateAttribute() {
		return Carbon::parse( $this->attributes['end_date'] )->format( 'Y-m-d H:i' );
	}

    public function schedule()
    {
        return $this->belongsTo('FI\Modules\Scheduler\Models\Schedule', 'schedule_id', 'id');
    }


}
