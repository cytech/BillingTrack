<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\Import\Importers;

use BT\Modules\Expenses\Models\Expense;
use Illuminate\Support\Facades\Validator;

class ExpenseImporter extends AbstractImporter
{
    public function getFields()
    {
        $fields = [
            'expense_date'    => '* ' . trans('bt.date'),
            'category_name'   => '* ' . trans('bt.category'),
            'amount'          => '* ' . trans('bt.amount'),
            'vendor_name'     => trans('bt.vendor'),
            'client_name'     => trans('bt.client'),
            'description'     => trans('bt.description'),
            'tax'             => trans('bt.tax'),
            'company_profile' => trans('bt.company_profile'),
        ];

        return $fields;
    }

    public function getMapRules()
    {
        return [
            'expense_date'  => 'required',
            'category_name' => 'required',
            'amount'        => 'required',
        ];
    }

    public function getValidator($input)
    {
        return Validator::make($input, [
            'expense_date'  => 'required',
            'category_name' => 'required',
            'amount'        => 'required|numeric',
        ])->setAttributeNames([
            'user_id'            => trans('bt.user'),
            'company_profile_id' => trans('bt.company_profile'),
            'expense_date'       => trans('bt.date'),
            'category_name'      => trans('bt.category'),
            'description'        => trans('bt.description'),
            'amount'             => trans('bt.amount'),
        ]);
    }

    public function importData($input)
    {
        $row = 1;

        $fields = [];

        foreach ($input as $key => $field)
        {
            if (is_numeric($field))
            {
                $fields[$key] = $field;
            }
        }

        $handle = fopen(storage_path('expenses.csv'), 'r');

        if (!$handle)
        {
            $this->messages->add('error', 'Could not open the file');

            return false;
        }

        while (($data = fgetcsv($handle, 1000, ',')) !== false)
        {
            if ($row !== 1)
            {
                $record = [];

                foreach ($fields as $field => $key)
                {
                    $record[$field] = $data[$key];
                }

                if ($this->validateRecord($record))
                {
                    Expense::create($record);
                }
            }

            $row++;
        }

        fclose($handle);

        return true;
    }
}
