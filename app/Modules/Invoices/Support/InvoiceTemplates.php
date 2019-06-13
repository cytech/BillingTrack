<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\Invoices\Support;

use BT\Support\Directory;

class InvoiceTemplates
{
    /**
     * Returns an array of invoice templates.
     *
     * @return array
     */
    public static function lists()
    {
        $defaultTemplates = Directory::listAssocContents(app_path('Modules/Templates/Views/templates/invoices'));

        $customTemplates = Directory::listAssocContents(base_path('custom/templates/invoice_templates'));

        return $defaultTemplates + $customTemplates;
    }
}
