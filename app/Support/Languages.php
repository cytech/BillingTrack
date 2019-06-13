<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Support;

class Languages
{
    /**
     * Provide a list of the available language translations.
     *
     * @return array
     */
    static function listLanguages()
    {
        $directories = Directory::listContents(base_path('resources/lang'));

        $languages = [];

        foreach ($directories as $directory)
        {
            $languages[$directory] = $directory;
        }

        return $languages;
    }
}
