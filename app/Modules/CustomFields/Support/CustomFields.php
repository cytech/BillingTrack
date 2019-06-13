<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\CustomFields\Support;

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
            'clients'            => trans('fi.clients'),
            'vendors'            => trans('fi.vendors'),
            'company_profiles'   => trans('fi.company_profiles'),
            'expenses'           => trans('fi.expenses'),
            'invoices'           => trans('fi.invoices'),
            'workorders'         => trans('fi.workorders'),
            'quotes'             => trans('fi.quotes'),
            'recurring_invoices' => trans('fi.recurring_invoices'),
            'payments'           => trans('fi.payments'),
            'users'              => trans('fi.users'),
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
            'text'     => trans('fi.text'),
            'dropdown' => trans('fi.dropdown'),
            'textarea' => trans('fi.textarea'),
        ];
    }
}
