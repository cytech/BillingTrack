<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Composers;

class LayoutComposer
{
    public function compose($view)
    {
        $view->with('userName', auth()->user()->name);
        $view->with('profileImageUrl', profileImageUrl(auth()->user()));
    }
}
