<?php

namespace App\Services;

class SheetConsumer
{

    public function openSheet($activeSheetIndex = 0) {
        $inputFileName = storage_path() . '/../public/input/data.xls';

        /** Load $inputFileName to a Spreadsheet Object  **/
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileName);
        $spreadsheet->setActiveSheetIndex(0);

        return $spreadsheet;
    }

    public function loadOrderFormData()
    {
        $spreadsheet = $this->openSheet();
        $sheetData = $spreadsheet->getActiveSheet()->toArray(null, false, false, true);
        $tripData = $this->parseTripData($sheetData);

        $spreadsheet->setActiveSheetIndex(1);
        $sheetData = $spreadsheet->getActiveSheet()->toArray(null, false, false, true);
        $groupTransportStops = $this->parseGroupTransportStops($sheetData);

        return [
            'tripData' => $tripData,
            'groupTransportStops' => $groupTransportStops,
        ];
    }

    public function parseTripData($sheetDataArray)
    {
        $tripData = [];
        for ($i = 3; array_key_exists($i, $sheetDataArray) && strlen($sheetDataArray[$i]['A']) > 0; $i++) {
            $tripData[] = [
                'value' => $i,
                'text' => $sheetDataArray[$i]['A'],
                'priceForKid' => $sheetDataArray[$i]['B'],
                'groupTransportFee' => $sheetDataArray[$i]['C'],
                'siblingDiscount' => $sheetDataArray[$i]['D'],
            ];
        }

        return $tripData;
    }

    public function parseGroupTransportStops($sheetDataArray)
    {
        $groupTransportStops = [];
        for ($i = 2; array_key_exists($i, $sheetDataArray) && strlen($sheetDataArray[$i]['A']) > 0; $i++) {
            $groupTransportStops[] = [
                'value' => $i,
                'text' => $sheetDataArray[$i]['A'],
            ];
        }

        return $groupTransportStops;
    }
}