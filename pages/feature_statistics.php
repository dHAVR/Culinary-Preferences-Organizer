<!--
    Statistics Page
-->

<?php
session_start();
include "../services/get_user_info_service.php"
?>


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
        <link rel = "stylesheet" href = "../styles/feature_statistics_general.css">

        <!-- Specific Responsive Stylesheet -->
        <link rel = "stylesheet" href = "../styles/feature_statistics_responsive.css">

        <!-- Title -->
        <title>Statistics</title>

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
                <img class="user_profile_picture" src="data:image/png;base64,<?= $profile_photograph ?>" alt="User profile picture." />
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
                <form class = "search_form" action = "../services/search_results.php" method = "GET">

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
                <h1 class = "page_title">Statistics</h1>
            </div>
            
            <div class = "statistics">

                <div class = "left_content">

                    <!-- Statistics Types -->
                    <section class = "statistics_types">
                        <button class = "button" id = "personal_statistics">Generate Statistics</button>
                    </section>
    
                    <!-- Export Options -->
                    <section class = "export_options">
                        <button class = "button">Export to PDF</button>
                        <button class = "button" onclick = "window.location.href = '../services/statistics_export_csv_service.php'">Export to CSV</button>
                    </section>
    
                </div>
    
                <div class = "right_content">
    
                    <!-- Statistics Visualization -->
                    <section>
                        <div id = "statistics_visualization"></div>
                    </section>
    
                </div>

            </div>

        </main>


        <!-- Footer -->
        <footer class = "footer">

            <!-- Copyright -->
            <p class = "copyright">
                Copyright &copy; 2024 Culinary Love for You
            </p>

        </footer>

        <script>

            document.getElementById('personal_statistics').addEventListener('click', function() {
                fetch('../services/statistics_generation_service.php')
                    .then(response => response.text())
                    .then(data => {
                        document.getElementById('statistics_visualization').innerHTML = data;
                    });
            });

        </script>

    </body>

</html>