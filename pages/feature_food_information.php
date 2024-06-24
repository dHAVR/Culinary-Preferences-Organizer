<?php

    session_start();
    $searchResults = isset($_SESSION['search_results']) ? $_SESSION['search_results'] : [];
    $searchMessage = isset($_SESSION['search_message']) ? $_SESSION['search_message'] : null;
    include "../services/get_user_info_service.php";


    // Get info about product.
    $product_name = isset($_GET['product_name']) ? $_GET['product_name'] : "";

    $search_url = "https://world.openfoodfacts.org/cgi/search.pl?action=process&search_terms=" . urlencode($product_name) . "&json=1";
    $response = file_get_contents($search_url);
    $data = json_decode($response, true);

    $countries = [];
    $allergies = [];
    $photograph = "";
    $ingredients = "";

    if (isset($data['products'][0]))
    {
        $product = $data['products'][0];

        // Extract countries where the product is sold
        if (isset($product['countries_tags']))
        {
            foreach ($product['countries_tags'] as $country_tag)
            {
                $country_name = ucfirst(str_replace('en:', '', $country_tag));
                $countries[] = $country_name;
            }
        }

        // Extract allergens information
        if (isset($product['allergens_tags'])) {
            foreach ($product['allergens_tags'] as $allergen_tag) {
                $allergy_name = ucfirst(str_replace('en:', '', $allergen_tag));
                $allergies[] = $allergy_name;
            }
        }

        // Extract ingredients information
        if (isset($product['ingredients_text'])) {
            $ingredients = $product['ingredients_text'];
        }

        // Extract the photograph URL
        if (isset($product['image_url'])) {
            $photograph = $product['image_url'];
        }
    } else {
        echo "Product not found.";
    }

    // Convert arrays to comma-separated strings for easier display or further processing
    $countries_string = implode(", ", $countries);
    $allergies_string = implode(", ", $allergies);

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
    <link rel="stylesheet" href="../styles/feature_food_information_general.css">

    <!-- Specific Responsive Stylesheet -->
    <link rel="stylesheet" href="../styles/feature_food_information_responsive.css">

    <!-- Title -->
    <title><?= $product_name ?></title>

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
        <form class="search_form" action="../services/search_results.php" method="GET">

            <div class="search_message_container">
                <label class="search_message" for="search_dish">Search for a Dish:</label>
            </div>

            <div class="search_container">
                <input class="search_input" type="text" id="search_dish" name="search_dish" placeholder="Coca-Cola" />
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

    <div class="article">

        <div class="page_title_container">
            <h1>Food Information</h1>
        </div>
        <div class="content_label">

            <h2><?= $product_name ?></h2>

            <div class="content">

                <div class="right">

                    <img src="<?= $photograph ?>" alt="Picture of the dish" class="dish_image">

                    <p class="favorite_info">Like!</p>

                    <?php
                    $favorite_dishes_array = explode(',', $user['favorite_dishes']);
                    $is_favorite = in_array($product_name, $favorite_dishes_array);
                    ?>

                    <form action="../services/dishes_managing_service.php" method="POST">
                        <input type="hidden" name="new_preference" value="<?= $product_name ?>">
                        <input type="hidden" name="action" value="<?php echo $is_favorite ? 'Delete dish' : 'Add dish'; ?>">
                        <button class="heart_button">
                            <?php
                            if ($is_favorite) {
                                echo('<img src="../images/heart_filled_icon.svg" class="heart-icon" alt="Heart Icon">');
                            } else {
                                echo('<img src="../images/heart_icon.svg" class="heart-icon" alt="Heart Icon">');
                            }
                            ?>
                        </button>
                    </form>

                </div>

                <div class="food-info">

                <div class = "column-food-info">

                    <div>

                        <p><strong>Ingredients: </strong></p><span><?= $ingredients ?></span>

                    </div>

                    <div>

                        <p><strong>Allergens: </strong></p><span><?= $allergies_string ?></span>

                    </div>

                </div>

                    <div>

                         <p><strong>Available in: </strong></p><span><?= $countries_string ?></span>

                    </div>

                </div>

            </div>

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
