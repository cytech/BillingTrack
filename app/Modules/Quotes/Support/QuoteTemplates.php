<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\Quotes\Support;

use BT\Support\Directory;

class QuoteTemplates
{
    /**
     * Returns an array of quote templates.
     *
     * @return array
     */
    public static function lists()
    {
        $defaultTemplates = Directory::listAssocContents(app_path('Modules/Templates/Views/templates/quotes'));

        $customTemplates = Directory::listAssocContents(base_path('custom/templates/quote_templates'));

        return $defaultTemplates + $customTemplates;
    }
}
