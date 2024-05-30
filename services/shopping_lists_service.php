<?php

# Connect to the database.
$mysql = new mysqli(
    'localhost',
    'root',
    '',
    'culinary_preferences_organizer'
);

if ($mysql->connect_errno) {
    die('Connection failed: ' . $mysql->connect_error);
}

# Fetch lists from the database.
$sql_query = "SELECT id, name FROM shopping_lists WHERE access = ?";
$stmt = $mysql->prepare($sql_query);
$stmt->bind_param("s", $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();

$lists = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $lists[] = array('name' => $row['name'], 'id' => $row['id']);
    }
}



# Close the connection.
$mysql->close();
?>
