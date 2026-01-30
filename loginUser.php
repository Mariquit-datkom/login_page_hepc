<?php
    session_start();

    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Pragma: no-cache");

    if (isset($_SESSION['username']) && !isset($_GET['action'])) {
        header("Location: " . ( $_SESSION['username'] === 'admin' ? 'adminDashboard.php' : 'normalDashboard.php' ) );
        exit();
    }

    if (isset($_GET['action']) && $_GET['action'] === 'logout') {

        session_unset();
        session_destroy();
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }

    $confirmationMessage = "";
    if(isset($_SESSION['error'])) {
        $confirmationMessage = $_SESSION['error'];
        unset($_SESSION['error']);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/loginUser.css">
    <title>Log In</title>
</head>
<body>
    <div class="loginContainer">
        <h2 class="loginTitle"> Account Log In </h2>
        <?php echo $confirmationMessage; ?>
        <form action="loginAuth.php" method="POST" autocomplete="off">
            <div class="formGroup">
                <label for="username" class="formLabel"> Username: </label>
                <input type="text" class="formInput" id="username" name="username" required> <br> <br>
            </div>
            <div class="formGroup">
                <label for="password" class="formLabel"> Password: </label>
                <input type="password" class="formInput" id="password" name="password" autocomplete="new-password" required> <br> <br>
            </div>
            <div class="loginButtonContainer">
                <input type="submit" class="loginButton" value="Log In">
            </div>
        </form>
    </div>

    <script src="js/stateReplacement.js"></script>
</body>
</html>