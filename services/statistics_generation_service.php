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


    session_start();
    $user_id = $_SESSION['user_id'];

    $sql = "SELECT favorite_dishes FROM individual_users WHERE id = ?;";
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

        foreach ($dishes as $dish)
        {
            $url = "https://world.openfoodfacts.org/cgi/search.pl?action=process&search_terms=" . urlencode($dish) . "&json=1";
            $response = file_get_contents($url);
            $data = json_decode($response, true);

            if (isset($data['products'][0]['countries_tags']))
            {
                $countries = $data['products'][0]['countries_tags'];

                foreach ($countries as $country)
                {
                    $country_name = ucfirst(str_replace('en:', '', $country));
                    if (isset($country_count[$country_name]))
                        $country_count[$country_name]++;
                    else
                        $country_count[$country_name] = 1;
                }
            }
        }

        arsort($country_count);
        $top_countries = array_slice(array_keys($country_count), 0, 5);
        $favorite_countries = implode(',', $top_countries);

        $update_sql = "UPDATE individual_users SET favorite_countries = ? WHERE id = ?;";
        $update_stmt = $mysql->prepare($update_sql);
        $update_stmt->bind_param("si", $favorite_countries, $user_id);
        $update_stmt->execute();
        $update_stmt->close();

        echo "<h2>Statistics</h2>";
        echo "<ul>";
        foreach ($top_countries as $country)
        {
            echo "<li>" . ucfirst(str_replace('-', ' ', $country)) . " (" . $country_count[$country] . " dishes)</li>";
        }
        echo "</ul>";
        echo "<h3>Bar Plot</h3>";
        echo "<div style='display: flex;'>";
        foreach ($top_countries as $country)
        {
            $height = $country_count[$country] * 20;
            echo "<div style='width: 100px; margin-right: 10px;'>";
            echo "<div style='background-color: blue; height: " . $height . "px;'></div>";
            echo "<div style='text-align: center;'>" . ucfirst(str_replace('-', ' ', $country)) . "</div>";
            echo "</div>";
        }
        echo "</div>";
    }
    else
        echo "No favorite dishes found for this user.";

    $mysql->close();

?>