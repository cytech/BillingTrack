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
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;


class ScheduleOccurrence extends Model {

    use SoftDeletes;

	public $timestamps = true;

    protected $primaryKey = 'oid';

    protected $table = 'schedule_occurrences';

	protected $guarded = ['oid'];

	protected $dates = ['start_date','end_date', 'deleted_at'];

	protected $appends = ['start_date', 'end_date'];

    public function schedule()
    {
        return $this->belongsTo('FI\Modules\Scheduler\Models\Schedule', 'schedule_id', 'id');
    }

    //getters
    public function getStartDateAttribute() {
        return Carbon::parse( $this->attributes['start_date'] )->format( 'Y-m-d H:i' );
    }

    public function getEndDateAttribute() {
        return Carbon::parse( $this->attributes['end_date'] )->format( 'Y-m-d H:i' );
    }



}
