<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\Sessions\Controllers;

use BT\Http\Controllers\Controller;
use BT\Modules\Sessions\Requests\SessionRequest;

class SessionController extends Controller
{
    public function login()
    {
        deleteTempFiles();
        deleteViewCache();

        return view('sessions.login');
    }

    public function attempt(SessionRequest $request)
    {
        $rememberMe = ($request->input('remember_me')) ? true : false;

        if (!auth()->attempt(['email' => $request->input('email'), 'password' => $request->input('password')], $rememberMe))
        {
            return redirect()->route('session.login')->with('error', trans('bt.invalid_credentials'));
        }

        if (!auth()->user()->client_id)
        {
            return redirect()->route('dashboard.index');
        }

        return redirect()->route('clientCenter.dashboard');

    }

    public function logout()
    {
        auth()->logout();

        session()->flush();

        return redirect()->route('session.login');
    }
}
