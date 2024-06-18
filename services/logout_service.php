<!--
    Logout Service
-->



<?php

    # Send the user to the home page for unauthenticated users.

    $home_redirect = "../index.php";
    header("Location: $home_redirect");
    

    # Finish the current session.

    $_SESSION = array();

    if (ini_get("session.use_cookies"))
    {
        $params = session_get_cookie_params();

        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }

    session_destroy();

?>