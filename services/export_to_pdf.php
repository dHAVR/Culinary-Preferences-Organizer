<?php
session_start();

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

if (!isset($_GET['list_id'])) {
    die('No list selected');
}

$list_id = $_GET['list_id'];

# Fetch the selected list
$stmt = $mysql->prepare("SELECT name, content FROM shopping_lists WHERE id = ?");
if ($stmt) {
    $stmt->bind_param("i", $list_id);
    $stmt->execute();
    $stmt->bind_result($list_name, $list_content);
    $stmt->fetch();
    $stmt->close();
} else {
    die('Failed to prepare statement: ' . $mysql->error);
}

# Close the connection.
$mysql->close();

# Prepare HTML content
$html_content = '<h1>Shopping List: ' . htmlspecialchars($list_name) . '</h1>';
$html_content .= '<ul>';
if (!empty($list_content)) {
    $items = explode(',', $list_content);
    foreach ($items as $item) {
        $html_content .= '<li>' . htmlspecialchars($item) . '</li>';
    }
} else {
    $html_content .= '<li>No items in the list.</li>';
}
$html_content .= '</ul>';


$api_key = 'dg463214@gmail.com_5iMY0yBrs281AriA826VO7nxuPac15r4H5v5x39z3KA9Tt8W4vT40eyyv8j4z4B4'; 

# PDF.co API endpoint
$url = 'https://api.pdf.co/v1/pdf/convert/from/html';

# Create request payload
$data = array(
    'html' => $html_content,
    'name' => 'shopping_list.pdf'
);

# Initialize cURL
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'x-api-key: ' . $api_key
));

# Execute request
$response = curl_exec($ch);
curl_close($ch);

# Decode response
$response_data = json_decode($response, true);

if (isset($response_data['url'])) {
    # Redirect to the PDF file
    header('Location: ' . $response_data['url']);
    exit();
} else {
    die('Failed to create PDF: ' . $response_data['message']);
}
?>