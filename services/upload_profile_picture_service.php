<?php
session_start();

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

if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
    $imageData = file_get_contents($_FILES['photo']['tmp_name']);
    $userId = $_SESSION['user_id'];

    $stmt = $conn->prepare("UPDATE `individual_users` SET `profile_photograph` = ? WHERE id = ?");
    if ($stmt === false) {
        die('Prepare failed: ' . $conn->error);
    }
    $stmt->bind_param('si', $imageData, $userId);

    $stmt->execute();
}

$conn->close();
header("Location: ../pages/user_profile_individual.php");
exit();
?>
