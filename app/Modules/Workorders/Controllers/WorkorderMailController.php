<?php

/**
 * This file is part of BillingTrack.
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\Workorders\Controllers;

use BT\Events\WorkorderEmailed;
use BT\Events\WorkorderEmailing;
use BT\Http\Controllers\Controller;
use BT\Modules\MailQueue\Support\MailQueue;
use BT\Modules\Workorders\Models\Workorder;
use BT\Requests\SendEmailRequest;
use BT\Support\Contacts;
use BT\Support\Parser;

class WorkorderMailController extends Controller
{
    private $mailQueue;

    public function __construct(MailQueue $mailQueue)
    {
        $this->mailQueue          = $mailQueue;
    }

    public function create()
    {
        $workorder = Workorder::find(request('workorder_id'));

	    $contacts = new Contacts($workorder->client);

        $parser = new Parser($workorder);

        return view('workorders.partials._modal_mail')
            ->with('workorderId', $workorder->id)
            ->with('redirectTo', urlencode(request('redirectTo')))
            ->with('subject', $parser->parse('workorderEmailSubject'))
            ->with('body', $parser->parse('workorderEmailBody'))
            ->with('contactDropdownTo', $contacts->contactDropdownTo())
            ->with('contactDropdownCc', $contacts->contactDropdownCc())
            ->with('contactDropdownBcc', $contacts->contactDropdownBcc());
    }

    public function store(SendEmailRequest $request)
    {
        $workorder = Workorder::find($request->input('workorder_id'));

	    event(new WorkorderEmailing($workorder));

        $mail = $this->mailQueue->create($workorder, $request->except('workorder_id'));

        if ($this->mailQueue->send($mail->id))
        {
            event(new WorkorderEmailed($workorder));
        }
        else
        {
            return response()->json(['errors' => [[$this->mailQueue->getError()]]], 400);
        }
    }
}
