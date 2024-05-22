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

if($new_preference==""){
    $_SESSION['error_message'] = "Enter a preference";
    header("Location: ../pages/user_profile_individual.php");
    exit();
}

// Fetch the existing preferences from the database
$sql = "SELECT preferred_cuisines FROM individual_users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $existing_preferences = $row['preferred_cuisines'];
    
    // Append the new preference to the existing allergies
    if (empty($existing_preferences)) {
        $updated_preferences = $new_preference;
    } else {
        $updated_preferences = $existing_preferences . ',' . $new_preference;
    }
    
    // Update the preferences in the database
    $sql = "UPDATE individual_users SET preferred_cuisines = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $updated_preferences, $user_id);
    if ($stmt->execute()) {
        $_SESSION['success_message'] = "Preference successfully added!";
    } else {
        $_SESSION['error_message'] = "Record update error: " . $conn->error;
    }
} else {
    echo "No user found with the specified ID.";
}

$conn->close();
header("Location: ../pages/user_profile_individual.php");
exit();

?>