

<?php
session_start();
include "../services/get_user_info_service.php";
include "../services/get_users.php";
?>
<!DOCTYPE html>

<html>

<head>

    <!-- Charset -->
    <meta charset="UTF-8" />

    <!-- Viewport -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../images/favicon.ico" />

    <!-- Global General Stylesheet -->
    <link rel="stylesheet" href="../styles/global_general.css">

    <!-- Global Responsive Stylesheet -->
    <link rel="stylesheet" href="../styles/global_responsive.css">

    <!-- Specific General Stylesheet -->
    <link rel="stylesheet" href="../styles/admin_user_page_general.css">

    <!-- Specific Responsive Stylesheet -->
    <link rel="stylesheet" href="../styles/admin_user_page_responsive.css">

    <!-- Title -->
    <title>My Profile</title>

</head>

<body>

    <header class="header">

        <!-- Logo -->
        <a href="./user_profile_administrator.php">
            <img class="logo" src="../images/logo.png" alt="Logo." />
        </a>

        <!-- Title -->
        <a class="title_link" href="./user_profile_administrator.php">
            <h1 class="title">Culinary Love for You</h1>
        </a>

        <!-- User Profile Picture -->
        <a href="./user_profile_administrator.php">
            <img class="user_profile_picture" src="../images/profile_picture_anonymous.png" alt="User profile picture." />
        </a>

    </header>

    <main class="main">

        <div class="page_title_container">
            <h2 class="page_title">My Profile</h2>
        </div>

        <section class="main_section">

            <section class="left">
                <h2 class="admin_info"><strong>Hi, <?= htmlspecialchars($user['username']) ?>!</strong></h2>
                <h4>Account Type: Administrator</h4>
                <?php
                if (isset($_SESSION['error_update_message'])) {
                    echo '<p class="error_message">' . $_SESSION['error_update_message'] . '</p>';
                    unset($_SESSION['error_update_message']);
                }
                if (isset($_SESSION['error_update_message'])) {
                    echo '<p class="success_message">' . $_SESSION['error_update_message'] . '</p>';
                    unset($_SESSION['success_message_update']);
                }
            ?>

                <form action="../services/update_profile_service.php" method="post">
                    <section>
                        <label for="username">Username:</label>
                        <input type="text" id="username" name="username">
                    </section>

                    <section>
                        <label for="email">Email:</label>
                        <input type="email_address" id="email_address" name="email_address">
                    </section>

                    <section>
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password">
                    </section>

                    <input class="button action_button" type="submit" value="Update Information">
                </form>

                <!-- Delete Account -->
                <form class = "form" action="../services/account_deletion_service.php" method="GET">
                    <button class="button action_button">Delete Account</button>
                </form>

                <!-- Logout -->
                <form class = "form" action="../services/logout_service.php" method="GET">
                    <button class="button action_button">Logout</button>
                </form>

            </section>

            <section class="right">
                <!--Information to which the admin should have access (for example, a list of users)-->
                <h2>Database Information</h2>
                <p id="title_list_of_users">List of users:</p>
                <ul>
                    <?php
                    foreach ($users as $user) {
                        echo "<li>" . htmlspecialchars($user['username']) . "</li>";
                    }
                    ?>
                </ul>

                <!-- Product Management -->
                <form action="./data_management.php" method="GET">
                    <button class="button management_but">Management</button>
                </form>
            </section>

        </section>

    </main>

    <footer class="footer">

        <!-- Copyright -->
        <p class="copyright">
            Copyright &copy; 2024 Culinary Love for You
        </p>

    </footer>

</body>

</html>
