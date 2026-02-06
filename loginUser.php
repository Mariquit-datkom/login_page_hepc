<?php
    session_start();

    // Cache clear to prevent unauthorized use of data after log in
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Pragma: no-cache");

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
    <!-- Log in page parent container -->
    <div class="loginContainer">
        <h2 class="loginTitle"> Account Log In </h2>
        <?php echo $confirmationMessage; ?>
        <form action="loginAuth.php" method="POST" autocomplete="off">
            <div class="formGroup"> <!-- Username Input -->
                <label for="username" class="formLabel"> Username: </label>
                <input type="text" class="formInput" id="username" name="username" required> <br> <br>
            </div>
            <div class="formGroup"> <!-- Password Input -->
                <label for="password" class="formLabel"> Password: </label>
                <input type="password" class="formInput" id="password" name="password" autocomplete="new-password" required> <br> <br>
            </div>
            <div class="loginButtonContainer">
                <input type="submit" class="loginButton" value="Log In">
            </div>
        </form>
    </div>

    <!-- Script -->
    <script src="js/formCleaner.js"></script>
</body>
</html>