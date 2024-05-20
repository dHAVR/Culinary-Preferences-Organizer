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
	{
		die ('Connection failed!');
	}


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
        if ($account_type == "individual_account_type")
        {
            $sql_query_max_id = "SELECT MAX(id) AS 'max_id' FROM individual_users;";
            $sql_result_max_id = $mysql->query($sql_query_max_id);
            $sql_result_max_id = $sql_result_max_id->fetch_assoc();
            $sql_result_max_id = $sql_result_max_id['max_id'];

            $id = $sql_result_max_id + 1;

            $sql_query_insert = "INSERT INTO individual_users (id, first_name, last_name, username, password)";
            $sql_query_insert = $sql_query_insert . " VALUES (" . $id . ", '" . $first_name . "', '";
            $sql_query_insert = $sql_query_insert . $last_name . "', '" . $username . "', '";
            $sql_query_insert = $sql_query_insert . $password . "');";

            $profile_redirect = "../pages/user_profile_individual.php";
        }
        else
        {
            $sql_query_max_id = "SELECT MAX(id) AS max_id FROM administrator_users;";
            $sql_result_max_id = $mysql->query($sql_query_max_id);
            $sql_result_max_id = $sql_result_max_id->fetch_assoc();
            $sql_result_max_id = $sql_result_max_id['max_id'];
            
            $id = $sql_result_max_id + 1;

            $sql_query_insert = "INSERT INTO administrator_users (id, first_name, last_name, username, password)";
            $sql_query_insert = $sql_query_insert . " VALUES (" . $id . ", '" . $first_name . "', '";
            $sql_query_insert = $sql_query_insert . $last_name . "', '" . $username . "', '";
            $sql_query_insert = $sql_query_insert . $password . "');";

            $profile_redirect = "../pages/user_profile_administrator.php";
        }
        

        # Add the user to the database.

        $sql_result_insert = $mysql->query($sql_query_insert);


        # Send the user to his profile page.

        header("Location: $profile_redirect");
	}


    # If already registered, then:

    else
    {
        # Send the user to the registration page again.

        $register_redirect = "../pages/authentication_registration.php";
        header("Location: $register_redirect");
    }

	$mysql->close();

?>