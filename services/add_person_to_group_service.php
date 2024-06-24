<!--

    Add Person to Group
    
    Service

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

    $username = $_POST["username"];

    if ($username != "")
    {
        # Check if the user exists.
        $sql_query_check_user = "SELECT id FROM individual_users WHERE username = ?";
        $stmt = $mysql->prepare($sql_query_check_user);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();  // Store the result so we can count rows.
        
        if ($stmt->num_rows > 0)
        {
            # User exists, fetch the user's ID.
            $stmt->bind_result($user_id);
            $stmt->fetch();
            $stmt->close();

            $current_group_name = $_SESSION['current_group'];

            # Fetch the current users list from the specified group.
            $sql_query_select = "SELECT users FROM groups WHERE name = ?";
            $stmt = $mysql->prepare($sql_query_select);
            $stmt->bind_param("s", $current_group_name);
            $stmt->execute();
            $stmt->bind_result($users);
            $stmt->fetch();
            $stmt->close();

            # Check if the user is already in the group.
            $user_list = explode(',', $users);
            if (!in_array($user_id, $user_list))
            {
                # Add the new user ID to the list.
                $user_list[] = $user_id;
                $new_users_list = implode(',', $user_list);

                # Update the users column in the groups table.
                $sql_query_update = "UPDATE groups SET users = ?, number_of_people = number_of_people + 1 WHERE name = ?";
                $stmt = $mysql->prepare($sql_query_update);
                $stmt->bind_param("ss", $new_users_list, $current_group_name);
                $stmt->execute();
                $stmt->close();
            }
        }
        else
        {
            # User does not exist. Handle the case where the username is not found.
            echo "<script>alert('User not found.');</script>";
        }
    }

    # Redirect to the groups page.
    $groups_redirect = "../pages/feature_groups.php";
    header("Location: $groups_redirect");


    # Close the connection.

	$mysql->close();

?>