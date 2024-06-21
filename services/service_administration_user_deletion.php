<!--
    Service - Administration - User Deletion
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

    $username = $_POST["username"];


    # Delete the user.

    $sql_query = "DELETE FROM individual_users WHERE username = ?;";
    $stmt = $mysql->prepare($sql_query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->close();

    $sql_query1 = "DELETE FROM administrator_users WHERE username = ?;";
    $stmt1 = $mysql->prepare($sql_query1);
    $stmt1->bind_param("s", $username);
    $stmt1->execute();
    $stmt1->close();

    $redirect = "../pages/data_management.php";
    header("Location: $redirect");


    # Close the connection.

	$mysql->close();

?>