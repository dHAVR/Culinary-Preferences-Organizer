<!--
    Account Deletion Service
-->



<?php

    session_start();

    # Connect to the database.

	$mysql = new mysqli
	(
		'localhost',
		'root',
		'',
		'culinary_preferences_organizer'
	);

	if (mysqli_connect_errno())
	{
		die ('Connection failed!');
	}


    # Get the ID and type of the user.

    $user_id = $_SESSION['user_id'];
    $user_type = $_SESSION['user_type'];
    

    # Create SQL queries for checking whether the user already has an account or not.

    $sql_query = "DELETE FROM ";
    
    if ($user_type == "individual")
        $sql_query .= "individual";
    else
        $sql_query .= "administrator";
    
    $sql_query .= "_users WHERE id = " . $user_id . ";";


    # Execute the query.

    $mysql->query($sql_query);


    # Send the user to the home page for unauthenticated users.

    $home_redirect = "../index.php";
    header("Location: $home_redirect");


    # Finish the current session.

    session_destroy();
    

	$mysql->close();

?>