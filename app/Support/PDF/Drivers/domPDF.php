<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Support\PDF\Drivers;

use BT\Support\PDF\PDFAbstract;
use Dompdf\Dompdf as PDF;
use Dompdf\Options;

class domPDF extends PDFAbstract
{
    private function getPdf($html)
    {
        $options = new Options();

        $options->setTempDir(storage_path('/'));
        $options->setFontDir(storage_path('/'));
        $options->setFontCache(storage_path('/'));
        $options->setLogOutputFile(storage_path('dompdf_log'));
        $options->setIsRemoteEnabled(true);
        $options->setIsHtml5ParserEnabled(true);
        $options->setIsFontSubsettingEnabled(true);

        $pdf = new PDF($options);

        $pdf->setPaper($this->paperSize, $this->paperOrientation);

        //if batch
        $batch = '';
        if (is_array($html)) {
            foreach ($html as $doc) {
                $batch .= $doc . "<div style=\"page-break-after: always;\"></div>";
            }
            $pdf->loadHtml($batch);
        } else {
            $pdf->loadHtml($html);
        }
        $pdf->render();

        return $pdf;
    }

    public function getOutput($html)
    {
        $pdf = $this->getPdf($html);

        return $pdf->output();
    }

    public function save($html, $filename)
    {
        file_put_contents($filename, $this->getOutput($html));
    }

    public function download($html, $filename)
    {
        $response = response($this->getOutput($html));

        $response->header('Content-Type', 'application/pdf');
        $response->header('Content-Disposition', ''.config('bt.pdfDisposition').'; filename="' . $filename . '"');

        return $response->send();
    }
}
