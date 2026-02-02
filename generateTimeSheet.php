<?php 

    require_once 'dbConfig.php';
    session_start();

    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    $user_id = $_SESSION['user_id'];
    $templatePath = 'assets/spreadsheets/template/WEEKLY_TIME_SHEET_SUMMARY.xlsx';
    $targetDir = 'assets/spreadsheets/' . $user_id . '/';
    $newFileName = 'TIME_SHEET_' . $user_id . '.xlsx';
    $destinationPath = $targetDir . $newFileName;

    $_SESSION['time_sheet_template'] = $templatePath;
    $_SESSION['time_sheet_path'] = $destinationPath;

    if (!is_dir($targetDir)) mkdir($targetDir, 0755, true);
    if (!file_exists($destinationPath)) copy($templatePath, $destinationPath);
?>