<!--
    Logout Service
-->



<?php

    # Send the user to the home page for unauthenticated users.

    $home_redirect = "../index.php";
    header("Location: $home_redirect");
    

    # Finish the current session.

    session_destroy();

?>