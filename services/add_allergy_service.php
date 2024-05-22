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


if (!isset($_SESSION['user_id'])) {
    $_SESSION['error_message'] = "Please login.";
    header("Location: ../pages/authentication_authentication.php");
    exit();
}

$user_id = $_SESSION['user_id']; 
$new_allergy = $_POST['new_allergy'];

if($new_allergy==""){
    $_SESSION['error_message'] = "Enter an allergy";
    header("Location: ../pages/user_profile_individual.php");
    exit();
}



if (empty($new_allergy)) {
    $_SESSION['error_message'] = "Enter allergies.";
    header("Location: ../pages/user_profile_individual.php");
    exit();
}


$sql = "SELECT allergies FROM individual_users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $existing_allergies = $row['allergies'];
    

    if (empty($existing_allergies)) {
        $updated_allergies = $new_allergy;
    } else {
        $updated_allergies = $existing_allergies . ', ' . $new_allergy;
    }
    
 
    $sql = "UPDATE individual_users SET allergies = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $updated_allergies, $user_id);
    if ($stmt->execute()) {
        $_SESSION['success_message'] = "Allergy successfully added!";
    } else {
        $_SESSION['error_message'] = "Record update error: " . $conn->error;
    }
} else {
    $_SESSION['error_message'] = "The user with the specified ID was not found.";
}

$conn->close();
header("Location: ../pages/user_profile_individual.php");
exit();
?>
