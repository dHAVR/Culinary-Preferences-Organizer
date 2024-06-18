<!--
    Registration Page
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
        <link rel = "stylesheet" href = "../styles/authentication_registration_general.css">

        <!-- Specific Responsive Stylesheet -->
        <link rel = "stylesheet" href = "../styles/authentication_registration_responsive.css">

        <!-- Title -->
        <title>Register</title>

    </head>


    <body>

        <!-- Header -->
        <header class = "header">
            
            <!-- Logo -->
            <a href = "../index.php">
                <img class = "logo" src = "../images/logo.png" alt = "Logo." />
            </a>

            <!-- Title -->
            <a class = "title_link" href = "../index.php">
                <h1 class = "title">Culinary Love for You</h1>
            </a>

            <!-- User Profile Picture -->
            <a href = "../index.php">
                <img class = "user_profile_picture" src = "../images/profile_picture_anonymous.png" alt = "User profile picture." />
            </a>

        </header>


        <!-- Main Window -->
        <main class = "main">

            <!-- Title -->
            <div class = "page_title_container">
                <h1 class = "page_title">Register</h1>
            </div>

            <!-- Registration Form -->
            <div class = "registration_form_container">

                <form class = "registration_form" action = "../services/authentication_registration_service.php" method = "POST">

                    <!-- First Name -->
                    <div class = "first_name_container">
                        <label class = "label_text" for = "first_name">First Name:</label>
                        <input class = "input_field" type = "text" id = "first_name" name = "first_name" placeholder = "Tudor" />
                    </div>

                    <!-- Last Name -->
                    <div class = "last_name_container">
                        <label class = "label_text" for = "last_name">Last Name:</label>
                        <input class = "input_field" type = "text" id = "last_name" name = "last_name" placeholder = "Roman" />
                    </div>

                    <!-- Username -->
                    <div class = "username_container">
                        <label class = "label_text" for = "username">Username:</label>
                        <input class = "input_field" type = "text" id = "username" name = "username" placeholder = "tudorroman" />
                    </div>
    
                    <!-- Account Type -->
                    <div class = "account_type_container">
                        <label class = "label_text" for = "account_type">Account Type:</label>
                        <select class = "input_field select_input" id = "account_type" name = "account_type">
                            <option class = "option" value = "individual_account_type">Individual</option>
                            <option class = "option" value = "administrator_account_type">Administrator</option>
                        </select>
                    </div>

                    <!-- Password -->
                    <div class = "password_container">
                        <label class = "label_text" for = "password">Password:</label>
                        <input class = "input_field" type = "password" id = "password" name = "password" placeholder = "*********" />
                    </div>

                    <!-- Approval Key -->
                    <div class = "password_container">
                        <label class = "label_text" for = "approval_key">Approval Key*:</label>
                        <input class = "input_field" type = "password" id = "approval_key" name = "approval_key" placeholder = "*********" />
                    </div>

                    <!-- Note -->
                    <p class = "note">*: Only when requesting to create an administrator account.</p>
    
                    <!-- Register -->
                    <div class = "submit_container">
                        <input class = "button submit_button" type = "submit" value = "Register" />
                    </div>
    
                </form>

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