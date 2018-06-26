<?php

/**
 * This file is part of FusionInvoiceFOSS.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\Users\Controllers;

use FI\Http\Controllers\Controller;
use FI\Requests;
use FI\Modules\Users\Models\User;
use FI\DataTables\UsersDataTable;
use Yajra\DataTables\DataTables;

class DatatablesController extends Controller
{
//    /**
//     * Displays datatables front end view
//     *
//     * @return \Illuminate\View\View
//     */
//    public function getIndex()
//    {
//        return view('users.dtindex');
//    }
//
//    /**
//     * Process datatables ajax request.
//     *
//     * @return \Illuminate\Http\JsonResponse
//     */
//    public function anyData()
//    {
//        return DataTables::of(User::query())->make(true);
//    }

    public function index(UsersDataTable $dataTable)
    {

        return $dataTable->render('users.dtindex',
            ['userTypes'=> ['' => trans('fi.all_accounts'), 'admin' => trans('fi.admin_accounts'), 'client' => trans('fi.client_accounts')]]);

    }

}