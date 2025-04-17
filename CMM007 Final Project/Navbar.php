<?php
require_once "DBConnect.php";
?>

<header class="mb-5 sticky-top">
    <nav class="container d-flex flex-nowrap navbar bg-light shadow-sm ">
        <div class="container">
            <img src="../Assets/stirling_council_logo.PNG" alt="Stirling Council Logo" class="img-fluid d-block rounded" style="width: 100px; height: auto;">
            <a href="../Website Homepage/homepage.php" class="navbar-brand fw-bold text-dark fs-1" style="font-size: x-large; align-items: start;">Dunblane Library</a>
            <div>
                <a href="../Website Homepage/homepage.php" class="btn btn-secondary">Search Books</a>

                <!-- NAV BAR UPDATES BASED ON USER TYPE BEING 'USER' -->
                <?php if (isset($_SESSION['userID'])): ?>
                    <?php if (isset($_SESSION['userType']) && $_SESSION['userType'] === 'User'): ?>
                        <a href="../User Dashboard/User Dashboard.php" class="btn btn-secondary">Profile</a>

                    <!-- NAV BAR UPDATES BASED ON USER TYPE BEING 'ADMIN' -->
                    <?php elseif (isset($_SESSION['userType']) && $_SESSION['userType'] === 'Admin'): ?>
                        <a href="../Admin Dashboard/Admin Dashboard.php" class="btn btn-secondary">Profile</a>
                    <?php endif; ?>

                    <a href="../logout.php" class="btn btn-outline-secondary text-nowrap">Log Out</a>
                
                    <?php else: ?>
                    <!-- NAV BAR UPDATES BASED ON USER NOT BEING LOGGED IN -->
                    <button class="btn btn-secondary" onclick="window.location.href='../Login Page/Login Page.html'">Log In</button>
                <?php endif; ?>
            </div>
        </div>
    </nav>
</header>

