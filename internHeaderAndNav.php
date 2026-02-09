<header>
    <!-- Page Header -->
    <div class="header-left"> <!-- Company Logo and Page Title -->
        <img src="assets/company_logo.png" alt="company_logo" class="company-logo">
        <span class="dashboard-title">
            <?php 
                // Dynamically set the title based on the page
                switch($currentPage) {
                    case 'internDashboard.php': echo 'Dashboard'; break;
                    case 'accInfo.php': echo 'Account Information'; break;
                    case 'timeSheet.php': echo 'Intern Time Sheet'; break;
                    case 'submitRequest.php': echo 'Request Form'; break;
                }
            ?>
        </span>
    </div>

    <div class="header-right"> <!-- Username and user icon -->
        <span class="username"> <?php echo htmlspecialchars($currentUser); ?> </span>
        <div class="user-menu-container">
            <img src="assets/user_avatar.png" alt="user_avatar" class="user-avatar" id="user-avatar-btn">
            <div class="dropdown-content" id="user-avatar-dropdown">
                <span class="mobile-username"><?php echo htmlspecialchars($currentUser); ?></span>
                <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </div>
        </div>
    </div>
</header>

<!-- Navigation Bar -->
<nav class="nav-bar">
    <div class="nav-links">
        <?php
        $navItems = [
            'internDashboard.php' => ['icon' => 'fa-home', 'text' => 'Dashboard'],
            'accInfo.php'         => ['icon' => 'fa-user', 'text' => 'Account Info'],
            'timeSheet.php'       => ['icon' => 'fa-calendar-alt', 'text' => 'Time Sheet'],
            'submitRequest.php'   => ['icon' => 'fa-paperclip', 'text' => 'Submit Request']
        ];

        foreach ($navItems as $page => $details):
            $isActive = ($currentPage === $page);
            $href = $isActive ? 'javascript:void(0)' : $page;
            $activeClass = $isActive ? 'active' : '';
        ?>
            <a href="<?php echo $href; ?>" 
               class="nav-item <?php echo $activeClass; ?>" 
               data-text="<?php echo $details['text']; ?>">
               <i class="fa <?php echo $details['icon']; ?>"></i><?php echo $details['text']; ?>
            </a>
        <?php endforeach; ?>
    </div>
</nav>