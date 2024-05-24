<?php
session_start();

$conn = new mysqli('localhost', 'root', '', 'culinary_preferences_organizer');

if ($conn->connect_errno) {
    die('Connection failed!');
}

if (!isset($_SESSION['user_id'])) {
    $_SESSION['error_message'] = "Please Login.";
    header("Location: ../pages/authentication_authentication.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$updates = [];
$params = [];


if (!empty($_POST['first_name'])) {
    $updates[] = "first_name = ?";
    $params[] = $_POST['first_name'];
}

if (!empty($_POST['last_name'])) {
    $updates[] = "last_name = ?";
    $params[] = $_POST['last_name'];
}

if (!empty($_POST['email_address'])) {
    $updates[] = "email_address = ?";
    $params[] = $_POST['email_address'];
}

if (!empty($_POST['nationality'])) {
    $updates[] = "nationality = ?";
    $params[] = $_POST['nationality'];
}

if (!empty($_POST['age'])) {
    $updates[] = "age = ?";
    $params[] = $_POST['age'];
}

if (!empty($_POST['username'])) {
    $updates[] = "username = ?";
    $params[] = $_POST['username'];
}

if (!empty($_POST['password'])) {
    $updates[] = "password = ?";
    $params[] = password_hash($_POST['password'], PASSWORD_DEFAULT); // Хеширование пароля
}


if (!empty($updates)) {
    $sql = "UPDATE individual_users SET " . implode(', ', $updates) . " WHERE id = ?";
    $params[] = $user_id;

    $stmt = $conn->prepare($sql);

    $types = str_repeat('s', count($params) - 1) . 'i';
    $stmt->bind_param($types, ...$params);

    if ($stmt->execute()) {
        $_SESSION['success_message'] = "Profile updated successfully!";
    } else {
        $_SESSION['error_message'] = "Record update error: " . $conn->error;
    }
} else {
    $_SESSION['error_message'] = "No data to update.";
}

$conn->close();
header("Location: ../pages/user_profile_individual.php");
exit();
?>
