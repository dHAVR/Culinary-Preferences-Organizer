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

    // Get the favorite dishes of the logged-in user
    $sql = "SELECT favorite_dishes FROM individual_users WHERE id = ?";
    $stmt = $mysql->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->bind_result($favorite_dishes);
    $stmt->fetch();
    $stmt->close();

    if ($favorite_dishes)
    {
        $dishes = explode(',', $favorite_dishes);
        $country_count = [];

        foreach ($dishes as $dish) {
            // Fetch the product information from Open Food Facts API search endpoint
            $url = "https://world.openfoodfacts.org/cgi/search.pl?action=process&search_terms=" . urlencode($dish) . "&json=1";
            $response = file_get_contents($url);
            $data = json_decode($response, true);

            if (isset($data['products'][0]['countries_tags'])) {
                $countries = $data['products'][0]['countries_tags'];
                foreach ($countries as $country) {
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

        arsort($country_count);
        $top_countries = array_slice(array_keys($country_count), 0, 5);

        // Start output buffering to capture HTML content
        ob_start();
        echo "<h2>Top Countries Where Favorite Dishes are Sold</h2>";
        echo "<ul>";
        foreach ($top_countries as $country) {
            echo "<li>" . $country . " (" . $country_count[$country] . " dishes)</li>";
        }
        echo "</ul>";
        echo "<h3>Bar Plot</h3>";
        echo "<div style='display: flex;'>";
        foreach ($top_countries as $country) {
            $height = $country_count[$country] * 20; // Basic scaling factor for visualization
            echo "<div style='width: 100px; margin-right: 10px;'>";
            echo "<div style='background-color: blue; height: " . $height . "px;'></div>";
            echo "<div style='text-align: center;'>" . $country . "</div>";
            echo "</div>";
        }
        echo "</div>";
        $html_content = ob_get_clean();




        $endpoint = 'https://api.pdf.co/v1/pdf/convert/from/html';
        $apiKey = 'romantudor.contact@gmail.com_Wi6xnvxmG0cl6HS3wyF62luHfY645AvL8D3lEa6bhiwS7u7A73jScOYEl7Awvyh6';

        $postData = array(
            'html' => $html_content,
            'name' => 'favorite_countries.pdf',
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $endpoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "x-api-key: " . $apiKey,
            "Content-Type: application/json"
        ));

        // Execute cURL session
        $response = curl_exec($ch);
        curl_close($ch);

        // Check if API request was successful
        if (!$response) {
            die('Error: "' . curl_error($ch) . '" - Code: ' . curl_errno($ch));
        }

        // Decode JSON response
        $result = json_decode($response, true);

        // Check if PDF was successfully generated
        if ($result['error'] == false) {
            // Output PDF to browser as a download
            header('Content-Type: application/pdf');
            header('Content-Disposition: attachment; filename="favorite_countries.pdf"');
            echo base64_decode($result['body']);
        } else {
            // Handle error
            echo 'PDF.co API Error: ' . $result['message'];
        }

        exit();
    }
    else
        echo "No favorite dishes found for this user.";

    $mysql->close();

?>