<?php

    require_once 'dbConfig.php';
    require_once 'libs/SimpleXLSX.php';
    require_once 'libs/SimpleXLSXGen.php';

    use Shuchkin\SimpleXLSX;
    use Shuchkin\SimpleXLSXGen;

    include 'generateTimeSheet.php';
    session_start();

    if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
        $user_id = $_SESSION['user_id'];
        $date = $_POST['date'];
        $clockIn = $_POST['clock-in'];
        $clockOut = $_POST['clock-out'];
        $totalHours = $_POST['total-hours'];

        $fileToRead = file_exists($_SESSION['time_sheet_path']) ? $_SESSION['time_sheet_path'] : $_SESSION['time_sheet_template'];

        if ($xlsx = SimpleXLSX::parse($fileToRead)) {
            $data = $xlsx->rows();

            $data[] = [$date, $clockIn, $clockOut, $totalHours];

            $newXLSX = SimpleXLSXGen::fromArray($data)->saveAs($_SESSION['time_sheet_path']);
        }  

        $sql = "UPDATE intern_list SET time_sheet = :time_sheet WHERE user_id = :user_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':time_sheet', $_SESSION['time_sheet_path']);
        $stmt->bindParam(':user_id', $user_id);
        
        if ($stmt->execute()) {
            $_SESSION['timeSheet_msg'] = "<p style='color: green;'>Entry collected successfully!</p>";
        } else {
            $_SESSION['timeSheet_msg'] = "<p style='color: red;'>Error saving time sheet entry.</p>";
        }

        header("Location: timeSheet.php");
        exit();
    }
?>