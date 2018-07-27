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

class Category extends Model {
	protected $table = 'schedule_categories';

	public $timestamps = false;

	protected $fillable = [ 'name', 'text_color', 'bg_color' ];
}
