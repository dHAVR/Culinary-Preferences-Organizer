<?php
session_start();
$searchResults = isset($_SESSION['search_results']) ? $_SESSION['search_results'] : [];
  include "../services/get_user_info_service.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../images/favicon.ico">
    <link rel="stylesheet" href="../styles/global_general.css">
    <link rel="stylesheet" href="../styles/global_responsive.css">
    <link rel="stylesheet" href="../styles/search_results_general.css">
    <link rel="stylesheet" href="../styles/search_results_responsive.css">
    <title>Search Results</title>
</head>
<body>

    <!-- Header -->
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

    <!-- Main Window -->
    <main class="main">
        <!-- Banner -->
        <nav class="banner">
            <a href="./authentication_home_page.php">
                <button class="navbar_button">Home</button>
            </a>
            <a href="./feature_groups.php">
                <button class="navbar_button">Groups</button>
            </a>
        <!-- Search for a Dish -->
        <form class="search_form" action="./search_results.php" method="GET">

            <div class="search_message_container">
                <label class="search_message" for="search_dish">Search for a Dish:</label>
            </div>

            <div class="search_container">
                <input class="search_input" type="text" id="search_dish" name="search_dish" placeholder="Kyiv Cake" />
                <input class="search_button" type="submit" value="Search!" />
            </div>

        </form>
            <a href="./feature_statistics.php">
                <button class="navbar_button">Statistics</button>
            </a>
            <a href="feature_shopping_lists.php">
                <button class="navbar_button">Shopping Lists</button>
            </a>
        </nav>

        <!-- Title -->
        <div class="page_title_container">
            <h1 class="page_title">Search Results</h1>
        </div>

        <!-- Search Results -->
        <div class="search_results_container">
            <ul class="search_results_list">
            <?php
                if (!empty($searchResults)) {
                    foreach ($searchResults as $product) {
                        echo '<li>';
                        echo '<a class="search_result_link" href="./feature_food_information.php?product_name=' . urlencode($product['product_name']) . '">';
                        echo htmlspecialchars($product['product_name']);
                        echo '</a>';
                        echo '</li>';
                    }
                } else {
                    echo '<li>No products found.</li>';
                }
                ?>
            </ul>
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <p class="copyright">
            Copyright &copy; 2024 Culinary Love for You
        </p>
    </footer>

</body>
</html>


