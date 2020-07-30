<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\MailQueue\Controllers;

use BT\DataTables\MailQueueDataTable;
use BT\Http\Controllers\Controller;
use BT\Modules\MailQueue\Models\MailQueue;

class MailLogController extends Controller
{
    public function index(MailQueueDataTable $dataTable)
    {
        return $dataTable->render('mail_log.index');
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
            ->with('alert', trans('bt.record_successfully_deleted'));
    }
}
