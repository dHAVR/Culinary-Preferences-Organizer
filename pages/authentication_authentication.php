<!-- Authentication -->

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
    <link rel="stylesheet" href="../styles/authentication_general.css" />

    <!-- Specific Responsive Stylesheet -->
    <link rel="stylesheet" href="../styles/authentication_responsive.css">

    <!-- Title -->
    <title>Culinary Love for You</title>

</head>

<body>

    <!-- Header -->
    <header class="header">

        <!-- Logo -->
        <a href="../index.php">
            <img class="logo" src="../images/logo.png" alt="Logo." />
        </a>

        <!-- Title -->
        <a class="title_link" href="../index.php">
            <h1 class="title">Culinary Love for You</h1>
        </a>

        <!-- User Profile Picture -->
        <a href="./authentication_authentication.php">
            <img class="user_profile_picture" src="../images/profile_picture_anonymous.png" alt="User profile picture." />
        </a>

    </header>

    <main class="main">
        <div class="login-container">
            <p class="login_title">Log in</p>
            <?php
            session_start();
            if (isset($_SESSION['login_error'])) {
                echo '<p class="error_message">' . $_SESSION['login_error'] . '</p>';
                unset($_SESSION['login_error']);
            }
            ?>
            <form action="../services/authentication_authentication_service.php" method="POST">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                <input type="submit" value="Login">
            </form>
            <a class="link" href="./pages/authentication_registration.php">
               <h1 class="link">Don’t have an account yet? Create one now!</h1>
            </a>
        </div>
    </main>

    <footer class="footer">

        <!-- Copyright -->
        <p class="copyright">
            Copyright &copy; 2024 Culinary Love for You
        </p>

    </footer>

</body>

</html>
