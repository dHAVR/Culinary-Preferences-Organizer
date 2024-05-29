<?php

session_start();

$conn = new mysqli
(
    'localhost',
    'root',
    '',
    'culinary_preferences_organizer'
);

if (mysqli_connect_errno())
{
    die ('Connection failed!');
}


// Get the user ID and the new preference from the POST request
$user_id = $_SESSION['user_id']; 
$new_preference = $_POST['new_preference'];
$action = $_POST['action'];

if (!isset($_SESSION['user_id'])) {
    $_SESSION['error_message'] = "Please Login.";
    header("Location: ../pages/authentication_authentication.php");
    exit();
}

if(empty($new_preference)){
    $_SESSION['error_message'] = "Enter a preference";
    header("Location: ../pages/user_profile_individual.php");
    exit();
}

// Fetch the existing preferences from the database
$sql = "SELECT favorite_dishes FROM individual_users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $existing_preferences = $row['favorite_dishes'];

    if ($action == "Add Preference") {

        $preferences_array = !empty($existing_preferences) ? explode(',', $existing_preferences) : [];

        if (in_array($new_preference, $preferences_array)) {
            $_SESSION['error_message'] = "This preference is already added.";
            header("Location: ../pages/user_profile_individual.php");
            exit();
        }
    
    // Append the new preference to the existing allergies
    if (empty($existing_preferences)) {
        $updated_preferences = $new_preference;
    } else {
        $updated_preferences = $existing_preferences . ',' . $new_preference;
    }
    
    // Update the preferences in the database
    $sql = "UPDATE individual_users SET favorite_dishes = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $updated_preferences, $user_id);
    if ($stmt->execute()) {
        $_SESSION['success_message'] = "Preference successfully added!";
    } else {
        $_SESSION['error_message'] = "Record update error: " . $conn->error;
    }
}elseif($action == "Delete Preference"){
    if (!empty($existing_preferences)) {
        $preferences_array = explode(',', $existing_preferences);
        if (($key = array_search($new_preference, $preferences_array)) !== false) {
            unset($preferences_array[$key]);
            $updated_preferences = implode(',', $preferences_array);

            $sql = "UPDATE individual_users SET favorite_dishes = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("si", $updated_preferences, $user_id);
            if ($stmt->execute()) {
                $_SESSION['success_message'] = "Preferences successfully removed!";

            } else {
                $_SESSION['error_message'] = "Record update error: " . $conn->error;
            }
        } else {
            $_SESSION['error_message'] = "No preference found.";
        }
    } else {
        $_SESSION['error_message'] = "You have no existing allergies.";
    }
}else {
    $_SESSION['error_message'] = "The user with the specified ID was not found.";
}
}

$conn->close();
header("Location: ../pages/user_profile_individual.php");
exit();

?>