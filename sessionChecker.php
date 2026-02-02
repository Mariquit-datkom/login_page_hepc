<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
require_once 'dbConfig.php';

if (isset($_SESSION['username'])) {
    $uid = $_SESSION['username'];
    $now = time();

    $stmt = $pdo->prepare("SELECT last_ping FROM users WHERE username = ?");
    $stmt->execute([$uid]);
    $user = $stmt->fetch();

    $upd = $pdo->prepare("UPDATE users SET last_ping = ? WHERE username = ?");
    $upd->execute([$now, $uid]);

    if ($user && $user['last_ping'] > 0) {
        $diff = $now - $user['last_ping'];
        
        if ($diff > 20) { 
            session_unset();
            session_destroy();
            header("Location: loginUser.php?reason=expired");
            exit();
        }
    }
} else {
    header("Location: loginUser.php");
    exit();
}

?>