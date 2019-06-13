<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Support\ProfileImage\Drivers;

use BT\Modules\Users\Models\User;
use BT\Support\ProfileImage\ProfileImageInterface;

class Gravatar implements ProfileImageInterface
{
    public function getProfileImageUrl(User $user)
    {
        return 'https://www.gravatar.com/avatar/' . md5(strtolower($user->email)) . '?d=mm';
    }
}
