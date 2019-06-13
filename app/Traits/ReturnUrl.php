<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Traits;

trait ReturnUrl
{
    public function setReturnUrl()
    {
        session(['returnUrl' => request()->fullUrl()]);
    }

    public function getReturnUrl()
    {
        return session('returnUrl');
    }
}
