<?php

    # Connect to the database.

	$mysql = new mysqli
	(
		'localhost',
		'root',
		'',
		'culinary_preferences_organizer'
	);

	if (mysqli_connect_errno())
		die ('Connection failed!');

// Assume the user is logged in and user ID is stored in session
session_start();
$user_id = $_SESSION['user_id'];

// Get the favorite countries and counts from the user's data
$sql = "SELECT favorite_countries, favorite_dishes FROM individual_users WHERE id = ?";
$stmt = $mysql->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($favorite_countries, $favorite_dishes);
$stmt->fetch();
$stmt->close();

if ($favorite_countries && $favorite_dishes) {
    $countries = explode(',', $favorite_countries);
    $dishes = explode(',', $favorite_dishes);
    $country_count = [];

    foreach ($dishes as $dish) {
        // Fetch the product information from Open Food Facts API search endpoint
        $url = "https://world.openfoodfacts.org/cgi/search.pl?action=process&search_terms=" . urlencode($dish) . "&json=1";
        $response = file_get_contents($url);
        $data = json_decode($response, true);

        if (isset($data['products'][0]['countries_tags'])) {
            $product_countries = $data['products'][0]['countries_tags'];
            foreach ($product_countries as $country) {
                // Extract country name and convert to proper format
                $country_name = ucfirst(str_replace('en:', '', $country));
                if (isset($country_count[$country_name])) {
                    $country_count[$country_name]++;
                } else {
                    $country_count[$country_name] = 1;
                }
            }
        }
    }

    // Create CSV file
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment;filename=favorite_countries.csv');

    $output = fopen('php://output', 'w');
    fputcsv($output, ['Country', 'Number of Favorite Dishes']);

    foreach ($countries as $country) {
        fputcsv($output, [$country, $country_count[$country]]);
    }

    fclose($output);
    exit();
} else {
    echo "No favorite countries found for this user.";
}

$mysql->close();
?>
