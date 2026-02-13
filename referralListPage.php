<?php
    require_once 'dbConfig.php';
    require_once 'sessionChecker.php';
    require_once 'x-head.php';

    //Cache remover to prevent showing sensitive data on back button press after log out
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Pragma: no-cache");

    //Verifies if user reached this page through log in
    if (!isset($_SESSION['username'])){
        header("Location: loginUser.php");
        exit();
    }

    //Variable Declarations
    $currentUser = $_SESSION['username'];
    $currentPage = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/public.css">
    <link rel="stylesheet" href="css/referralListPage.css">
    <title>Ojt Referral List</title>
</head>
<body>
    <?php include 'adminHeaderAndNav.php'; ?>
</body>
</html>