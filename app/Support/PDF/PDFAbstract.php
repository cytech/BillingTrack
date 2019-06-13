<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Support\PDF;

abstract class PDFAbstract implements PDFInterface
{
    protected $paperSize;

    protected $paperOrientation;

    public function __construct()
    {
        $this->paperSize = config('bt.paperSize') ?: 'letter';
        $this->paperOrientation = config('bt.paperOrientation') ?: 'portrait';
    }

    public function setPaperSize($paperSize)
    {
        $this->paperSize = $paperSize;
    }

    public function setPaperOrientation($paperOrientation)
    {
        $this->paperOrientation = $paperOrientation;
    }
}
