<!--
    Groups Page
    Page Structure
-->



<?php

    include "../services/get_user_info_service.php";


    # Connect to the database.

    $mysql = new mysqli
    (
        'localhost',
        'root',
        '',
        'culinary_preferences_organizer'
    );

    if (mysqli_connect_errno())
        die('Connection failed!');


    # Get the current user's ID.

    $user_id = $_SESSION['user_id'];


    # Fetch group names that belong to the current user.

    $sql_query_select = "SELECT name FROM groups WHERE FIND_IN_SET('$user_id', users) > 0;";
    $sql_result_select = $mysql->query($sql_query_select);


    # Store the group names into an array.

    $group_names = [];
    while ($row = $sql_result_select->fetch_assoc())
        $group_names[] = $row['name'];



    # Get the current group name.
    $current_group_name = $_SESSION['current_group'];

    # Fetch the users list (IDs) from the groups table.
    $sql_query_select = "SELECT users FROM groups WHERE name = ?";
    $stmt = $mysql->prepare($sql_query_select);
    $stmt->bind_param("s", $current_group_name);
    $stmt->execute();
    $stmt->bind_result($users);
    $stmt->fetch();
    $stmt->close();

    # Split the user IDs into an array.
    $user_ids = explode(',', $users);

    $formatted_user_names = [];

    # Fetch and format user names based on user IDs.
    foreach ($user_ids as $user_id) {
        $sql_query_user_name = "SELECT first_name, last_name FROM individual_users WHERE id = ?";
        $stmt = $mysql->prepare($sql_query_user_name);
        $stmt->bind_param("i", $user_id);  // Assuming user IDs are integers
        $stmt->execute();
        $stmt->bind_result($first_name, $last_name);
        if ($stmt->fetch()) {
            $formatted_user_names[] = $first_name . ' ' . $last_name;
        }
        $stmt->close();
    }


    # Close the connection.

    $mysql->close();

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
                <form class = "search_form" action = "./search_results.php" method = "GET">

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
    
                    <ul class = "groups_list">

                        <?php foreach ($group_names as $name): ?>
                            <li class = "groups_list_group">
                                <a class = "groups_list_group_link" href = "../services/update_current_group.php?group=<?php echo urlencode($name); ?>">
                                    <?php echo htmlspecialchars($name); ?>
                                </a>
                            </li>
                        <?php endforeach; ?>

                    </ul>
                
                </section>
    
                <!-- Selected Group -->
                <section class = "selected_group_container">

                    <h2 class = "groups_category_title"><?php echo htmlspecialchars($current_group_name); ?></h2>

                    <ul class = "selected_group_list">

                        <?php foreach ($formatted_user_names as $formatted_user_name): ?>
                            <li class = "groups_list_group">
                                <a class = "groups_list_group_link" href = "">
                                    <?php echo htmlspecialchars($formatted_user_name); ?>
                                </a>
                            </li>
                        <?php endforeach; ?>

                    </ul>

                </section>

                <!-- Selected Member -->
                <section class = "selected_member_container">
    
                    <h2 class = "groups_category_title">John Michael</h2>

                    <ul class = "selected_group_list">

                        <li>
                            
                            <p>
                                <span class = "member_information_label">Age: </span>
                                <span class = "member_information_value">25</span>
                            </p>

                            <p>
                                <span class = "member_information_label">Nationality: </span>
                                <span class = "member_information_value">American</span>
                            </p>

                            <p>
                                <span class = "member_information_label">Allergies: </span>
                                <span class = "member_information_value">pollen, dust</span>
                            </p>

                            <p>
                                <span class = "member_information_label">Favorite Dishes: </span>
                                <span class = "member_information_value">Kyiv Cake</span>
                            </p>

                        </li>

                    </ul>

                </section>
    
                <!-- New Group -->
                <section class = "new_group_container">
    
                    <div class = "new_group_title_container">
                        <h2 class = "groups_category_title">New Group</h2>
                    </div>
    
                    <div class = "create_group_container">

                        <!-- Create Group -->
                        <form class = "create_group_form" action = "../services/create_group_service.php" method = "POST">
        
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
                        <form class = "add_person_form" action = "../services/add_person_to_group_service.php" method = "POST">
        
                            <div>
                                <label for = "username">Username:</label>
                                <input class = "username_input" type = "text" id = "username" name = "username" placeholder = "romantudor" />
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