<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Support\ProfileImage;

use BT\Modules\Users\Models\User;

interface ProfileImageInterface
{
    public function getProfileImageUrl(User $user);
}
