<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\Purchaseorders\Support;

use BT\Support\Directory;

class PurchaseorderTemplates
{
    /**
     * Returns an array of purchaseorder templates.
     *
     * @return array
     */
    public static function lists()
    {
        $defaultTemplates = Directory::listAssocContents(app_path('Modules/Templates/Views/templates/purchaseorders'));

        $customTemplates = Directory::listAssocContents(base_path('custom/templates/purchaseorder_templates'));

        return $defaultTemplates + $customTemplates;
    }
}
