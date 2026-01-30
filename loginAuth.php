<?php

    require 'dbConfig.php';
    session_start();

    if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM users WHERE username = :username";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {

            $_SESSION['username'] = $user['username'];

            $redirectURL = ($user['username'] === 'admin') ? 'adminDashboard.php' : 'internDashboard.php';
            header("Location: $redirectURL");
            exit();
            
        } else {

            $_SESSION['error'] = "<p style='color: red;'> Invalid username or password. Please try again. </p>";
            header("Location: loginUser.php");
            exit();
        }
    }
?>