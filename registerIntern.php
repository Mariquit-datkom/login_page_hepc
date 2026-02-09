<?php
    require_once 'dbConfig.php'; //db connection   
    require_once 'sessionChecker.php'; //Session heartbeat checker
    require_once 'x-head.php'; // icons
    
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

    $confirmationMessage = "";
    if (isset($_SESSION['registration_msg'])) {
        $confirmationMessage = $_SESSION['registration_msg'];
        unset($_SESSION['registration_msg']); 
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/public.css">
    <link rel="stylesheet" href="css/registerIntern.css">
    <title>Register an Intern</title>
</head>
<body>
    <!-- Generate Page Header and Nav Bar -->
     <?php include 'adminHeaderAndNav.php'; ?>
    
    <!-- Registration Parent Container -->
    <div class="registrationContainer">
        <div class="form-title-container">
            <h2 class="registrationTitle"> Register an Account </h2>
            <?php echo $confirmationMessage; ?>
        </div>
        <form action="registrationAuth.php" method="POST" autocomplete="off">
            <div class="row">
                <div class="formGroup"> <!-- Username Input -->
                    <label for="username" class="formLabel"> Username: </label>
                    <input type="username" class="formInput" id="username" name="username" required>
                </div>
            </div>
            <div class="row">
                <div class="formGroup"> <!-- Password Input -->
                    <label for="password" class="formLabel"> Password: </label>  
                    <input type="text" class="formInput" id="password" name="password" required>
                </div>
            </div>
            <div class="row">
                <div class="formGroup"> <!-- Password Confirmation -->
                    <label for="confirm-password" class="formLabel"> Confirm Password: </label>  
                    <input type="text" class="formInput" id="confirm-password" name="confirm-password" required>
                </div>
            </div>
            <div class="registerButtonContainer">
                <input type="submit" class="registerButton" value="Register">
            </div>
        </form>
    </div>

    <!-- Scripts -->
    <script src="js/dropDownMenu.js"></script>
    <script src="js/backBtnKiller.js"></script>
    <script src="js/sendHeartbeat.js"></script>
</body>
</html>