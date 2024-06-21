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
		die ('Connection failed!');


    if (isset($_GET['member']))
    {
        $selected_group_member_name = $_GET['member'];

        $name_parts = explode(" ", $selected_group_member_name);
        $first_name = $name_parts[0];
        $last_name = $name_parts[1];

        $sql_statement = "SELECT age, nationality, allergies, favorite_dishes FROM ";
        $sql_statement .= "individual_users WHERE first_name = ? AND last_name = ?;";
        $stmt = $mysql->prepare($sql_statement);
        $stmt->bind_param("ss", $first_name, $last_name);
        $stmt->execute();
        $stmt->bind_result($age, $nationality, $allergies, $favorite_dishes);

        if ($stmt->fetch())
        {
            $_SESSION['group_member_name'] = $selected_group_member_name;
            $_SESSION['group_member_age'] = $age;
            $_SESSION['group_member_nationality'] = $nationality;
            $_SESSION['group_member_allergies'] = $allergies;
            $_SESSION['group_member_favorite_dishes'] = $favorite_dishes;
        }

        $stmt->close();
    }

    $referer = $_SERVER['HTTP_REFERER'];
    header("Location: $referer");
    exit;

    $mysql->close();

?>