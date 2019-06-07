<?php

namespace FI\Observers;

use FI\Modules\CustomFields\Models\UserCustom;
use FI\Modules\Users\Models\User;

class UserObserver
{
    /**
     * Handle the user "created" event.
     *
     * @param  \FI\Modules\Users\Models\User  $user
     * @return void
     */
    public function created(User $user): void
    {
        $user->custom()->save(new UserCustom());

    }
}
