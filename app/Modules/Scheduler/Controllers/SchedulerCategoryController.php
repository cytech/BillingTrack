<?php

/**
 * This file is part of BillingTrack.
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\Scheduler\Controllers;

use BT\DataTables\SchedulerCategoriesDataTable;
use BT\Http\Controllers\Controller;
use BT\Modules\Scheduler\Models\Category;
use BT\Modules\Scheduler\Requests\CategoryRequest;
use Illuminate\Http\Request;

class SchedulerCategoryController extends Controller {

    public function index(SchedulerCategoriesDataTable $dataTable)
    {

        return $dataTable->render('schedulecategories.index');
    }

	public function create() {
		return view( 'schedulecategories.create' );
	}

	public function store( CategoryRequest $request ) {
		$categories             = new Category;
		$categories->name       = $request->name;
		$categories->text_color = $request->text_color;
		$categories->bg_color   = $request->bg_color;
		$categories->save();

		return redirect()->route( 'scheduler.categories.index' )->with( 'alertSuccess', 'Successfully Created category!' );
	}

	public function show( $id ) {
		$categories = Category::find( $id );

		return view('schedule.schedulecategories.show', compact( 'categories' ) );
	}

	public function edit( $id ) {
		$categories = Category::find( $id );

		return view( 'schedulecategories.edit', compact( 'categories' ) );
	}

	public function update( CategoryRequest $request, $id ) {
		$categories             = Category::find( $id );
		$categories->name       = $request->name;
		$categories->text_color = $request->text_color;
		$categories->bg_color   = $request->bg_color;
		$categories->save();

		return redirect()->route( 'scheduler.categories.index' )->with( 'alertSuccess', 'Successfully Edited category!' );
	}

	public function delete( $id ) {

		$category = Category::find( $id );

        if ($category->in_use)
        {
            return redirect()->route('scheduler.categories.index')
                ->with('alert', trans('bt.cannot_delete_record_in_use'));
        }
        else
        {
            Category::destroy($id);

            return redirect()->route('scheduler.categories.index')
                ->with('alert', trans('bt.record_successfully_deleted'));

        }

	}
}
