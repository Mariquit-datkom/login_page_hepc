<?php
    require 'dbConfig.php';

    $confirmationMessage = "";

    if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM users WHERE username = :username";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $redirectURL = 'dashboard.php';
            header("Location: $redirectURL");
            exit();
        } else {
            $confirmationMessage = "<p style='color: red;'>Invalid username or password.</p>";
        }
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
        <form action="loginUser.php" method="POST">
            <div class="formGroup">
                <label for="username" class="formLabel"> Username: </label>
                <input type="text" class="formInput" id="username" name="username" required> <br> <br>
            </div>
            <div class="formGroup">
                <label for="password" class="formLabel"> Password: </label>
                <input type="password" class="formInput" id="password" name="password" required> <br> <br>
            </div>
            <div class="loginButtonContainer">
                <input type="submit" class="loginButton" value="Log In">
            </div>
        </form>
    </div>
</body>
</html>