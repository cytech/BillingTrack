<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\MailQueue\Controllers;

use FI\Http\Controllers\Controller;
use FI\Modules\MailQueue\Models\MailQueue;

class MailLogController extends Controller
{
    public function index()
    {
        $mails = MailQueue::sortable(['created_at' => 'desc'])
            ->keywords(request('search'))
            ->paginate(config('fi.resultsPerPage'));

        return view('mail_log.index')
            ->with('mails', $mails)
            ->with('displaySearch', false);
    }

    public function content()
    {
        $mail = MailQueue::select('subject', 'body')
            ->where('id', request('id'))
            ->first();

        return view('mail_log._modal_content')
        ->with('mail', $mail);
    }

    public function delete($id)
    {
        MailQueue::destroy($id);

        return redirect()->route('mailLog.index')
            ->with('alert', trans('fi.record_successfully_deleted'));
    }
}
