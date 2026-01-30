<?php
    require 'dbConfig.php';
    session_start();
    
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Pragma: no-cache");

    if (!isset($_SESSION['username'])){
        header("Location: loginUser.php");
        exit();
    }

    $currentUser = $_SESSION['username'];
    $currentPage = basename($_SERVER['PHP_SELF']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/adminDashboardPublic.css">
    <title>Requests - Admin</title>
</head>
<body>
    <header>
        <div class="header-left">
            <img src="assets/company_logo.png" alt="company_logo" class="company-logo">
            <span class="dashboard-title"> Requests </span>
        </div>

        <div class="header-right">
            <span class="username"> <?php echo htmlspecialchars($currentUser); ?> </span>
            <div class="user-menu-container">
                <img src="assets/user_avatar.png" alt="user_avatar" class="user-avatar" id="user-avatar-btn">
                <div class="dropdown-content" id="user-avatar-dropdown">
                    <a href="loginUser.php?action=logout">Logout</a>
                </div>
            </div>
        </div>
    </header>

    <nav class="admin-nav-bar">
        <div class="nav-links">
            <a href="adminDashboard.php" class="nav-item 
            <?php echo ($currentPage === 'adminDashboard.php') ? 'active' : ''; ?>" 
            data-text="Dashboard">Dashboard
            </a>

            <a href="internsListPage.php" class="nav-item 
            <?php echo ($currentPage === 'internsListPage.php') ? 'active' : ''; ?>" 
            data-text="Interns List">Interns List
            </a>

            <a href="javascript:void(0)" class="nav-item
            <?php echo ($currentPage === 'requestsPage.php') ? 'active' : ''; ?>" 
            data-text="Requests">Requests
            </a>

            <a href="registerIntern.php" class="nav-item 
            <?php echo ($currentPage === 'registerIntern.php') ? 'active' : ''; ?>" 
            data-text="Register Intern">Register Intern
            </a>
         </div>
    </nav>

    <script src="js/dropDownMenu.js"></script>
    <script src="js/backBtnKiller.js"></script>
</body>
</html>