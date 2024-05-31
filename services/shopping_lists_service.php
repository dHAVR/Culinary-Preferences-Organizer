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

# Fetch groups from the database where the current user is a member
$user_id = $_SESSION['user_id'];
$sql_query_groups = "SELECT id, name, users FROM group_users WHERE FIND_IN_SET(?, users)";
$stmt_groups = $mysql->prepare($sql_query_groups);
if (!$stmt_groups) {
    die('Statement preparation failed: ' . $mysql->error);
}

$stmt_groups->bind_param("i", $user_id);
$stmt_groups->execute();
$result_groups = $stmt_groups->get_result();

$groups = [];
if ($result_groups->num_rows > 0) {
    while ($row = $result_groups->fetch_assoc()) {
        $groups[] = array('name' => $row['name'], 'id' => $row['id'], 'users' => $row['users']);
    }
}

# Handle form submission for sharing the list with a group
if (isset($_POST['action']) && $_POST['action'] == 'Share' && !empty($_POST['list_id']) && !empty($_POST['group_id'])) {
    $list_id = $_POST['list_id'];
    $group_id = $_POST['group_id'];

    # Fetch the users in the selected group
    $stmt_group_users = $mysql->prepare("SELECT users FROM group_users WHERE id = ?");
    if ($stmt_group_users) {
        $stmt_group_users->bind_param("i", $group_id);
        $stmt_group_users->execute();
        $stmt_group_users->bind_result($group_users);
        $stmt_group_users->fetch();
        $stmt_group_users->close();

        $group_users_array = explode(',', $group_users);

        # Fetch the current access list
        $stmt_access = $mysql->prepare("SELECT access FROM shopping_lists WHERE id = ?");
        if ($stmt_access) {
            $stmt_access->bind_param("i", $list_id);
            $stmt_access->execute();
            $stmt_access->bind_result($current_access);
            $stmt_access->fetch();
            $stmt_access->close();

            $current_access_array = explode(',', $current_access);
            $new_access_array = array_unique(array_merge($current_access_array, $group_users_array));
            $new_access = implode(',', $new_access_array);

            # Update the access list in the database
            $stmt_update_access = $mysql->prepare("UPDATE shopping_lists SET access = ? WHERE id = ?");
            if ($stmt_update_access) {
                $stmt_update_access->bind_param("si", $new_access, $list_id);
                $stmt_update_access->execute();
                $stmt_update_access->close();
            }
        }
    }

    header("Location: feature_shopping_lists.php?list_id=$list_id");
    exit();
}

# Close the statements.
$stmt->close();
$stmt_groups->close();

# Close the connection.
$mysql->close();
?>
