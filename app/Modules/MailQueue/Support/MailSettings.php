<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\MailQueue\Support;

class MailSettings
{
    /**
     * Provide a list of send methods.
     *
     * @return array
     */
    static function listSendMethods()
    {
        return [
            ''         => '',
            'smtp'     => trans('bt.email_send_method_smtp'),
            'mail'     => trans('bt.email_send_method_phpmail'),
            'sendmail' => trans('bt.email_send_method_sendmail'),
        ];
    }

    /**
     * Provide a list of encryption methods.
     *
     * @return array
     */
    static function listEncryptions()
    {
        return [
            '0'   => trans('bt.none'),
            'ssl' => 'SSL',
            'tls' => 'TLS',
        ];
    }
}
