<?php
    $host = "localhost";
    $db = 'logintrial';
    $user = 'root';
    $password = '';
    $charset = 'utf8mb4';

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";

    try {
        $pdo = new PDO($dsn, $user, $password);
    } catch (PDOException $e) {
        die("Connection failed: ". $e->getMessage());
    }
?>