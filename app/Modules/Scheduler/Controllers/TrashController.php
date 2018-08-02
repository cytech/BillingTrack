<?php


/**
 * This file is part of FusionInvoiceFOSS.
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


namespace FI\Modules\Scheduler\Controllers;

use FI\Http\Controllers\Controller;
use FI\Modules\Scheduler\Models\Schedule;
use FI\Modules\Scheduler\Models\ScheduleReminder;
use Session;
use Illuminate\Http\Request;

class TrashController extends Controller {

	public function eventTrash() {
//		$data['events'] = Schedule::withOccurrences()->onlyTrashed()->orderBy( 'id', 'desc' )->get();
		//replaced to allow only first occurrence of recurring event
		$data['events'] = Schedule::with(['occurrences' => function ($q) {
			$q->latest();
		}])->onlyTrashed()->orderBy( 'id', 'desc' )->get();

		return view('schedule.eventTrash', $data );
	}

	public function trashEvent($id ) {
		$event = Schedule::find( $id );
		$event->delete();

		//return 'true';
        return response()->json(['success' => trans('fi.record_successfully_trashed')], 200);
	}

	public function trashReminder( Request $request ) {
		$event = ScheduleReminder::find( $request->id );
		$event->delete();

		return 'true';
	}

	public function deleteSingleTrash( Request $request ) {
		Schedule::onlyTrashed()->where( 'id', $request->id )->forceDelete();

		return 'true';
	}

	public function deleteAllTrash() {
		Schedule::onlyTrashed()->forceDelete();
		Session::flash( 'alertSuccess', trans('fi.trash_delete_success' ));

		return redirect()->route( 'scheduler.tableevent' );
	}

	public function restoreSingleTrash( Request $request ) {
		Schedule::onlyTrashed()->where( 'id', $request->input( 'id' ) )->restore();

		return 'true';
	}

	public function restoreAllTrash() {
		Schedule::onlyTrashed()->restore();
		Session::flash( 'alertSuccess', trans('fi.trash_restore_success' ));

		return redirect()->route( 'scheduler.tableevent' );
	}

	public function bulkTrash()
	{
		foreach (Schedule::whereIn('id',request('ids'))->get() as $delschedule){

			$delschedule->delete();

		}
        return response()->json(['success' => trans('fi.record_successfully_trashed')], 200);

	}

	public function bulkDeleteTrash()
	{
		foreach (Schedule::onlyTrashed()->whereIn('id',request('ids'))->get() as $delschedule){

			$delschedule->forceDelete();

		}
	}

	public function bulkRestoreTrash()
	{
		foreach (Schedule::onlyTrashed()->whereIn('id',request('ids'))->get() as $resschedule){
			$resschedule->restore();

		}
	}
}