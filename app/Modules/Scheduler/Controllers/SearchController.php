<?php

/**
 * This file is part of BillingTrack.
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\Scheduler\Controllers;

use BT\Http\Controllers\Controller;
use BT\Modules\Employees\Models\Employee;
use BT\Modules\Clients\Models\Client;

class SearchController extends Controller {

	public function customer() {
		if ( isset( $_REQUEST['term'] ) ) {
			$term    = $_REQUEST['term'];
			$results = [];
			$queries = Client::where( 'name', 'LIKE', '%' . $term . '%' )->where( 'active', '1' )->get();

			if ( ! $queries->isEmpty() ) {
				foreach ( $queries as $query ) {
					$results[] = $query->name;
				}
			}
			echo json_encode( $results ); //Return the JSON Array
		}
	}

	public function employee() {
		if ( isset( $_REQUEST['term'] ) ) {
			$term    = $_REQUEST['term'];
			$results = [];
			$queries = Employee::where( 'full_name', 'LIKE', '%' . $term . '%' )->where( 'active', '=', 1 )->get();

			if ( ! $queries->isEmpty() ) {
				foreach ( $queries as $query ) {
					$results[] = $query->short_name;
				}
			}
			echo json_encode( $results ); //Return the JSON Array
		}
	}
}
