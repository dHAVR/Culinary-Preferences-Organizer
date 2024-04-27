<!-- Home Page for Anonymous Users -->

<!DOCTYPE html>



<html>

    <head>

        <!-- Charset -->
        <meta charset = "UTF-8" />

        <!-- Viewport -->
        <meta name = "viewport" content = "width = device-width, initial-scale = 1.0" />

        <!-- Favicon -->
        <link rel = "icon" type = "image/x-icon" href = "./images/favicon.ico" />

        <!-- Global General Stylesheet -->
        <link rel = "stylesheet" href = "./styles/global_general.css">

        <!-- Global Responsive Stylesheet -->
        <link rel = "stylesheet" href = "./styles/global_responsive.css">

        <!-- Specific Stylesheet -->
        <link rel = "stylesheet" href = "./styles/index.css">
        
        <!-- Title -->
        <title>Culinary Love for You</title>

    </head>


    <body>

        <!-- Header -->
        <header class = "header">
            
            <!-- Logo -->
            <a href = "./index.php">
                <img class = "logo" src = "./images/logo.png" alt = "Logo." />
            </a>

            <!-- Title -->
            <a class = "title_link" href = "./index.php">
                <h1 class = "title">Culinary Love for You</h1>
            </a>

            <!-- User Profile Picture -->
            <a href = "./pages/user_profile_individual.php">
                <img class = "user_profile_picture" src = "./images/profile_picture_anonymous.png" alt = "User profile picture." />
            </a>

        </header>


        <!-- Main Window -->
        <main class = "main">

            <!-- Welcome Message -->
            <p class = "welcome_message">
                Welcome to Culinary Love for You, your personal culinary preferences organizer!
            </p>

            <!-- Login -->
            <a href = "./pages/authentication_authentication.php">
                <button class = "login_button">Login</button>
            </a>
            
            <!-- Register -->
            <a href = "./pages/authentication_registration.php">
                <button class = "register_button">Register</button>
            </a>

        </main>


        <!-- Footer -->
        <footer class = "footer">

            <!-- Copyright -->
            <p class = "copyright">
                Copyright &copy; 2024 Culinary Love for You
            </p>

        </footer>

    </body>

</html>