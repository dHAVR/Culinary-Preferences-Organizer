<?php
session_start();
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
    <link rel="stylesheet" href="../styles/feature_profile_individual_general.css">

    <!-- Specific Responsive Stylesheet -->
    <link rel="stylesheet" href="../styles/feature_profile_individual_responsive.css">

    <!-- Title -->
    <title>Culinary Love for You</title>
</head>

<body>

<header class="header">

    <!-- Logo -->
    <a href="./authentication_home_page.php">
        <img class="logo" src="../images/logo.png" alt="Logo." />
    </a>

    <!-- Title -->
    <a class="title_link" href="./authentication_home_page.php">
        <h1 class="title">Culinary Love for You</h1>
    </a>

    <!-- User Profile Picture -->
    <a href="./user_profile_individual.php">
        <img class="user_profile_picture" src="../images/profile_picture_example.jpg" alt="User profile picture." />
    </a>

</header>

<main class="main">

    <!-- Banner -->
    <nav class="banner">

        <!-- Home Button -->
        <a href="./authentication_home_page.php">
            <button class="navbar_button">Home</button>
        </a>

        <!-- Groups Button -->
        <a href="./feature_groups.php">
            <button class="navbar_button">Groups</button>
        </a>

        <!-- Search for a Dish -->
        <form class="search_form" action="./feature_food_information.php" method="GET">

            <div class="search_message_container">
                <label class="search_message" for="search_dish">Search for a Dish:</label>
            </div>

            <div class="search_container">
                <input class="search_input" type="text" id="search_dish" name="search_dish" placeholder="Kyiv Cake" />
                <input class="search_button" type="submit" value="Search!" />
            </div>

        </form>

        <!-- Statistics Button -->
        <a href="./feature_statistics.php">
            <button class="navbar_button">Statistics</button>
        </a>

        <!-- Shopping Lists Button -->
        <a href="feature_shopping_lists.php">
            <button class="navbar_button">Shopping Lists</button>
        </a>

    </nav>
    <div class="page_title_container">
        <h1 class="page_title">User Profile</h1>
    </div>

    <div class="content">
        <section class="left">
        <h4>Type of Account: Individual</h4>
            <img src="../images/profile_picture_example.jpg" alt="User Photo">
            <p class="user_info"><strong>Name:</strong> Roman Tudor</p>
            <p class="user_info"><strong>Username:</strong> romantudor</p>
            <p class="user_info"><strong>Nationality:</strong> Romanian</p>
            <p class="user_info"><strong>Age:</strong> 25</p>
   
            <button class="left_button">Change the profile picture</button>
            <button class="left_button">Delete Account</button>
            <a href="../index.html">
                <button class="left_button">Logout</button>
            </a>

        </section>

        <section class="center">
            <h3>Additional information about you:</h3>

            <form action="#" method="POST">
                <section>
                    <input type="text" placeholder="Nationality">
                    <input type="text" placeholder="Age">
                    <input type="text" placeholder="Username">
                    <input type="password" placeholder="Password">
                </section>
                <input type="submit" value="Update Profile" />
            </form>
        </section>

        <section class="right">
            <?php
            if (isset($_SESSION['error_message'])) {
                echo '<p class="error_message">' . $_SESSION['error_message'] . '</p>';
                unset($_SESSION['error_message']);
            }
            if (isset($_SESSION['success_message'])) {
                echo '<p class="success_message">' . $_SESSION['success_message'] . '</p>';
                unset($_SESSION['success_message']);
            }
            ?>

            <h2>Allergies:</h2>
            <form action="../services/allergy_managing_service.php" method="POST">
                <section>
                    <input type="text" name="new_allergy" placeholder="Allergy 1">
                </section>
                <input type="submit" name="action" value="Add Allergy" />
                <input type="submit" name="action" value="Delete Allergy" />
            </form>

            <h2>Culinary Preferences:</h2>
            <form action="../services/preference_managing_service.php" method="POST">
                <section>
                    <input type="text" name="new_preference" placeholder="Preference 1">
                </section>
                <input type="submit" name="action" value="Add Preference" class="add">
                <input type="submit" name="action" value="Delete Preference" class="delete">
            </form>

        </section>


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
