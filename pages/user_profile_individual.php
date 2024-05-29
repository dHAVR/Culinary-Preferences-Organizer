<?php
include "../services/get_user_info_service.php"
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
    <title>My Profile</title>
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
        <img class="user_profile_picture" src="data:image/png;base64,<?= $profile_photograph ?>" alt="User profile picture." />
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
        <h1 class="page_title">My Profile</h1>
    </div>

    <div class="content">
        <section class="left">
            <h4>Type of Account: Individual</h4>
            <div class="user_info_main">
                <div class="user_info_row">
                    <img src="data:image/png;base64,<?= $profile_photograph ?>" alt="User Photo">
                     <div class="user_info_column">
                        <p class="user_info"><strong>First name:</strong> <?= htmlspecialchars($user['first_name']) ?></p>
                        <p class="user_info"><strong>Last name:</strong> <?= htmlspecialchars($user['last_name']) ?></p>
                        <p class="user_info"><strong>Email:</strong> <?= htmlspecialchars($user['email_address']) ?></p>
                        <p class="user_info"><strong>Username:</strong> <?= htmlspecialchars($user['username']) ?></p>
                     </div>
                </div>
                <div>
                    <p class="user_info"><strong>Nationality:</strong> <?= htmlspecialchars($user['nationality']) ?></p>
                    <p class="user_info"><strong>Age:</strong> <?= htmlspecialchars($user['age']) ?></p>
                    <p class="user_info"><strong>Allergies:</strong> <?= htmlspecialchars($user['allergies']) ?></p>
                    <p class="user_info"><strong>Favorite dishes:</strong> <?= htmlspecialchars($user['favorite_dishes']) ?></p>

                </div>
            </div>
            <form method="post" enctype="multipart/form-data" action="../services/upload_profile_picture_service.php">
                <label for="file-upload" class="custom-file-upload">
                    Choose a photo
                </label>
                <input id="file-upload" type="file" name="photo" required>
                <button type="submit" class="button">Upload</button>
            </form>

        </section>

            <section class="center">
                <h3>Additional information about you:</h3>

                <form action="../services/update_profile_service.php" method="POST">
                    <div class="center_form"> <!-- Изменено с section на div и добавлен class -->
                        <input type="text" name="email_address" placeholder="Email", value="<?= htmlspecialchars($user['email_address']) ?>">
                        <div class="center_form_info"> <!-- Добавлен class -->
                            <div>
                                <input type="text" name="first_name" placeholder="First name" value="<?= htmlspecialchars($user['first_name']) ?>">
                                <input type="text" name="nationality" placeholder="Nationality" value="<?= htmlspecialchars($user['nationality']) ?>">
                                <input type="text" name="username" placeholder="Username" value="<?= htmlspecialchars($user['username']) ?>">
                            </div>
                            <div>
                                <input type="text" name="last_name" placeholder="Last name" value="<?= htmlspecialchars($user['last_name']) ?>">
                                <input type="text" name="age" placeholder="Age" value="<?= htmlspecialchars($user['age']) ?>">
                                <input type="password" name="password" placeholder="Password">
                            </div>
                        </div>
                        <input class = "button" type="submit" value="Update Profile" />
                    </div>
                </form>

                <!-- Delete Account -->
                <form action = "../services/account_deletion_service.php" method = "GET">
                    <button class = "button">Delete Account</button>
                </form>
                
                <!-- Logout -->
                <form action = "../services/logout_service.php" method = "GET">
                    <button class = "button">Logout</button>
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
                    <input type="text" name="new_allergy" placeholder="Enter allergy...">
                </section>
                <input class = "button" type="submit" name="action" value="Add Allergy" />
                <input class = "button" type="submit" name="action" value="Delete Allergy" />
            </form>
           <div class="favorite_dishes">
            <h2>Favorite dishes:</h2>
            <form action="../services/dishes_managing_service.php" method="POST" >
                <section>
                    <input type="text" name="new_preference" placeholder="Enter favorite dish to delete...">
                </section>
                <input type="submit" name="action" value="Delete dish" class="button delete">
            </form>
        </div>

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