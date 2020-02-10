<?php

namespace App\Services;

use App\Order;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ReportGenerator
{
    const REPORT_FILENAME = '{year}_report_objednavky_tabory_SMAJLOVO.xls';

    const REPORT_FOLDER = 'reports';

    const SHEET_MAIN_HEADER = [
        'B' => 'turnus',
        'C' => 'rodič/zákonný zástupca',
        'K' => 'dieťa1',
        'N' => 'dieťa2',
        'Q' => 'doprava',
        'T' => 'cena celkom',
        'U' => 'poznámky',
    ];

    const SHEET_SUB_HEADER = [
        'A' => 'Dátum vytvorenia formulára',
        'B' => 'termín turnusu',
        'C' => 'titul',
        'D' => 'meno',
        'E' => 'priezvisko',
        'F' => 'ulica č.d.',
        'G' => 'mesto',
        'H' => 'PSČ',
        'I' => 'telefón',
        'J' => 'e-mail',
        'K' => 'meno',
        'L' => 'priezvisko',
        'M' => 'dátum nar.',
        'N' => 'meno',
        'O' => 'priezvisko',
        'P' => 'dátum nar.',
        'Q' => 'individuálna',
        'R' => 'spoločná',
        'S' => 'miesto nástupu',
        'T' => 'EUR',
    ];

    const HEADER_STYLES = [
        'font' => [
            'bold' => true,
        ],
        'alignment' => [
            'horizontal' => Alignment::HORIZONTAL_CENTER,
        ],
        'borders' => [
            'top' => [
                'borderStyle' => Border::BORDER_THIN,
            ],
        ],
    ];

    /**
     * @return string
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     */
    public function generateReport()
    {
        $dateIntervals = $this->getDateIntervalsForReport();

        $fetchedOrders = Order
            ::where('created_at', '>=', $dateIntervals['start'])
            ->where('created_at', '<=', $dateIntervals['end'])
            ->orderBy('id', 'asc')
            ->get();

        $ordersToGenerate = $this->processFetchedOrders($fetchedOrders);

        return $this->generateSpreadsheet($ordersToGenerate, $dateIntervals['end']->year);
    }

    private function getDateIntervalsForReport()
    {
        $now = (new Carbon());
        $edgeDay = (new Carbon())->endOfYear()->endOfMonth();
        $start = (new Carbon())->startOfYear()->subDay(1);
        $end = (new Carbon())->endOfYear()->subDay(1);

        if ($now->month === $edgeDay->month && $now->day === $edgeDay->day) {
            $start->addYear(1);
            $end->addYear(1);
        }

        return [
            'start' => $start,
            'end' => $end,
        ];
    }

    /**
     * @param Order[] $fetchedOrders
     * @return array
     */
    private function processFetchedOrders($fetchedOrders)
    {
        $parsedOrders = [];
        foreach ($fetchedOrders as $fetchedOrder) {
            $parsedOrders[] = [
                'id' => $fetchedOrder->id,
                'data' => json_decode($fetchedOrder->data, true),
                'created_at' => $fetchedOrder->created_at
            ];
        }

        return $parsedOrders;
    }

    /**
     * @param array $orders
     * @param int $year
     * @return string
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     */
    private function generateSpreadsheet($orders, $year)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Smajlovo objednavky' . $year);

        $this->renderMainHeader($sheet, 1);
        $this->renderHeader($sheet, self::SHEET_SUB_HEADER, 2);
        $this->renderOrders($sheet, $orders, 3);
        //$sheet->setCellValue('A1', 'Smajlovo objednavky ' . $year);

        $writer = new Xlsx($spreadsheet);
        $storage_path = storage_path(
            'app/' . self::REPORT_FOLDER . '/' . strtr(self::REPORT_FILENAME, ['{year}' => $year])
        );
        Storage::disk('local')
            ->put(self::REPORT_FOLDER . '/' . strtr(self::REPORT_FILENAME, ['{year}' => $year]), '');
        $writer->save($storage_path);

        return $storage_path;
    }

    /**
     * @param Worksheet $sheet
     * @param int $rowNumber
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     */
    private function renderMainHeader(&$sheet, $rowNumber = 1)
    {
        $sheet->mergeCells('C1:J1');
        $sheet->mergeCells('K1:M1');
        $sheet->mergeCells('N1:P1');
        $sheet->mergeCells('Q1:S1');

        $this->renderHeader($sheet, self::SHEET_MAIN_HEADER, $rowNumber);
    }

    /**
     * @param Worksheet $sheet
     * @param array $headerArray
     * @param int $rowNumber
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     */
    private function renderHeader(&$sheet, $headerArray, $rowNumber = 1)
    {
        foreach ($headerArray as $cellLetter => $value) {
            $sheet->setCellValue($cellLetter . $rowNumber, $value);
            $sheet->getCell($cellLetter . $rowNumber)
                ->getStyle()
                ->applyFromArray(self::HEADER_STYLES);
        }
    }

    /**
     * @param Worksheet $sheet
     * @param array $orders
     * @param int $rowStart
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     */
    private function renderOrders(&$sheet, $orders, $rowStart)
    {
        $rowIterator = $rowStart;

        foreach ($orders as $order) {
            $input = $order['data'];
            $sheet->setCellValue(
                'A' . $rowIterator,
            // $order['created_at']
            (new Carbon($order['created_at']))->format('d.m.Y h:i:s')
            );

            $sheet->setCellValue('B' . $rowIterator, InputParser::getTripDateInterval($input));
            // customer data
            $sheet->setCellValue('C' . $rowIterator, $input['customer']['title']);
            $sheet->setCellValue('D' . $rowIterator, $input['customer']['firstName']);
            $sheet->setCellValue('E' . $rowIterator, $input['customer']['lastName']);
            $sheet->setCellValue('F' . $rowIterator, $input['customer']['address']['streetNumber']);
            $sheet->setCellValue('G' . $rowIterator, $input['customer']['address']['city']);
            $sheet->setCellValue('H' . $rowIterator, $input['customer']['address']['zipCode']);
            $sheet->setCellValue('I' . $rowIterator, $input['customer']['mobile']);
            $sheet->setCellValue('J' . $rowIterator, $input['customer']['email']);

            // first kid data
            $sheet->setCellValue('K' . $rowIterator, $input['children'][0]['firstName']);
            $sheet->setCellValue('L' . $rowIterator, $input['children'][0]['lastName']);
            $sheet->setCellValue('M' . $rowIterator, $input['children'][0]['dateOfBirth']);

            // second kid data
            $sheet->setCellValue('N' . $rowIterator, $input['children'][1]['firstName']);
            $sheet->setCellValue('O' . $rowIterator, $input['children'][1]['lastName']);
            $sheet->setCellValue('P' . $rowIterator, $input['children'][1]['dateOfBirth']);

            // transportation data
            $sheet->setCellValue(
                'Q' . $rowIterator,
                $input['transportation'] === InputParser::INDIVIDUAL_TRANSPORTATION ? 'X' : ''
            );
            $sheet->getCell('Q' . $rowIterator)
                ->getStyle()
                ->applyFromArray([
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                    ],
                ]);
            $sheet->setCellValue(
                'R' . $rowIterator,
                $input['transportation'] === InputParser::GROUP_TRANSPORTATION ? 'X' : ''
            );
            $sheet->getCell('R' . $rowIterator)
                ->getStyle()
                ->applyFromArray([
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                    ],
                ]);
            $sheet->setCellValue(
                'S' . $rowIterator,
                InputParser::getGroupTransportPickUpLocation($input)
            );

            // Total price
            $sheet->setCellValue('T' . $rowIterator, $input['totalPrice']);
            // notes
            $sheet->setCellValue('U' . $rowIterator, $input['notes']);

            $rowIterator++;
        }
    }

    private function formatDate($dateString) {
        $dateCarbon = new Carbon($dateString);
        $value = $dateCarbon->format('d.m.Y');
        return $value;
    }
}