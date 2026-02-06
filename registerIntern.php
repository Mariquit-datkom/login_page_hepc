<?php

    require_once 'dbConfig.php'; //db connection
    require_once 'sessionChecker.php'; // session heartbeat checker

    //Verifies if current user is an admin, if not, redirect back to log in
    if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'admin') {
        header("Location: loginUser.php");
        exit();
    }   

    $confirmationMessage = "";
    if (isset($_SESSION['registration_msg'])) {
        $confirmationMessage = $_SESSION['registration_msg'];
        unset($_SESSION['registration_msg']); 
    }
?>

<!DOCTYPE html>
<html>
<head>        
    <meta charset= "UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/registerIntern.css">
    <title>Registration Form</title>
</head>
<body>
    <!-- Registration Parent Container -->
    <div class="registrationContainer">
        <h2 class="registrationTitle"> Register an Account </h2>
        <?php echo $confirmationMessage; ?>
        <form action="registrationAuth.php" method="POST" autocomplete="off">
            <div class="formGroup"> <!-- Username Input -->
                <label for="username" class="formLabel"> Username: </label>
                <input type="username" class="formInput" id="username" name="username" required> <br> <br>
            </div>
            <div class="formGroup"> <!-- Password Input -->
                <label for="password" class="formLabel"> Password: </label>  
                <input type="text" class="formInput" id="password" name="password" required> <br> <br>
            </div>
            <div class="registerButtonContainer">
                <input type="submit" class="registerButton" value="Register">
            </div>
        </form>
    </div>

    <!-- Confirmation Message Script with Page Buffer -->
    <?php if (strpos($confirmationMessage, 'successful') !== false): ?>
        <script>
            const redirectConfig = {
                url: 'adminDashboard.php',
                delay: 2000
            };
        </script>
        <script src="js/redirectBuffer.js"></script>
    <?php endif; ?>

    <!-- Scripts -->
    <script src="js/sendHeartbeat.js"></script>
</body>
</html>