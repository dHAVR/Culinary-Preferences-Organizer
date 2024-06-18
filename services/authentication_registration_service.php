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

    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $username = $_POST["username"];
    $account_type = $_POST["account_type"];
    $raw_password = $_POST["password"];
    $approval_key = $_POST["approval_key"];


    if ($first_name == "" || $last_name == "" || $username == "" || $raw_password == "")
    {
        # Send the user back to the registration page.
        $registration_redirect = "../pages/authentication_registration.php";
        header("Location: $registration_redirect");
        exit();
    }


    # Hash the password.

    $password = password_hash($raw_password, PASSWORD_DEFAULT);


    # Create SQL queries for checking whether the user already has an account or not.

    $sql_query_individual = "SELECT username FROM individual_users WHERE username = '" . $username . "';";
    $sql_query_administrator = "SELECT username FROM administrator_users WHERE username = '" . $username . "';";


    # Get the SQL query results.

    $sql_result_individual = $mysql->query($sql_query_individual);
    $sql_result_administrator = $mysql->query($sql_query_administrator);


    # If not already registered, then register the user.

    $okay = false;

	if ($sql_result_individual->num_rows == 0 && $sql_result_administrator->num_rows == 0)
	{
        $sql_query_insert = "INSERT INTO ";

        if ($account_type == "individual_account_type")
        {
            $sql_query_insert .= "individual";

            $okay = true;
        }
        else
        {
            $sql_query_insert .= "administrator";

            $key = "abkd!&&45ABd71";
            if ($approval_key == $key)
                $okay = true;
        }

        $sql_query_insert .= "_users (first_name, last_name, username, password)";
        $sql_query_insert .= " VALUES ('" . $first_name . "', '";
        $sql_query_insert .= $last_name . "', '" . $username . "', '" . $password . "');";
	}


    if ($okay == true)
    {
        # Add the user to the database.
        $sql_result_insert = $mysql->query($sql_query_insert);
        
        # Send the user to the login page.
        $home_redirect = "../pages/authentication_authentication.php";
        header("Location: $home_redirect");
    }
    else
    {
        # Send the user back to the registration page.
        $registration_redirect = "../pages/authentication_registration.php";
        header("Location: $registration_redirect");
    }


	$mysql->close();

?>