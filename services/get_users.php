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

# Fetch users from the database.
$sql_query = "SELECT username FROM individual_users"; # Adjust table name as needed
$result = $mysql->query($sql_query);

# Check if query was successful.
if ($result) {
    $users = $result->fetch_all(MYSQLI_ASSOC);
} else {
    die('Query failed: ' . $mysql->error);
}

# Close the connection.
$mysql->close();
?>