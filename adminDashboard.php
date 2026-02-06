<?php
    require_once 'dbConfig.php'; //db connection   
    require_once 'sessionChecker.php'; //Session heartbeat checker
    
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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/adminDashboardPublic.css">
    <title>Dashboard - Admin</title>
</head>
<body>
    <!-- Page Header -->
    <header>
        <div class="header-left">
            <img src="assets/company_logo.png" alt="company_logo" class="company-logo">
            <span class="dashboard-title"> Admin Dashboard </span>
        </div>

        <div class="header-right">
            <span class="username"> <?php echo htmlspecialchars($currentUser); ?> </span>
            <div class="user-menu-container">
                <img src="assets/user_avatar.png" alt="user_avatar" class="user-avatar" id="user-avatar-btn">
                <div class="dropdown-content" id="user-avatar-dropdown">
                    <a href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </header>

    <!-- Page Navigation Bar -->
    <nav class="admin-nav-bar">
        <div class="nav-links">
            <a href="javascript:void(0)" class="nav-item 
            <?php echo ($currentPage === 'adminDashboard.php') ? 'active' : ''; ?>" 
            data-text="Dashboard">Dashboard
            </a>

            <a href="internsListPage.php" class="nav-item 
            <?php echo ($currentPage === 'internsListPage.php') ? 'active' : ''; ?>" 
            data-text="Interns List">Interns List
            </a>

            <a href="requestsPage.php" class="nav-item
            <?php echo ($currentPage === 'requestsPage.php') ? 'active' : ''; ?>" 
            data-text="Requests">Requests
            </a>

            <a href="registerIntern.php" class="nav-item 
            <?php echo ($currentPage === 'registerIntern.php') ? 'active' : ''; ?>" 
            data-text="Register Intern">Register Intern
            </a>
        </div>
    </nav>

    <!-- Scripts -->
    <script src="js/dropDownMenu.js"></script>
    <script src="js/backBtnKiller.js"></script>
    <script src="js/sendHeartbeat.js"></script>
</body>
</html>