<!--
    Create Group Service
-->



<?php

    # Connect to the database.

    session_start();

	$mysql = new mysqli
	(
		'localhost',
		'root',
		'',
		'culinary_preferences_organizer'
	);

	if (mysqli_connect_errno())
		die ('Connection failed!');


    # Get user's input.

    $name = $_POST["group_name"];

    if ($name != "")
    {
        # Calculate the other parameters.
        $number_of_people = 1;
        $users = (string) $_SESSION['user_id'];

        # Prepare the SQL statement.
        $sql_query_insert = "INSERT INTO groups (name, number_of_people, users) VALUES ('";
        $sql_query_insert .= $name . "', " . $number_of_people . ", '" . $users . "');";

        # Add the group to the database.
        $sql_result_insert = $mysql->query($sql_query_insert);

        # Set a session variable.
        $_SESSION['current_group'] = $name;
    }

    $groups_redirect = "../pages/feature_groups.php";
    header("Location: $groups_redirect");


    # Close the connection.

	$mysql->close();

?>