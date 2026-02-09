<header>
    <!-- Page Header -->
    <div class="header-left"><!-- Company logo and page title -->
        <img src="assets/company_logo.png" alt="company_logo" class="company-logo">
        <span class="dashboard-title">
            <?php 
                // Set the title dynamically based on the current page
                switch($currentPage) {
                    case 'adminDashboard.php': echo 'Admin Dashboard'; break;
                    case 'internsListPage.php': echo 'Interns List'; break;
                    case 'requestsPage.php': echo 'Requests List'; break;
                    case 'registerIntern.php': echo 'Register Intern Account'; break;
                }
            ?>
        </span>
    </div>
    <!-- Username and user icon -->
    <div class="header-right">
        <span class="username"> <?php echo htmlspecialchars($currentUser); ?> </span>
        <div class="user-menu-container">
            <img src="assets/user_avatar.png" alt="user_avatar" class="user-avatar" id="user-avatar-btn">
            <div class="dropdown-content" id="user-avatar-dropdown">
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
            'adminDashboard.php'   => ['icon' => 'fa-home', 'text' => 'Dashboard'],
            'internsListPage.php'  => ['icon' => 'fa-clipboard-list', 'text' => 'Interns List'],
            'requestsPage.php'     => ['icon' => 'fa-question', 'text' => 'Requests'],
            'registerIntern.php'   => ['icon' => 'fa-pencil', 'text' => 'Register Intern']
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