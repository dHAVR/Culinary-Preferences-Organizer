<?php

    session_start();

    if (isset($_GET['group'])) {
        $selected_group = $_GET['group'];
        
        # Validate if the selected group exists (optional)

        $_SESSION['current_group'] = $selected_group;
    }

    # Redirect back to the referring page after updating the session variable
    $referer = $_SERVER['HTTP_REFERER'];
    header("Location: $referer");
    exit;

?>