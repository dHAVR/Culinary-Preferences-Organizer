<!-- Authentication -->


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
        <link rel = "stylesheet" href = "../styles/authentication_general.css" />

        <!-- Specific Responsive Stylesheet -->
        <link rel = "stylesheet" href = "../styles/authentication_responsive.css">

        <!-- Title -->
        <title>Culinary Love for You</title>

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
             <img class = "user_profile_picture" src = "../images/profile_picture_anonymous.png" alt = "User profile picture." />
         </a>

     </header>

        <main class="main">
            <div class="login-container">
                    <p class="login_title">Log in</p>
                    <form action="./user_profile_individual.php" method="post">
                        <label for="username">Username:</label>
                        <input type="text" id="username" name="username">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password">
                        <input type="submit" value="Login">
                    </form>
                    <a href="./user_profile_administrator.php">Go to admin account</a>
             </div>
        </main>

      <footer class = "footer">

            <!-- Copyright -->
         <p class = "copyright">
           Copyright &copy; 2024 Culinary Love for You
        </p>

           </footer>

   </body>


</html>
