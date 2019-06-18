<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Support;

use Collective\Html\FormFacade;
use BT\Modules\Vendors\Models\Vendor;

class VendorContacts
{
    private $vendor;
    private $user;

    public function __construct(Vendor $vendor)
    {
        $this->vendor = $vendor;
        $this->user   = auth()->user();
    }

    public function contactDropdownTo()
    {
        $allContacts      = $this->getAllContacts();
        $selectedContacts = $this->getSelectedContactsTo();

        return FormFacade::select('to', $allContacts, $selectedContacts, ['id' => 'to', 'multiple' => 'multiple', 'class' => 'form-control']);
    }

    public function contactDropdownCc()
    {
        $allContacts      = $this->getAllContacts();
        $selectedContacts = $this->getSelectedContactsCc();

        return FormFacade::select('cc', $allContacts, $selectedContacts, ['id' => 'cc', 'multiple' => 'multiple', 'class' => 'form-control']);
    }

    public function contactDropdownBcc()
    {
        $allContacts      = $this->getAllContacts();
        $selectedContacts = $this->getSelectedContactsBcc();

        return FormFacade::select('bcc', $allContacts, $selectedContacts, ['id' => 'bcc', 'multiple' => 'multiple', 'class' => 'form-control']);
    }

    public function getSelectedContactsTo()
    {
        return $this->vendor->contacts->where('default_to', 1)->pluck('email')->prepend($this->vendor->email);
    }

    public function getSelectedContactsCc()
    {
        $contacts = $this->vendor->contacts
            ->where('default_cc', 1)
            ->pluck('email')
            ->toArray();

        if (config('bt.mailDefaultCc'))
        {
            $contacts = array_merge($contacts, [config('bt.mailDefaultCc')]);
        }

        return $contacts;
    }

    public function getSelectedContactsBcc()
    {
        $contacts = $this->vendor->contacts
            ->where('default_bcc', 1)
            ->pluck('email')
            ->toArray();

        if (config('bt.mailDefaultBcc'))
        {
            $contacts = array_merge($contacts, [config('bt.mailDefaultBcc')]);
        }

        return $contacts;
    }

    private function getAllContacts()
    {
        $contacts = ($this->vendor->email) ? [$this->vendor->email => $this->getFormattedContact($this->vendor->name, $this->vendor->email)] : [];

        foreach ($this->vendor->contacts->pluck('name', 'email') as $email => $name)
        {
            $contacts[$email] = $this->getFormattedContact($name, $email);
        }

        $contacts[$this->user->email] = $this->getFormattedContact($this->user->name, $this->user->email);

        if (config('bt.mailDefaultCc'))
        {
            $contacts[config('bt.mailDefaultCc')]  = config('bt.mailDefaultCc');
        }

        if (config('bt.mailDefaultBcc'))
        {
            $contacts[config('bt.mailDefaultBcc')] = config('bt.mailDefaultBcc');
        }

        return $contacts;
    }

    private function getFormattedContact($name, $email)
    {
        return $name . ' <' . $email . '>';
    }
}
