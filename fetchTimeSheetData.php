<?php
require 'vendor/autoload.php'; //phpspreadsheet requirement

use PhpOffice\PhpSpreadsheet\IOFactory;

function getTimeSheetRows($filePath) {
    if (empty($filePath) || !file_exists($filePath)) {
        return [];
    }

    try {
        $spreadsheet = IOFactory::load($filePath);
        $worksheet = $spreadsheet->getActiveSheet();

        // Convert worksheet to array
        $allRows = $worksheet->toArray();
        
        // Skips headers which are on rows 1 to 3
        $dataOnly = array_slice($allRows, 3);

        // Skips blank rows
        $filteredRows = array_filter($dataOnly, function($row) {
            return !empty(array_filter($row));
        });

        foreach ($filteredRows as &$row) {
            if (!empty($row[0])) {
                // Ensures date format to be written on the spreadsheet
                if (is_numeric($row[0])) {
                    $row[0] = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[0])->format('Y-m-d');
                } else {
                    $row[0] = date("Y-m-d", strtotime($row[0]));
                }
            }
        }

        return $filteredRows;
    } catch (Exception $e) {
        return [];
    }
}
?>