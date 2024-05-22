<!--
    Groups Page
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
        <link rel = "stylesheet" href = "../styles/feature_groups_general.css">

        <!-- Specific Responsive Stylesheet -->
        <link rel = "stylesheet" href = "../styles/feature_groups_responsive.css">

        <!-- Title -->
        <title>Groups</title>

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
                <h1 class = "page_title">Groups</h1>
            </div>
            

            <!-- My Groups -->
            <div class = "groups_container">

                <section class = "my_groups_container">

                    <h2 class = "groups_category_title">My Groups</h2>
    
                    <ul>
                        <li>Friends</li>
                        <li>Family</li>
                        <li>Trip</li>
                    </ul>
                
                </section>
    
                <!-- Selected Group -->
                <section class = "selected_group_container">
    
                    <h2 class = "groups_category_title">Friends</h2>
    
                    <ul>
                        <li>James Smith</li>
                        <li>Linda Mitchell</li>
                        <li>Roger Browns</li>
                    </ul>
    
                </section>
    
                <!-- New Group -->
                <section class = "new_group_container">
    
                    <div class = "new_group_title_container">
                        <h2 class = "groups_category_title">New Group</h2>
                    </div>
    
                    <div class = "create_group_container">

                        <!-- Create Group -->
                        <form class = "create_group_form" action = "#" method = "GET">
        
                            <div>
                                <label for = "group_name">Name:</label>
                                <input class = "group_name_input" type = "text" id = "group_name" name = "group_name" placeholder = "Friends" />
                            </div>
        
                            <div>
                                <input class = "button create_group_button" type = "submit" value = "Create" />
                            </div>
        
                        </form>

                    </div>
    
                    <div class = "add_person_container">

                        <!-- Add Person -->
                        <form class = "add_person_form" action = "#" method = "GET">
        
                            <div>
                                <label for = "email_address">Email Address:</label>
                                <input class = "email_address_input" type = "text" id = "email_address" name = "email_address" placeholder = "linda_smith@gmail.com" />
                            </div>

                            <div>
                                <input class = "button add_person_button" type = "submit" id = "add_person" name = "add_person" value = "Add Person" />
                            </div>

                        </form>

                    </div>
    
                </section>

            </div>

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