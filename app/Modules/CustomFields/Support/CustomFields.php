<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\CustomFields\Support;

class CustomFields
{
    /**
     * Provide an array of available custom table names.
     *
     * @return array
     */
    public static function tableNames()
    {
        return [
            'clients'            => trans('bt.clients'),
            'vendors'            => trans('bt.vendors'),
            'company_profiles'   => trans('bt.company_profiles'),
            'expenses'           => trans('bt.expenses'),
            'invoices'           => trans('bt.invoices'),
            'workorders'         => trans('bt.workorders'),
            'quotes'             => trans('bt.quotes'),
            'recurring_invoices' => trans('bt.recurring_invoices'),
            'payments'           => trans('bt.payments'),
            'purchaseorders'     => trans('bt.purchaseorders'),
            'users'              => trans('bt.users'),
        ];
    }

    /**
     * Provide an array of available custom field types.
     *
     * @return array
     */
    public static function fieldTypes()
    {
        return [
            'text'     => trans('bt.text'),
            'dropdown' => trans('bt.dropdown'),
            'textarea' => trans('bt.textarea'),
        ];
    }
}
