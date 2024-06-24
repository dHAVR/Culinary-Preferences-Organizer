<?php

$conn = new mysqli('localhost', 'root', '', 'culinary_preferences_organizer');

if ($conn->connect_errno) {
    die('Connection failed: ' . $conn->connect_error);
}

if (!isset($_SESSION['user_id'])) {
    $_SESSION['error_message'] = "Please Login.";
    header("Location: ../pages/authentication_authentication.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$user_type = $_SESSION['user_type'];

if($user_type == 'individual'){
    $sql = "SELECT * FROM individual_users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if(!empty($user['profile_photograph'])){
            $profile_photograph = base64_encode($user['profile_photograph']);
        }else{
            $profile_photograph = base64_encode(file_get_contents('../images/profile_picture_anonymous.png'));
        }

    } else {
        $_SESSION['error_message'] = "User not found.";
        header("Location: ../pages/authentication_authentication.php");
        exit();
    }

}else{

    $sql = "SELECT * FROM administrator_users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0) {
        $user = $result->fetch_assoc();

    } else {
        $_SESSION['error_message'] = "User not found.";
        header("Location: ../pages/authentication_authentication.php");
        exit();
    }

}

$conn->close();
?>