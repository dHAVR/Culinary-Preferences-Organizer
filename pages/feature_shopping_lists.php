<!-- Shopping Lists -->
<?php
session_start();
include "../services/get_user_info_service.php";
include "../services/shopping_lists_service.php";
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
    <link rel="stylesheet" href="../styles/feature_shopping_list_general.css">

    <!-- Specific Responsive Stylesheet -->
    <link rel="stylesheet" href="../styles/feature_shopping_list_style_responsive.css">

    <!-- Title -->
    <title>Shopping Lists</title>
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
            <form class="search_form" action="./search_results.php" method="GET">
                <div class="search_message_container">
                    <label class="search_message" for="search_dish">Search for a Dish:</label>
                </div>
                <div class="search_container">
                    <input class="search_input" type="text" id="search_dish" name="search_dish" placeholder="Kyiv Cake" />
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

        <div class="page_title_container">
            <h1 class="page_title">Shopping Lists</h1>
        </div>

        <section class="page">
            <section class="left">
                <h2>List creation</h2>
                <!-- Create List -->
                <form action="feature_shopping_lists.php" method="POST">
                    <label for="list_name">Name:</label>
                    <input type="text" id="list_name" name="list_name" />
                    <input class="button" type="submit" name="action" value="Create a list" />
                </form>

                <!-- Add Item to Selected List -->
                <form action="feature_shopping_lists.php" method="POST">
                    <label for="new_item">Add item:</label>
                    <input type="text" id="new_item" name="new_item" />
                    <input type="hidden" name="list_id" value="<?= isset($_GET['list_id']) ? htmlspecialchars($_GET['list_id']) : '' ?>" />
                    <input class="button" type="submit" name="action" value="Add item" />
                </form>
            </section>

            <section class="center">
                <h2>
                    <?php
                        if (!empty($selected_list_name)) {
                            echo htmlspecialchars($selected_list_name);
                        } else {
                            echo 'Selected List';
                        }
                    ?>
                </h2>
                <div id="selected_list_content">
                    <?php
                        if (!empty($selected_list_content)) {
                            $items = explode(',', $selected_list_content);
                            echo '<ul>';
                            foreach ($items as $item) {
                                echo '<li>' . htmlspecialchars($item) . '</li>';
                            }
                            echo '</ul>';
                        } else {
                            echo '<p>No list selected or list is empty.</p>';
                        }
                    ?>
                </div>
            </section>

            <section class="right">
                <form action="../services/export_to_pdf.php" method="GET" target="_blank">
                    <input type="hidden" name="list_id" value="<?= isset($_GET['list_id']) ? htmlspecialchars($_GET['list_id']) : '' ?>" />
                    <button class="button" type="submit">Export to PDF</button>
                </form>

                <p><strong>List of groups:</strong></p>
                <form action="feature_shopping_lists.php" method="POST">
                    <select class="select_group" name="group_id">
                        <?php
                            foreach ($groups as $group) {
                                echo '<option value="' . $group['id'] . '">' . htmlspecialchars($group['name']) . '</option>';
                            }
                        ?>
                    </select>
                    <input type="hidden" name="list_id" value="<?= isset($_GET['list_id']) ? htmlspecialchars($_GET['list_id']) : '' ?>" />
                    <input class="button" type="submit" name="action" value="Share" />
                </form>

                <p><strong>Choose created list:</strong></p>
                <form action="feature_shopping_lists.php" method="GET">
                    <?php
                        echo '<select name="list_id">';
                        foreach ($lists as $list) {
                            echo '<option value="' . $list['id'] . '">' . htmlspecialchars($list['name']) . '</option>';
                        }
                        echo '</select>';
                    ?>
                    <input class="button" type="submit" value="Open list"/>
                </form>

                <!-- Delete List -->
                <form action="feature_shopping_lists.php" method="POST">
                    <input type="hidden" name="list_id" value="<?= isset($_GET['list_id']) ? htmlspecialchars($_GET['list_id']) : '' ?>" />
                    <input class="button" type="submit" name="action" value="Delete list"/>
                </form>
            </section>
        </section>
    </main>

    <footer class="footer">
        <!-- Copyright -->
        <p class="copyright">
            Copyright &copy; 2024 Culinary Love for You
        </p>
    </footer>
</body>
</html>
