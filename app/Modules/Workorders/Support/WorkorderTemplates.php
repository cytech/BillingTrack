<?php

/**
 * This file is part of BillingTrack.
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


namespace BT\Modules\Workorders\Support;

use BT\Support\Directory;

class WorkorderTemplates
{
    /**
     * Returns an array of workorder templates.
     *
     * @return array
     */
    public static function lists()
    {
        $defaultTemplates = Directory::listAssocContents(app_path('Modules/Templates/Views/templates/workorders'));

        $customTemplates = Directory::listAssocContents(base_path('custom/templates/workorder_templates'));

        return $defaultTemplates + $customTemplates;
    }
}
