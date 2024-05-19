<!-- Food Information -->

<!DOCTYPE html>



<html>

    <head>

        <meta charset="UTF-8">

        <!-- Viewport -->
        <meta name = "viewport" content = "width = device-width, initial-scale = 1.0" />

        <!-- Favicon -->
        <link rel = "icon" type = "image/x-icon" href = "../images/favicon.ico" /> 

        <!-- Global General Stylesheet -->
        <link rel = "stylesheet" href = "../styles/global_general.css">

        <!--Style-->
        <link rel = "stylesheet" href = "../styles/food_information_style.css" />
                
        <title>Food Information</title>

    </head>


    <body>

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
        
        <main>

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

            <h1>Food Information</h2>

            <article>

                <h2>Kyiv Cake</h2>

                <div class="food-info">

                    <img src="../images/kyiv_cake.png" alt="Picture of the dish">

                    <div class="details">
                        <p ><strong>Origin: </strong>&nbsp;Ukraine</p>
                        <p ><strong>Description:</strong> &nbsp;Kyivski tort is a cake originating from Kyiv,
                             the capital of Ukraine. 
                             Instead of common sponge cake, kyivski tort contains a nutty
                              meringue with a crunchy and airy texture, a technique which
                               was created in 1956 at the Karl Marx Confectionery Factory.

                            Although walnuts were initially used for the 
                            meringue, they were later replaced with cashews,
                             and then hazelnuts. The layers of nutty meringue 
                             are combined with a sweet vanilla and chocolate buttercream. 
                             The cake is usually sprinkled with chopped hazelnuts and left 
                             to cool before serving, so that the cream develops a silky, 
                             mousse-like texture..</p>
                    </div>

                </div>

                <div class="ingredients">

                    <h3>Ingredients:</h3>

                    <ul>
                        <li>Eggs</li>
                        <li>sugger powder</li>
                        <li>hazelnuts</li>
                        <li>flour</li>
                        <li>butter</li>
                        <li>sugger</li>
                        <li>milk</li>
                        <li>cacao</li>

                    </ul>

                </div>

            </article>

        </main>

        <footer class = "footer">

            <!-- Copyright -->
            <p class = "copyright">
                Copyright &copy; 2024 Culinary Love for You
            </p>

        </footer>

    </body>

</html>