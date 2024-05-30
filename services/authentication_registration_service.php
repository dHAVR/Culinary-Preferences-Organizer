<!--
    Registration Service
-->



<?php

    # Connect to the database.

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

    $first_name = $_GET["first_name"];
    $last_name = $_GET["last_name"];
    $username = $_GET["username"];
    $account_type = $_GET["account_type"];
    $password = $_GET["password"];


    # Create SQL queries for checking whether the user already has an account or not.

    $sql_query_individual = "SELECT username FROM individual_users WHERE username = '" . $username . "';";
    $sql_query_administrator = "SELECT username FROM administrator_users WHERE username = '" . $username . "';";


    # Get the SQL query results.

    $sql_result_individual = $mysql->query($sql_query_individual);
    $sql_result_administrator = $mysql->query($sql_query_administrator);


    # If not already registered, then register the user.

	if ($sql_result_individual->num_rows == 0 && $sql_result_administrator->num_rows == 0)
	{
        $sql_query_insert = "INSERT INTO ";

        if ($account_type == "individual_account_type")
            $sql_query_insert .= "individual";
        else
            $sql_query_insert .= "administrator";

        $sql_query_insert .= "_users (first_name, last_name, username, password)";
        $sql_query_insert .= " VALUES ('" . $first_name . "', '";
        $sql_query_insert .= $last_name . "', '" . $username . "', '" . $password . "');";

        
        # Add the user to the database.

        $sql_result_insert = $mysql->query($sql_query_insert);
	}
    

    # Send the user to the login page.

    $home_redirect = "../pages/authentication_authentication.php";
    header("Location: $home_redirect");


	$mysql->close();

?>