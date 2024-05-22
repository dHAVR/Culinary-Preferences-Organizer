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


// Get the user ID and the new allergy from the POST request
$user_id = $_SESSION['user_id']; 
$new_allergy = $_POST['new_allergy'];

// Fetch the existing allergies from the database
$sql = "SELECT allergies FROM individual_users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $existing_allergies = $row['allergies'];
    
    // Append the new allergy to the existing allergies
    if (empty($existing_allergies)) {
        $updated_allergies = $new_allergy;
    } else {
        $updated_allergies = $existing_allergies . ',' . $new_allergy;
    }
    
    // Update the allergies in the database
    $sql = "UPDATE individual_users SET allergies = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $updated_allergies, $user_id);
    if ($stmt->execute()) {
        echo "Allergy added successfully!";
    } else {
        echo "Error updating record: " . $conn->error;
    }
} else {
    echo "No user found with the specified ID.";
}

$conn->close();


?>