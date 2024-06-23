<?php
require '../dependencies/vendor/autoload.php';

use GuzzleHttp\Client;

session_start();

function searchProductsByName($productName) {
    $client = new Client(['base_uri' => 'https://world.openfoodfacts.org']);
    $products = [];
    $uniqueProductNames = [];

    try {
       
        $page = rand(1, 5);
        $sortOptions = ['unique_scans', 'popularity'];
        $sort_by = $sortOptions[array_rand($sortOptions)];

        $response = $client->request('GET', '/cgi/search.pl', [
            'query' => [
                'search_terms' => $productName,
                'page' => $page,
                'page_size' => 20,
                'sort_by' => $sort_by,
                'json' => 1
            ]
        ]);

        $data = json_decode($response->getBody(), true);

        if (!empty($data['products'])) {
            foreach ($data['products'] as $product) {
                if (!empty($product['product_name']) && !in_array($product['product_name'], $uniqueProductNames) && count($products) < 6) {
                    if (isset($product['countries_tags']) && is_array($product['countries_tags'])) {
                        $englishCountries = array_filter($product['countries_tags'], function($countryTag) {
                            return strpos($countryTag, 'en:') === 0;
                        });

                        if (!empty($englishCountries)) {
                            $countries = array_map(function($countryTag) {
                                return ucwords(str_replace("en:", "", $countryTag));
                            }, $englishCountries);

                            $products[] = [
                                'product_name' => htmlspecialchars($product['product_name']),
                                'brands' => !empty($product['brands']) ? htmlspecialchars($product['brands']) : 'Unknown Brand',
                                'quantity' => !empty($product['quantity']) ? htmlspecialchars($product['quantity']) : 'Unknown Quantity',
                                'countries' => htmlspecialchars(implode(', ', $countries)),
                                'image_url' => isset($product['image_url']) ? htmlspecialchars($product['image_url']) : null
                            ];
                            $uniqueProductNames[] = $product['product_name'];
                        }
                    }
                }
            }
        }
    } catch (Exception $e) {
        echo "An error occurred: " . $e->getMessage() . "\n";
    }

    return $products;
}

if (isset($_GET['search_dish'])) {
    $productName = trim($_GET['search_dish']);
    if (empty($productName)) {
        $_SESSION['search_message'] = "Please enter a product name to search.";
        header('Location: ../pages/search_results.php');
        exit();
    }
    $_SESSION['search_results'] = searchProductsByName($productName);
    $_SESSION['search_message'] = null;
    header('Location: ../pages/search_results.php');
    exit();
} else {
    header('Location: ../index.php');
    exit();
}
?>
