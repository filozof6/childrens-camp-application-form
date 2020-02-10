<?php

namespace App\Http\Controllers;

use App\Order;
use App\Services\InputParser;
use App\Services\Mailer;
use App\Services\PdfGenerator;
use App\Services\ReportGenerator;
use App\Services\SheetConsumer;
use App\Services\Util;
use Barryvdh\DomPDF\PDF;
use DateTime;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    function getFormData()
    {
        $sheetConsumer = new SheetConsumer();
        $data = $sheetConsumer->loadOrderFormData();
        //return json_encode($data);
        return new JsonResponse($data, 200);
    }

    /**
     * @param Request $request
     * @return string
     * @throws Exception
     */
    function submitForm(Request $request)
    {
        $this->sendFirstEmail($request);
        $this->sendSecondEmail($request);
        $this->generateReport();

        return 'done';
    }

    public function sendFirstEmail(Request $request)
    {
        $input = $request->all();
        $contractGenerator = new PdfGenerator();
        $term = InputParser::getTripDateInterval($input);
        $pdfContents = $contractGenerator->generatePdf('application', compact('input'));
        $now = new DateTime('now');
        $tripDateIntervalFolder = str_replace(' ', '', InputParser::getTripDateInterval($input));
        $subfolder = Util::stripAccents(
            strtolower(
                "{$input['customer']['firstName']}-{$input['customer']['lastName']}-{$now->format('Y-m-d-H-i-s')}"
            )
        );
        $attachmentsArray[] = storage_path() . '/app/' . $contractGenerator->savePdf($tripDateIntervalFolder . '/' . $subfolder,
                'objednavka_detsky_tabor_smajlovo.pdf', $pdfContents);
        foreach ($input['children'] as $key => $kid) {
            $childrenIndex = $key + 1;

            $healthConfirmationPdfContents = $contractGenerator->generatePdf('healthConfirmation',
                compact('kid', 'term'));
            $healthProclamationPdfContents = $contractGenerator->generatePdf('healthProclamation',
                compact('kid', 'term'));

            $attachmentsArray[] = storage_path() . '/app/' . $contractGenerator->savePdf(
                    $tripDateIntervalFolder . '/' . $subfolder,
                    "potvrdenie_od_lekara_smajlovo_dieta{$childrenIndex}.pdf",
                    $healthConfirmationPdfContents
                );
            $attachmentsArray[] = storage_path() . '/app/' . $contractGenerator->savePdf(
                    $tripDateIntervalFolder . '/' . $subfolder,
                    "prehlasenie_o_bezinfekcnosti_smajlovo_dieta{$childrenIndex}.pdf",
                    $healthProclamationPdfContents
                );

            if (!$input['anotherKid']) {
                break;
            }
        }

        $mailer = new Mailer();
        $mailer->sendOrderConfirmation($input['customer']['email'], $attachmentsArray);

        $order = new Order();
        $order->data = json_encode($input);
        $order->save();

        return 'done';
    }

    public function sendSecondEmail(Request $request)
    {
        $input = $request->all();
        $now = new DateTime('now');
        $term = InputParser::getTripDateInterval($input);
        $tripDateIntervalFolder = str_replace(' ', '', $term);
        $subfolder = Util::stripAccents(
            strtolower(
                "{$input['customer']['firstName']}-{$input['customer']['lastName']}-{$now->format('Y-m-d-H-i-s')}"
            )
        );
        $attachmentsArray = [];
        $contractGenerator = new PdfGenerator();

        $gdprConsentPdfContents = $contractGenerator->generatePdf('gdprConsent', compact('input'));

        $attachmentsArray[] = storage_path() . '/app/' . $contractGenerator->savePdf(
                $tripDateIntervalFolder . '/' . $subfolder,
                "informacia_spracovanie_osobnych_udajov_tabory_smajlovo.pdf",
                $gdprConsentPdfContents
            );

        $contractPdfContents = $contractGenerator->generatePdf('contract', compact('input'));

        $attachmentsArray[] = storage_path() . '/app/' . $contractGenerator->savePdf(
                $tripDateIntervalFolder . '/' . $subfolder,
                "zmluva_o_ucasti_v_tabore_smajlovo.pdf",
                $contractPdfContents
            );

        $mailer = new Mailer();
        $mailer->sendContracts($input['customer']['email'], $attachmentsArray);

        return 'done';
    }

    /**
     * @return string
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     */
    public function generateReport()
    {
        $reportGenerator = new ReportGenerator();
        $report_path = $reportGenerator->generateReport();

        $mailer = new Mailer();
        $mailer->sendReport(env('MAIL_FROM_ADDRESS'), [$report_path]);

        return 'done';
    }

    public function zmluva(Request $request)
    {
        $input = $request->all();
        /** @var PDF $pdf */
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('contract', compact('input'));
        return $pdf->stream();
    }

    public function prihlaska(Request $request)
    {
        $input = $request->all();
        /** @var PDF $pdf */
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('application', compact('input'));
        return $pdf->stream();
    }

    public function prehlasenieOBezinfekcnosti(Request $request)
    {
        $input = $request->all();
        $kid = $input['children'][0];
        /** @var PDF $pdf */
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('healthProclamation', compact('kid'));
        return $pdf->stream();
    }

    public function potvrdenieOdLekara(Request $request)
    {
        $input = $request->all();
        $kid = $input['children'][0];
        $term = InputParser::getTripDateInterval($input);
        /** @var PDF $pdf */
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('healthConfirmation', compact('kid', 'term'));
        return $pdf->stream();
    }

    public function potvrdenieGdpr(Request $request)
    {
        $input = $request->all();
        /** @var PDF $pdf */
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('gdprConsent', compact('input'));
        return $pdf->stream();
    }
}
