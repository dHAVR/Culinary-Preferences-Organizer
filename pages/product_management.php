<!--
    Product Management Page
    Page Structure
-->



<!DOCTYPE html>



<html>

    <head>

        <!-- Charset -->
        <meta charset = "UTF-8" />

        <!-- Viewport -->
        <meta name = "viewport" content = "width = device-width, initial-scale = 1.0" />

        <!-- Favicon -->
        <link rel = "icon" type = "image/x-icon" href = "../images/favicon.ico" />

        <!-- Global General Stylesheet -->
        <link rel = "stylesheet" href = "../styles/global_general.css">

        <!-- Global Responsive Stylesheet -->
        <link rel = "stylesheet" href = "../styles/global_responsive.css">

        <!-- Specific General Stylesheet -->
        <link rel = "stylesheet" href = "../styles/product_management_general.css">

        <!-- Specific Responsive Stylesheet -->
        <link rel = "stylesheet" href = "../styles/product_management_responsive.css">

        <!-- Title -->
        <title>Product Management</title>

    </head>


    <body>

        <!-- Header -->
        <header class = "header">
            
            <!-- Logo -->
            <a href = "./authentication_home_page.php">
                <img class = "logo" src = "../images/logo.png" alt = "Logo." />
            </a>

            <!-- Title -->
            <a class = "title_link" href = "./authentication_home_page.php">
                <h1 class = "title">Culinary Love for You</h1>
            </a>

            <!-- User Profile Picture -->
            <a href = "./user_profile_individual.php">
                <img class = "user_profile_picture" src = "../images/profile_picture_example.jpg" alt = "User profile picture." />
            </a>

        </header>


        <!-- Main Window -->
        <main class = "main">

            <!-- Banner -->
            <nav class = "banner">

                <!-- Home Button -->
                <a href = "./authentication_home_page.php">
                    <button class = "navbar_button">Home</button>
                </a>

                <!-- Groups Button -->
                <a href = "./feature_groups.php">
                    <button class = "navbar_button">Groups</button>
                </a>

                <!-- Search for a Dish -->
                <form class = "search_form" action = "./feature_food_information.php" method = "GET">

                    <div class = "search_message_container">
                        <label class = "search_message" for = "search_dish">Search for a Dish:</label>
                    </div>
                    
                    <div class = "search_container">
                        <input class = "search_input" type = "text" id = "search_dish" name = "search_dish" placeholder = "Kyiv Cake" />
                        <input class = "search_button" type = "submit" value = "Search!" />
                    </div>

                </form>

                <!-- Statistics Button -->
                <a href = "./feature_statistics.php">
                    <button class = "navbar_button">Statistics</button>
                </a>
                
                <!-- Shopping Lists Button -->
                <a href = "feature_shopping_lists.php">
                    <button class = "navbar_button">Shopping Lists</button>
                </a>

            </nav>

            <!-- Title -->
            <div class = "page_title_container">
                <h1 class = "page_title">Product Management</h1>
            </div>
            
            <!-- Add Product -->
            <section class = "operation_container">

                <h2 class = "operation_title">Add or Delete Product</h2>

                <form class = "operation_form" action = "#" method = "GET">
    
                    <div class = "name_of_product_container">
                        <label class = "product_name_label" for = "product_name">Name of Product:</label>
                        <input class = "operation_input" type = "text" id = "product_name" name = "product_name" placeholder = "kyiv_cake" />
                    </div>

                    <div>
                        <input class = "button operation_button" type = "submit" value = "Add Product" />
                    </div>

                    <div>
                        <input class = "button operation_button" type = "submit" value = "Delete Product" />
                    </div>

                </form>
            
            </section>

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