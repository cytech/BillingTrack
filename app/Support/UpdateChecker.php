<?php

/**
 * This file is part of FusionInvoiceFOSS.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Support;

class UpdateChecker
{
    protected $currentVersion;

    public function __construct()
    {
        $options = array('http' => array('user_agent' => 'FusionInvoice-FOSS'));
        $context = stream_context_create($options);

        $this->currentVersion = json_decode(file_get_contents('https://api.github.com/repos/cytech/FusionInvoice-FOSS/releases/latest', false, $context), true)['tag_name'];

    }

    /**
     * Check to see if there is a newer version available for download.
     *
     * @return boolean
     */
    public function updateAvailable()
    {
        if (str_replace('v', '', $this->currentVersion) > config('fi.version'))
        {
            return true;
        }

        return false;
    }

    /**
     * Getter for current version.
     *
     * @return string
     */
    public function getCurrentVersion()
    {
        return $this->currentVersion;
    }
}