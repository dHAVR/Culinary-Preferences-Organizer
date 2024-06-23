<?php

    # Start the session.

    session_start();


    # Connect to the database.

    $mysql = new mysqli
    (
        'localhost',
        'root',
        '',
        'culinary_preferences_organizer'
    );

    if ($mysql->connect_errno)
        die('Connection failed: ' . $mysql->connect_error);


    # Check if the POST variables are set.

    if (isset($_POST["username"]) && isset($_POST["password"]))
    {
        # Get user's input.
        $username = $_POST["username"];
        $password = $_POST["password"];

        # Create SQL queries for checking whether the user exists.
        $sql_query_individual = "SELECT * FROM individual_users WHERE username = ?";
        $sql_query_administrator = "SELECT * FROM administrator_users WHERE username = ?";

        # Prepare statements to prevent SQL injection.
        $stmt_individual = $mysql->prepare($sql_query_individual);
        $stmt_administrator = $mysql->prepare($sql_query_administrator);

        if ($stmt_individual && $stmt_administrator)
        {
            # Bind parameters.
            $stmt_individual->bind_param('s', $username);
            $stmt_administrator->bind_param('s', $username);

            # Execute the statement for individual users.
            $stmt_individual->execute();
            $sql_result_individual = $stmt_individual->get_result();

            # Check if an individual user exists.
            if ($sql_result_individual->num_rows > 0)
            {
                $row = $sql_result_individual->fetch_assoc();

                # Verify the password.
                if (password_verify($password, $row['password']))
                {
                    $_SESSION['user_id'] = $row['id'];
                    $_SESSION['user_type'] = 'individual';

                    header("Location: ../pages/authentication_home_page.php");
                    exit();
                }
                else
                {
                    # Incorrect password.
                    $_SESSION['login_error'] = 'Incorrect username or password.';
                    header("Location: ../pages/authentication_authentication.php");
                    exit();
                }
            }
            else
            {
                # Execute the statement for administrator users.
                $stmt_administrator->execute();
                $sql_result_administrator = $stmt_administrator->get_result();

                # Check if an administrator user exists.
                if ($sql_result_administrator->num_rows > 0)
                {
                    $row = $sql_result_administrator->fetch_assoc();

                    # Verify the password.
                    if (password_verify($password, $row['password']))
                    {
                        $_SESSION['user_id'] = $row['id'];
                        $_SESSION['user_type'] = 'administrator';

                        header("Location: ../pages/user_profile_administrator.php");
                        exit();
                    }
                    else
                    {
                        # Incorrect password.
                        $_SESSION['login_error'] = 'Incorrect username or password.';
                        header("Location: ../pages/authentication_authentication.php");
                        exit();
                    }
                }
                else
                {
                    $_SESSION['login_error'] = 'Incorrect username or password.';
                    header("Location: ../pages/authentication_authentication.php");
                    exit();
                }
            }

            # Close the statements.
            $stmt_individual->close();
            $stmt_administrator->close();
        }
        else
            echo "Error preparing the SQL statements.";
    }
    
    else
        echo "Username or password is not set.";


    # Close the connection.
    
    $mysql->close();

?>