<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\CustomFields\Controllers;

use BT\Http\Controllers\Controller;
use BT\Modules\CustomFields\Models\CustomField;
use BT\Modules\CustomFields\Support\CustomFields;
use BT\Modules\CustomFields\Requests\CustomFieldStoreRequest;
use BT\Modules\CustomFields\Requests\CustomFieldUpdateRequest;
use BT\Traits\ReturnUrl;

class CustomFieldController extends Controller
{
    use ReturnUrl;

    public function index()
    {
        $this->setReturnUrl();

        $customFields = CustomField::sortable(['tbl_name' => 'asc', 'field_label' => 'asc'])->paginate(config('bt.resultsPerPage'));

        return view('custom_fields.index')
            ->with('customFields', $customFields)
            ->with('tableNames', CustomFields::tableNames());
    }

    public function create()
    {
        return view('custom_fields.form')
            ->with('editMode', false)
            ->with('tableNames', CustomFields::tableNames())
            ->with('fieldTypes', CustomFields::fieldTypes());
    }

    public function store(CustomFieldStoreRequest $request)
    {
        $input = $request->all();

        $input['column_name'] = CustomField::getNextColumnName($input['tbl_name']);

        CustomField::create($input);

        CustomField::createCustomColumn($input['tbl_name'], $input['column_name'], $input['field_type']);

        return redirect($this->getReturnUrl())
            ->with('alertSuccess', trans('bt.record_successfully_created'));
    }

    public function edit($id)
    {
        $customField = CustomField::find($id);

        return view('custom_fields.form')
            ->with('editMode', true)
            ->with('customField', $customField)
            ->with('tableNames', CustomFields::tableNames())
            ->with('fieldTypes', CustomFields::fieldTypes());
    }

    public function update(CustomFieldUpdateRequest $request, $id)
    {
        $customField = CustomField::find($id);

        $customField->fill($request->except('tbl_name'));

        $customField->save();

        return redirect($this->getReturnUrl())
            ->with('alertInfo', trans('bt.record_successfully_updated'));
    }

    public function delete($id)
    {
        $customField = CustomField::find($id);

        CustomField::deleteCustomColumn($customField->tbl_name, $customField->column_name);

        CustomField::destroy($id);

        return redirect()->route('customFields.index')
            ->with('alert', trans('bt.record_successfully_deleted'));
    }
}
