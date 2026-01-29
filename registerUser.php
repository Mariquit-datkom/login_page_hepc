<?php

    require 'dbConfig.php';

    $confirmationMessage = "";
   
    if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

        $checkstmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
        $checkstmt->execute(['username' => $username]);
        $usernameExists = $checkstmt->fetchColumn();

        if ($usernameExists) {
            $confirmationMessage = "<p style='color: red;'>Username already taken. Please choose another.</p>";
        } else {
            $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";
            $stmt = $pdo->prepare($sql);
        
            if ($stmt->execute(['username' => $username, 'password' => $password])) {
                $confirmationMessage = "<p style = 'color: green;'>Registration successful! Redirecting to Log in..</p>";
            } else {
                $confirmationMessage = "<p style = 'color: red;'>Error during registration.</p>";
            }
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>        
        <meta charset= "UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css/registerUser.css">
        <title>Registration Form</title>
    </head>

    <body>
        <div class="registrationContainer">
            <h2 class="registrationTitle"> Register an Account </h2>
            <?php echo $confirmationMessage; ?>
            <form action="registerUser.php" method="POST">
                <div class="formGroup">
                    <label for="username" class="formLabel"> Username: </label>
                    <input type="username" class="formInput" id="username" name="username" required> <br> <br>
                </div>
                <div class="formGroup">
                    <label for="password" class="formLabel"> Password: </label>  
                    <input type="password" class="formInput" id="password" name="password" required> <br> <br>
                </div>
                <div class="registerButtonContainer">
                    <input type="submit" class="registerButton" value="Register">
                </div>
            </form>
        </div>

        <?php if (strpos($confirmationMessage, 'successful') !== false): ?>
            <script>
                const redirectConfig = {
                    url: 'loginUser.php',
                    delay: 2000
                };
            </script>
            <script src="js/redirectBuffer.js"></script>
        <?php endif; ?>
    </body>
</html>