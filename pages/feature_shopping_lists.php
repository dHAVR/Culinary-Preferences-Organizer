<!-- Shopping Lists -->

<!DOCTYPE html>



<html>


   <head>

      <!--Charset-->
      <meta charset="UTF-8">
      
      <!--Title-->
      <title>Shopping Lists</title>

      <!-- Viewport -->
      <meta name = "viewport" content = "width = device-width, initial-scale = 1.0" />

      <!-- Favicon -->
      <link rel = "icon" type = "image/x-icon" href = "../images/favicon.ico" />

      <!-- Global General Stylesheet -->
      <link rel = "stylesheet" href = "../styles/global_general.css">
      
      <link rel = "stylesheet" href = "../styles/shopping_list_style.css" />

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

         <h1 class = "page_title">Shopping List</h1>

         <section class="page">

            <section class="left">
               <h2>List creation</h2>
                 <!-- Create List -->
                 <form action = "#" method = "POST">
                   <label for = "list_name">Name:</label>
                   <input type = "text" id = "list_name" name = "list_name" />
                   <input type = "submit_profile" value = "Create a list" />
               </form>
    
                 <!-- Create List -->
                 <form action = "#" method = "POST">
                   <label for = "new_item">Add item:</label>
                   <input type = "text" id = "new_item" name = "new_item" />
                   <input type = "submit_profile" value = "Add item" />
               </form>
    
             </section>
    
             <section class="center">
                <!-- Shopping list items will be added here -->
                <p><strong>Dinner</strong></p>
                <ul>
                   <li>Bread</li>
                   <li>Suger</li>
                   <li>Milk</li>
                </ul>
             </section>
    
             <section class="right">
                <button>Export to PDF</button>
                <p>List of groups:</p>
                <select>
                   <option value="group1">Family</option>
                   <option value="group2">Friends</option>
                   <option value="group3">School</option>
                </select>
                <button>Share</button>
             </section>
    

         </section>

         
      </main>

      <footer class = "footer">

         <!-- Copyright -->
        <p class = "copyright">
          Copyright &copy; 2024 Culinary Love for You
         </p>

</footer>
     

   </body>


</html>