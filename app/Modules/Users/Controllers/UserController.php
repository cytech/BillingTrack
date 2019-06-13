<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\Users\Controllers;

use BT\Http\Controllers\Controller;
use BT\Modules\Clients\Models\Client;
use BT\Modules\CustomFields\Models\CustomField;
use BT\Modules\Users\Models\User;
use BT\Modules\Users\Requests\UserStoreRequest;
use BT\Modules\Users\Requests\UserUpdateRequest;
use BT\Traits\ReturnUrl;
use BT\DataTables\UsersDataTable;

class UserController extends Controller
{
    use ReturnUrl;


    public function index(UsersDataTable $dataTable)
    {
        $this->setReturnUrl();

        return $dataTable->render('users.index',
            ['userTypes'=> ['' => trans('bt.all_accounts'), 'admin' => trans('bt.admin_accounts'), 'client' => trans('bt.client_accounts')]]);

    }

    public function create($userType)
    {
        $view = view('users.' . $userType . '_form')
            ->with('editMode', false)
            ->with('customFields', CustomField::forTable('users')->get());

        if ($userType == 'client')
        {
            $view->with('clients', Client::whereDoesntHave('user')
                ->where('email', '<>', '')
                ->whereNotNull('email')
                ->where('active', 1)
                ->orderBy('unique_name')
                ->pluck('unique_name', 'id')
                ->toArray()
            );
        }

        return $view;
    }

    public function store(UserStoreRequest $request, $userType)
    {
        $user = new User($request->except('custom'));

        $user->password = $request->input('password');

        $user->save();

        $user->custom->update($request->input('custom', []));

        return redirect($this->getReturnUrl())
            ->with('alertSuccess', trans('bt.record_successfully_created'));
    }

    public function edit($id, $userType)
    {
        $user = User::find($id);

        return view('users.' . $userType . '_form')
            ->with(['editMode' => true, 'user' => $user])
            ->with('customFields', CustomField::forTable('users')->get());
    }

    public function update(UserUpdateRequest $request, $id, $userType)
    {
        $user = User::find($id);

        $user->fill($request->except('custom'));

        $user->save();

        $user->custom->update($request->input('custom', []));

        return redirect($this->getReturnUrl())
            ->with('alertInfo', trans('bt.record_successfully_updated'));
    }

    public function delete($id)
    {
        User::destroy($id);

        return redirect()->route('users.index')
            ->with('alert', trans('bt.record_successfully_deleted'));
    }

    public function getClientInfo()
    {
        return Client::find(request('id'));
    }
}
