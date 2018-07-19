<?php

/**
 * This file is part of Workorders Addon for FusionInvoice.
 * (c) Cytech <cytech@cytech-eng.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Addons\Workorders\Controllers;

use Addons\Workorders\Support\WorkorderTemplates;
use FI\Http\Controllers\Controller;
use FI\Modules\Groups\Models\Group;
use FI\Support\Statuses\QuoteStatuses;
use Addons\Workorders\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller {

	public function index() {

		return view( 'workorders.settings' )
			->with( [
				'workorderTemplates'      => WorkorderTemplates::lists(),
				'groups'                  => Group::getList(),
				'convertWorkorderOptions' => [
					'workorder' => trans( 'Workorders::texts.convert_workorder_option1' ),
					'invoice'   => trans( 'Workorders::texts.convert_workorder_option2' )
				],
				'workorderStatuses'       => QuoteStatuses::listsAllFlat(),
			] );
	}

	public function update( Request $request ) {
		foreach ( $request->except('_token') as $key => $value ) {
			if ( $key == 'scheduler' && $value == 1 ) {
				if ( empty( config( 'schedule_settings.version' ) ) ) {
					return redirect()->route( 'workorders.settings' )
					                 ->with( 'error', trans( 'Workorders::texts.NoScheduler' ) );
				}
			}
			$setting                = Setting::firstOrNew( [ 'setting_key' => $key ] );
			$setting->setting_value = $value;
			$setting->save();
		}

		return redirect()->route( 'workorders.settings' )
		                 ->with( 'alertSuccess', trans( 'Workorders::texts.settings_success' ) );
	}


}