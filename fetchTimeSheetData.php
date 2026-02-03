<?php
require_once 'libs/SimpleXLSX.php';
use Shuchkin\SimpleXLSX;

function getTimeSheetRows($filePath) {
    if (empty($filePath) || !file_exists($filePath)) {
        return [];
    }

    if ($xlsx = SimpleXLSX::parse($filePath)) {
        $allRows = $xlsx->rows();
        
        $dataOnly = array_slice($allRows, 3);

        $filteredRows = array_filter($dataOnly, function($row) {
            return !empty(array_filter($row));
        });

        foreach ($filteredRows as &$row) {
            if (!empty($row[0])) {
                $row[0] = date("Y-m-d", strtotime($row[0]));
            }
        }

        return $filteredRows;
    }

    return [];
}
?>