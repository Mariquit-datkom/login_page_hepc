<?php
session_start();
require_once 'dbConfig.php';

if (isset($_SESSION['username'])) {
    $uid = $_SESSION['username'];
    $now = time();
    
    $upd = $pdo->prepare("UPDATE users SET last_ping = ? WHERE username = ?");
    $upd->execute([$now, $uid]);
}