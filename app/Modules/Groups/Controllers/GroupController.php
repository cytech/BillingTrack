<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\Groups\Controllers;

use BT\Http\Controllers\Controller;
use BT\Modules\Groups\GroupOptions;
use BT\Modules\Groups\Models\Group;
use BT\Modules\Groups\Requests\GroupRequest;
use BT\Traits\ReturnUrl;

class GroupController extends Controller
{
    use ReturnUrl;

    private $groupOptions;

    public function __construct(GroupOptions $groupOptions)
    {
        $this->groupOptions = $groupOptions;
    }

    public function index()
    {
        $this->setReturnUrl();

        $groups = Group::sortable(['name' => 'asc'])->paginate(config('bt.resultsPerPage'));

        return view('groups.index')
            ->with('groups', $groups)
            ->with('resetNumberOptions', $this->groupOptions->resetNumberOptions());
    }

    public function create()
    {
        return view('groups.form')
            ->with('editMode', false)
            ->with('resetNumberOptions', $this->groupOptions->resetNumberOptions());
    }

    public function store(GroupRequest $request)
    {
        Group::create($request->all());

        return redirect($this->getReturnUrl())
            ->with('alertSuccess', trans('bt.record_successfully_created'));
    }

    public function edit($id)
    {
        $group = Group::find($id);

        return view('groups.form')
            ->with('editMode', true)
            ->with('group', $group)
            ->with('resetNumberOptions', $this->groupOptions->resetNumberOptions());
    }

    public function update(GroupRequest $request, $id)
    {
        $group = Group::find($id);

        $group->fill($request->all());

        $group->save();

        return redirect($this->getReturnUrl())
            ->with('alertInfo', trans('bt.record_successfully_updated'));
    }

    public function delete($id)
    {
        Group::destroy($id);

        return redirect()->route('groups.index')
            ->with('alert', trans('bt.record_successfully_deleted'));
    }
}
