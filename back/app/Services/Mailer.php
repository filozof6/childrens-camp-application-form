<?php

namespace App\Services;

use Dompdf\Dompdf;

class Mailer
{
    const FILES_TO_ATTACH = [
        PdfGenerator::CONTRACT_FILENAME,
    ];
    public function sendOrderConfirmation($receiver, $attachmentsArray)
    {
        $result = \Illuminate\Support\Facades\Mail::to(
            $receiver
        )
            ->send(new \App\Mail\OrderConfirmationEmail($attachmentsArray));
    }
    public function sendContracts($receiver, $attachmentsArray)
    {
        $result = \Illuminate\Support\Facades\Mail::to(
            $receiver
        )
            ->send(new \App\Mail\ContractsEmail($attachmentsArray));
    }
    public function sendReport($receiver, $attachmentsArray)
    {
        $result = \Illuminate\Support\Facades\Mail::to(
            $receiver
        )
            ->send(new \App\Mail\ReportEmail($attachmentsArray));
    }
}