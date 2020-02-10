<?php

namespace App\Services;

use Dompdf\Dompdf;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;

class PdfGenerator
{
    const CONTRACT_FILENAME = 'contract.pdf';

    public function generatePdf($view, $compacted)
    {
        /** @var Dompdf $pdf */
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView($view, $compacted);
        return $pdf->output();
    }

    public function savePdf($subfolder, $filename, $contents) {
        $date = new \DateTime();
        $currentYear = $date->format("Y");
        $filePath = "{$currentYear}/{$subfolder}/{$filename}";
        if (Storage::disk('local')->put("{$currentYear}/{$subfolder}/{$filename}", $contents)) {
            return $filePath;
        }

        return false;
    }
}