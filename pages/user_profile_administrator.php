<!-- Administrator User Profile -->

<!DOCTYPE html>



<html>

   <head>

      <!--Charset-->
      <meta charset="UTF-8">

      <!-- Viewport -->
      <meta name = "viewport" content = "width = device-width, initial-scale = 1.0" />

      <!-- Favicon -->
      <link rel = "icon" type = "image/x-icon" href = "../images/favicon.ico" />

      <!--Title-->
      <title>My Profile</title>

      <link rel = "stylesheet" href = "../styles/admin_user_page_style.css" />

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

         <section class="main_section">

            <h2 class = "page_title">User Profile</h2>

            <section class = "left">
    
             <h4>Account Type: Administrator</h4>
    
             <section class="grid-container">
    
             <form action="#" method="post">
                <section>
                   <label for="username">Username:</label>
                   <input type="text" id="username" name="username">
                </section>
                
                <section>
                   <label for="password">Password:</label>
                   <input type="password" id="password" name="password">
                </section>
             
            </form>
    
            <input type="submit" value="Update Credits">
    
             </section>
    
            <button class = "action_button">Delete Account</button>
            <button class = "action_button">Logout</button>
    
            </section>
           
            <section class="right">
                 <!--Information to which the admin should have access (for example, a list of users)-->
                <h2>Database Information</h2>
               <p id = "title_list_of_users">List of users:</p>
               <ul>
                <li>Anna</li>
                <li>Kostya</li>
                <li>Petro</li>
             </ul>
            </section>
   

         </section>

        
      </main>

      <footer class = "footer">

         <!-- Copyright -->
         <p class = "copyright">
             Copyright &copy; 2024 Culinary Preferences Organizer
         </p>

     </footer>

   </body>

</html>