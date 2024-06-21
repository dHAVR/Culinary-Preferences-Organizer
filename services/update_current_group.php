<?php

    session_start();


    if (isset($_GET['group']))
    {
        $selected_group = $_GET['group'];
        $_SESSION['current_group'] = $selected_group;
    }

    $referer = $_SERVER['HTTP_REFERER'];
    header("Location: $referer");
    exit;

?>