<?php
require_once 'dbConfig.php'; //db connection
session_start(); // session fetch

//Updates heartbeat / ping to database
if (isset($_SESSION['username'])) {
    $uid = $_SESSION['username'];
    $now = time();
    
    $upd = $pdo->prepare("UPDATE users SET last_ping = ? WHERE username = ?");
    $upd->execute([$now, $uid]);
}