<?php

namespace BT\Observers;

use BT\Modules\CustomFields\Models\UserCustom;
use BT\Modules\Users\Models\User;

class UserObserver
{
    /**
     * Handle the user "created" event.
     *
     * @param  \BT\Modules\Users\Models\User  $user
     * @return void
     */
    public function created(User $user): void
    {
        $user->custom()->save(new UserCustom());

    }
}
