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

use BT\Modules\Clients\Models\Client;
use BT\Modules\CustomFields\Models\CustomField;
use Illuminate\Support\Facades\Validator;

class ClientImporter extends AbstractImporter
{
    public function getFields()
    {
        $fields = [
            'name'        => '* ' . trans('bt.name'),
            'unique_name' => trans('bt.unique_name'),
            'address'     => trans('bt.address'),
            'city'        => trans('bt.city'),
            'state'       => trans('bt.state'),
            'zip'         => trans('bt.postal_code'),
            'country'     => trans('bt.country'),
            'phone'       => trans('bt.phone'),
            'fax'         => trans('bt.fax'),
            'mobile'      => trans('bt.mobile'),
            'email'       => trans('bt.email'),
            'web'         => trans('bt.web'),
        ];

        foreach (CustomField::forTable('clients')->get() as $customField)
        {
            $fields['custom_' . $customField->column_name] = $customField->field_label;
        }

        return $fields;
    }

    public function getMapRules()
    {
        return ['name' => 'required'];
    }

    public function getValidator($input)
    {
        return Validator::make($input, [
            'name'  => 'required',
            'email' => 'email',
        ])->setAttributeNames(['name' => trans('bt.name')]);
    }

    public function importData($input)
    {
        $row = 1;

        $fields       = [];
        $customFields = [];

        foreach ($input as $key => $field)
        {
            if (is_numeric($field))
            {
                if (substr($key, 0, 7) != 'custom_')
                {
                    $fields[$key] = $field;
                }
                else
                {
                    $customFields[substr($key, 7)] = $field;
                }
            }
        }

        $handle = fopen(storage_path('clients.csv'), 'r');

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

                $customRecord = [];

                foreach ($fields as $field => $key)
                {
                    $record[$field] = $data[$key];
                }

                if ($this->validateRecord($record))
                {
                    $client = Client::create($record);

                    if ($customFields)
                    {
                        foreach ($customFields as $field => $key)
                        {
                            $customRecord[$field] = $data[$key];
                        }

                        $client->custom->update($customRecord);
                    }
                }
            }

            $row++;
        }

        fclose($handle);

        return true;
    }
}
