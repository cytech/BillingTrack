<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\Vendors\Controllers;

use BT\Http\Controllers\Controller;
use BT\Modules\Vendors\Models\Contact;
use BT\Modules\Vendors\Requests\ContactRequest;
use BT\Modules\Titles\Models\Title;
use Session;

class ContactController extends Controller
{
    public function create($vendorId)
    {
        $titles = Title::pluck('name', 'id');

        return view('vendors._modal_contact', compact('titles'))
            ->with('editMode', false)
            ->with('vendorId', $vendorId)
            ->with('submitRoute', route('vendors.contacts.store', [$vendorId]));
    }

    public function store(ContactRequest $request, $vendorId)
    {
        $message = __('bt.record_successfully_created');

        if($request->is_primary == 1 ) {
            Contact::where('vendor_id', '=', $request->vendorId)->update(['is_primary' => 0]);
            $message = __('bt.record_successfully_created') . '<br>' . __('bt.primary_changed');
        }

        Contact::create($request->all());

        Session::now('alertInfo',$message);

        return $this->loadContacts($vendorId);
    }

    public function edit($vendorId, $id)
    {
        $titles = Title::pluck('name', 'id');

        return view('vendors._modal_contact', compact('titles'))
            ->with('editMode', true)
            ->with('vendorId', $vendorId)
            ->with('submitRoute', route('vendors.contacts.update', [$vendorId, $id]))
            ->with('contact', Contact::find($id));
    }

    public function update(ContactRequest $request, $vendorId, $id)
    {
        $contact = Contact::find($id);

        $message = __('bt.record_successfully_updated');

        if($request->is_primary == 1 ) {
            Contact::where('vendor_id', '=', $request->vendorId)->where('id', '!=' , $id)->update(['is_primary' => 0]);
            if ($contact->is_primary != 1)
            $message = __('bt.record_successfully_updated') . '<br>' . __('bt.primary_changed');
        }

        $contact->fill($request->all());

        $contact->save();

        Session::now('alertInfo',$message);

        return $this->loadContacts($vendorId);
    }

    public function delete($vendorId)
    {
        Contact::destroy(request('id'));

        return $this->loadContacts($vendorId);
    }

    public function updateDefault($vendorId)
    {
        $contact = Contact::find(request('id'));

        switch (request('default'))
        {
            case 'to':
                $data = [
                    'default_to'  => ($contact->default_to) ? 0 : 1,
                    'default_cc'  => 0,
                    'default_bcc' => 0,
                ];
                break;
            case 'cc':
                $data = [
                    'default_to'  => 0,
                    'default_cc'  => ($contact->default_cc) ? 0 : 1,
                    'default_bcc' => 0,
                ];
                break;
            case 'bcc':
                $data = [
                    'default_to'  => 0,
                    'default_cc'  => 0,
                    'default_bcc' => ($contact->default_bcc) ? 0 : 1,
                ];
                break;
        }

        $contact->fill($data);
        $contact->save();

        return $this->loadContacts($vendorId);
    }

    private function loadContacts($vendorId)
    {
        return view('vendors._contacts')
            ->with('vendorId', $vendorId)
            ->with('contacts', Contact::where('vendor_id', $vendorId)->orderBy('name')->get());
    }
}
