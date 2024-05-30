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

$selected_list_name = '';
$selected_list_content = '';

# Handle form submission for creating a new list
if (isset($_POST['action']) && $_POST['action'] == 'Create a list' && !empty($_POST['list_name'])) {
    $list_name = $_POST['list_name'];
    $user_id = $_SESSION['user_id'];
    $access = $user_id;  // Assuming the creator has access initially
    $content = '';

    $stmt = $mysql->prepare("INSERT INTO shopping_lists (name, content, access) VALUES (?, ?, ?)");
    if ($stmt) {
        $stmt->bind_param("sss", $list_name, $content, $access);
        $stmt->execute();
        $list_id = $stmt->insert_id;  // Get the ID of the newly created list
        $stmt->close();

        # Set the selected list variables to the newly created list
        $selected_list_name = $list_name;
        $selected_list_content = $content;

        header("Location: feature_shopping_lists.php?list_id=$list_id");
        exit();
    }
}

# Handle form submission for adding an item to the selected list
if (isset($_POST['action']) && $_POST['action'] == 'Add item' && !empty($_POST['new_item']) && !empty($_POST['list_id'])) {
    $new_item = $_POST['new_item'];
    $list_id = $_POST['list_id'];

    # Fetch current content
    $stmt = $mysql->prepare("SELECT content FROM shopping_lists WHERE id = ?");
    if ($stmt) {
        $stmt->bind_param("i", $list_id);
        $stmt->execute();
        $stmt->bind_result($content);
        $stmt->fetch();
        $stmt->close();

        # Append the new item
        $content = $content ? $content . ',' . $new_item : $new_item;

        # Update the list with the new content
        $stmt = $mysql->prepare("UPDATE shopping_lists SET content = ? WHERE id = ?");
        if ($stmt) {
            $stmt->bind_param("si", $content, $list_id);
            $stmt->execute();
            $stmt->close();

            # Set the selected list variables to the updated list
            $selected_list_name = '';
            foreach ($lists as $list) {
                if ($list['id'] == $list_id) {
                    $selected_list_name = $list['name'];
                    break;
                }
            }
            $selected_list_content = $content;

            header("Location: feature_shopping_lists.php?list_id=$list_id");
            exit();
        }
    }
}

# Fetch lists from the database.
$sql_query = "SELECT id, name, access, content FROM shopping_lists";
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
            $lists[] = array('name' => $row['name'], 'id' => $row['id'], 'content' => $row['content']);
        }
    }
}

# Fetch the content and name of the selected list
if (isset($_GET['list_id'])) {
    $list_id = $_GET['list_id'];
    foreach ($lists as $list) {
        if ($list['id'] == $list_id) {
            $selected_list_content = $list['content'];
            $selected_list_name = $list['name'];
            break;
        }
    }
}

# Close the statement.
$stmt->close();

# Close the connection.
$mysql->close();
?>
