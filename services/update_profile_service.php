<?php
session_start();

$conn = new mysqli('localhost', 'root', '', 'culinary_preferences_organizer');

if ($conn->connect_errno) {
    die('Connection failed: ' . $conn->connect_error);
}

if (!isset($_SESSION['user_id'])) {
    $_SESSION['error_update_message'] = "Please Login.";
    header("Location: ../pages/authentication_authentication.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$user_type = $_SESSION['user_type'];

$updates = [];
$params = [];

function validate_input($data, $field) {
    switch ($field) {
        case 'email_address':
            return filter_var($data, FILTER_VALIDATE_EMAIL);
        case 'age':
            return filter_var($data, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
        case 'password':
            return strlen($data) >= 1;
        case 'username':
            return preg_match('/^[a-zA-Z0-9_]+$/', $data);
        default:
            return !empty(trim($data));
    }
}

if ($user_type == 'individual') {
    $fields = ['first_name', 'last_name', 'email_address', 'nationality', 'age', 'username', 'password'];

    foreach ($fields as $field) {
        if (!empty($_POST[$field]) && validate_input($_POST[$field], $field)) {
            $updates[] = "$field = ?";
            $params[] = $_POST[$field];
        } elseif (!empty($_POST[$field])) {
            $_SESSION['error_update_message'] = "Invalid value for $field.";
            header("Location: ../pages/user_profile_individual.php");
            exit();
        }
    }

    if (!empty($updates)) {
        $sql = "UPDATE individual_users SET " . implode(', ', $updates) . " WHERE id = ?";
        $params[] = $user_id;

        $stmt = $conn->prepare($sql);

        $types = str_repeat('s', count($params) - 1) . 'i';
        $stmt->bind_param($types, ...$params);

        if ($stmt->execute()) {
            $_SESSION['success_message_update'] = "Profile updated successfully!";
        } else {
            $_SESSION['error_update_message'] = "Record update error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        $_SESSION['error_update_message'] = "No valid data to update.";
    }

    header("Location: ../pages/user_profile_individual.php");

} else {
    $fields = ['username', 'password'];

    foreach ($fields as $field) {
        if (!empty($_POST[$field]) && validate_input($_POST[$field], $field)) {
            $updates[] = "$field = ?";
            $params[] = $_POST[$field];
        } elseif (!empty($_POST[$field])) {
            $_SESSION['error_update_message'] = "Invalid value for $field.";
            header("Location: ../pages/user_profile_administrator.php");
            exit();
        }
    }

    if (!empty($updates)) {
        $sql = "UPDATE administrator_users SET " . implode(', ', $updates) . " WHERE id = ?";
        $params[] = $user_id;

        $stmt = $conn->prepare($sql);

        $types = str_repeat('s', count($params) - 1) . 'i';
        $stmt->bind_param($types, ...$params);

        if ($stmt->execute()) {
            $_SESSION['success_message'] = "Profile updated successfully!";
        } else {
            $_SESSION['error_update_message'] = "Record update error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        $_SESSION['error_update_message'] = "No valid data to update.";
    }

    header("Location: ../pages/user_profile_administrator.php");
}

$conn->close();
exit();
?>
