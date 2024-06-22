<?php
require '../dependencies/vendor/autoload.php';
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

function getDatabaseConnection() {
    $conn = new mysqli('localhost', 'root', '', 'culinary_preferences_organizer');

    if ($conn->connect_errno) {
        die('Connection failed: ' . $conn->connect_error);
    }

    return $conn;
}

function getUserAllergies($conn, $userId) {
    $sql = "SELECT allergies FROM individual_users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (!is_null($row['allergies'])) {
            return explode(',', $row['allergies']);
        }
    }

    return [];
}

function getFavoriteCountries($conn) {
    $sql = "SELECT favorite_countries FROM individual_users";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $countries = [];
        while ($row = $result->fetch_assoc()) {
            if (!is_null($row['favorite_countries'])) {
                $countries = array_merge($countries, explode(',', $row['favorite_countries']));
            }
        }
        $countries = array_unique(array_filter($countries)); 
        return $countries;
    } else {
        return [];
    }
}

function productContainsAllergens($product, $allergens) {
    if (empty($allergens)) {
        return false;
    }

    if (!isset($product['allergens_tags']) || !is_array($product['allergens_tags'])) {
        return false;
    }

    foreach ($allergens as $allergen) {
        foreach ($product['allergens_tags'] as $productAllergen) {
            if (stripos($productAllergen, 'en:' . $allergen) !== false) {
                return true;
            }
        }
    }

    return false;
}

function searchProductsByCountries($countries, $allergens) {
    $client = new Client(['base_uri' => 'https://world.openfoodfacts.org']);
    $products = [];
    $totalProducts = 5;
    $productsCount = 0;

    foreach ($countries as $country) {
        if ($productsCount >= $totalProducts) {
            break;
        }

        try {
            $page = rand(1, 5);
            $response = $client->request('GET', '/cgi/search.pl', [
                'query' => [
                    'search_terms' => $country,
                    'page' => $page,
                    'page_size' => 5,
                    'sort_by' => 'unique_scans',
                    'json' => 1
                ]
            ]);

            $data = json_decode($response->getBody(), true);
            if (!empty($data['products'])) {
                foreach ($data['products'] as $product) {
                    if ($productsCount >= $totalProducts) {
                        break 2;
                    }

                    $containsAllergens = productContainsAllergens($product, $allergens);

                    if (!empty($product['product_name']) && !$containsAllergens) {
                        $products[] = [
                            'product_name' => htmlspecialchars($product['product_name']),
                            'brands' => !empty($product['brands']) ? htmlspecialchars($product['brands']) : 'Unknown Brand',
                            'quantity' => !empty($product['quantity']) ? htmlspecialchars($product['quantity']) : 'Unknown Quantity',
                            'image_url' => !empty($product['image_url']) ? htmlspecialchars($product['image_url']) : null,
                            'country' => $country
                        ];
                        $productsCount++;
                    }
                }
            }
        } catch (RequestException $e) {
            error_log('An error occurred: ' . $e->getMessage());
        }
    }

    return $products;
}

function getTopProducts($userId) {
    $conn = getDatabaseConnection();
    $countries = getFavoriteCountries($conn);
    $allergens = getUserAllergies($conn, $userId);

    if (empty($countries)) {
        return [];
    }

    $products = searchProductsByCountries($countries, $allergens);

    $conn->close();
    return $products;
}

$userId = $_SESSION['user_id']; 
$recommended_products = getTopProducts($userId);
?>
