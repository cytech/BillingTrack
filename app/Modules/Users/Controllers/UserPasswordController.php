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
use BT\Modules\Users\Models\User;
use BT\Modules\Users\Requests\UpdatePasswordRequest;
use BT\Traits\ReturnUrl;

class UserPasswordController extends Controller
{
    use ReturnUrl;

    public function edit($id)
    {
        return view('users.password_form')
            ->with('user', User::find($id));
    }

    public function update(UpdatePasswordRequest $request, $id)
    {
        $user = User::find($id);

        $user->password = $request->input('password');

        $user->save();

        return redirect($this->getReturnUrl())
            ->with('alertInfo', trans('bt.password_successfully_reset'));
    }
}
