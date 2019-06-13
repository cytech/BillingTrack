<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\Clients\Controllers;

use BT\Http\Controllers\Controller;
use BT\Modules\Clients\Models\Contact;
use BT\Modules\Clients\Requests\ContactRequest;
use BT\Modules\Titles\Models\Title;
use Session;

class ContactController extends Controller
{
    public function create($clientId)
    {
        $titles = Title::pluck('name', 'id');

        return view('clients._modal_contact', compact('titles'))
            ->with('editMode', false)
            ->with('clientId', $clientId)
            ->with('submitRoute', route('clients.contacts.store', [$clientId]));
    }

    public function store(ContactRequest $request, $clientId)
    {
        $message = __('bt.record_successfully_created');

        if($request->is_primary == 1 ) {
            Contact::where('client_id', '=', $request->clientId)->update(['is_primary' => 0]);
            $message = __('bt.record_successfully_created') . '<br>' . __('bt.primary_changed');
        }

        Contact::create($request->all());

        Session::now('alertInfo',$message);

        return $this->loadContacts($clientId);
    }

    public function edit($clientId, $id)
    {
        $titles = Title::pluck('name', 'id');

        return view('clients._modal_contact', compact('titles'))
            ->with('editMode', true)
            ->with('clientId', $clientId)
            ->with('submitRoute', route('clients.contacts.update', [$clientId, $id]))
            ->with('contact', Contact::find($id));
    }

    public function update(ContactRequest $request, $clientId, $id)
    {
        $contact = Contact::find($id);

        $message = __('bt.record_successfully_updated');

        if($request->is_primary == 1 ) {
            Contact::where('client_id', '=', $request->clientId)->where('id', '!=' , $id)->update(['is_primary' => 0]);
            if ($contact->is_primary != 1)
            $message = __('bt.record_successfully_updated') . '<br>' . __('bt.primary_changed');
        }

        $contact->fill($request->all());

        $contact->save();

        Session::now('alertInfo',$message);

        return $this->loadContacts($clientId);
    }

    public function delete($clientId)
    {
        Contact::destroy(request('id'));

        return $this->loadContacts($clientId);
    }

    public function updateDefault($clientId)
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

        return $this->loadContacts($clientId);
    }

    private function loadContacts($clientId)
    {
        return view('clients._contacts')
            ->with('clientId', $clientId)
            ->with('contacts', Contact::where('client_id', $clientId)->orderBy('name')->get());
    }
}
