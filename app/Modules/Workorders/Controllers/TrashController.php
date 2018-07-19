<?php


/**
 * This file is part of Workorder Addon for FusionInvoice.
 * (c) Cytech <cytech@cytech-eng.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


namespace Addons\Workorders\Controllers;

use Addons\Workorders\Models\Workorder;
use Addons\Workorders\Repositories\WorkorderToSchedulerRepository;
use FI\Http\Controllers\Controller;
use Session;
use Illuminate\Http\Request;

class TrashController extends Controller {

	public function __construct(WorkorderToSchedulerRepository $workorderToSchedulerRepository)
	{
		$this->workorderToSchedulerRepository = $workorderToSchedulerRepository;
	}

	public function trash() {
		$data['events'] = Workorder::onlyTrashed()->orderBy( 'id' )->get();

		return view( 'trash.trash', $data );
	}

	public function trashWorkorder( Request $request ) {
		$event = Workorder::find( $request->id );
		$event->delete();
		// trash the event in Scheduler
		if (config('workorder_settings.scheduler')) {
			$this->workorderToSchedulerRepository->trash($request->id);
		}
		return redirect()->route( 'workorders.index' )->with('alertSuccess', trans('Workorders::texts.single_workorder_trash_success'));;
	}

	public function bulkTrash()
	{
		foreach (Workorder::whereIn('id',request('ids'))->get() as $delworkorder){

			$delworkorder->delete();
			if (config('workorder_settings.scheduler')) {
				$this->workorderToSchedulerRepository->trash($delworkorder->id);
			}
		}

	}

	public function deleteSingleTrash( Request $request ) {
		Workorder::onlyTrashed()->where( 'id', $request->id )->forceDelete();
		if (config('workorder_settings.scheduler')) {
			$this->workorderToSchedulerRepository->delete($request->id);
		}

		return 'true';
	}

	public function deleteAllTrash() {
		foreach (Workorder::onlyTrashed()->get() as $workorder) {
			$workorder->forceDelete();
			if (config('workorder_settings.scheduler')) {
				$this->workorderToSchedulerRepository->delete($workorder->id);
			}
		}

		return back()->with('alertSuccess', trans('Workorders::texts.trash_delete_success') );
	}

	public function restoreSingleTrash( Request $request ) {
		Workorder::onlyTrashed()->find($request->id)->restore();
		// Delete the event in Scheduler
		if (config('workorder_settings.scheduler')) {
			$this->workorderToSchedulerRepository->untrash($request->id);
		}

		return 'true';
	}

	public function restoreAllTrash() {
		foreach (Workorder::onlyTrashed()->get() as $resworkorder) {
			$resworkorder->restore();
			if ( config( 'workorder_settings.scheduler' ) ) {
				$this->workorderToSchedulerRepository->untrash( $resworkorder->id );
			}
		}

		return back()->with('alertSuccess',trans('Workorders::texts.trash_restore_success') );
	}

	public function bulkDeleteTrash()
	{
		foreach (Workorder::onlyTrashed()->whereIn('id',request('ids'))->get() as $delworkorder){

			$delworkorder->forceDelete();
			if (config('workorder_settings.scheduler')) {
				$this->workorderToSchedulerRepository->delete($delworkorder->id);
			}
		}
	}

	public function bulkRestoreTrash()
	{
		foreach (Workorder::onlyTrashed()->whereIn('id',request('ids'))->get() as $resworkorder){
			$resworkorder->restore();
			if (config('workorder_settings.scheduler')) {
				$this->workorderToSchedulerRepository->untrash($resworkorder->id);
			}
		}
	}
}