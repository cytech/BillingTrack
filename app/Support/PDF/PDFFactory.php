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

use BT\Support\Directory;

class PDFFactory
{
    public static function create()
    {
        $class = 'BT\Support\PDF\Drivers\\' . config('bt.pdfDriver');

        return new $class;
    }

    public static function getDrivers()
    {
        $driverFiles = Directory::listContents(app_path('Support/PDF/Drivers'));
        $drivers     = [];

        foreach ($driverFiles as $driverFile)
        {
            $driver = str_replace('.php', '', $driverFile);

            $drivers[$driver] = $driver;
        }

        return $drivers;
    }
}
