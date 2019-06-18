<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\Purchaseorders\Controllers;

use BT\Events\PurchaseorderEmailed;
use BT\Events\PurchaseorderEmailing;
use BT\Http\Controllers\Controller;
use BT\Modules\Purchaseorders\Models\Purchaseorder;
use BT\Modules\MailQueue\Support\MailQueue;
use BT\Requests\SendEmailRequest;
use BT\Support\VendorContacts;
use BT\Support\Parser;

class PurchaseorderMailController extends Controller
{
    private $mailQueue;

    public function __construct(MailQueue $mailQueue)
    {
        $this->mailQueue = $mailQueue;
    }

    public function create()
    {
        $purchaseorder = Purchaseorder::find(request('purchaseorder_id'));

        $contacts = new VendorContacts($purchaseorder->vendor);

        $parser = new Parser($purchaseorder);

        if (!$purchaseorder->is_overdue)
        {
            $subject = $parser->parse('purchaseorderEmailSubject');
            $body    = $parser->parse('purchaseorderEmailBody');
        }
        else
        {
            $subject = $parser->parse('overduePurchaseorderEmailSubject');
            $body    = $parser->parse('overduePurchaseorderEmailBody');
        }

        return view('purchaseorders._modal_mail')
            ->with('purchaseorderId', $purchaseorder->id)
            ->with('redirectTo', urlencode(request('redirectTo')))
            ->with('subject', $subject)
            ->with('body', $body)
            ->with('contactDropdownTo', $contacts->contactDropdownTo())
            ->with('contactDropdownCc', $contacts->contactDropdownCc())
            ->with('contactDropdownBcc', $contacts->contactDropdownBcc());
    }

    public function store(SendEmailRequest $request)
    {
        $purchaseorder = Purchaseorder::find($request->input('purchaseorder_id'));

        event(new PurchaseorderEmailing($purchaseorder));

        $mail = $this->mailQueue->create($purchaseorder, $request->except('purchaseorder_id'));

        if ($this->mailQueue->send($mail->id))
        {
            event(new PurchaseorderEmailed($purchaseorder));
        }
        else
        {
            return response()->json(['errors' => [[$this->mailQueue->getError()]]], 400);
        }
    }
}
