<?php

use BT\Support\ProfileImage\ProfileImageFactory;

function profileImageUrl($user)
{
    $profileImage = ProfileImageFactory::create();

    return $profileImage->getProfileImageUrl($user);
}
