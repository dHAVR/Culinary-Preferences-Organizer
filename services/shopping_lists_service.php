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
$sql_query = "SELECT id, name, access FROM shopping_lists";
$stmt = $mysql->prepare($sql_query); 
if (!$stmt) {
    die('Statement preparation failed: ' . $mysql->error);
}

$stmt->execute();
$result = $stmt->get_result();

$lists = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $access = explode(',', $row['access']);

        if (in_array($_SESSION['user_id'], $access)) {
            $lists[] = array('name' => $row['name'], 'id' => $row['id']);
        }
    }
}

# Close the statement.
$stmt->close();

# Close the connection.
$mysql->close();
?>
