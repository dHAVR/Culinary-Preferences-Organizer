<?php
require '../dependencies/vendor/autoload.php';

use GuzzleHttp\Client;

session_start();

function searchProductsByName($productName) {
    $client = new Client(['base_uri' => 'https://world.openfoodfacts.org']);
    $products = [];
    $uniqueProductNames = [];

    try {
        
        $response = $client->request('GET', '/cgi/search.pl', [
            'query' => [
                'search_terms' => $productName,
                'page' => 1,
                'page_size' => 20,
                'sort_by' => 'unique_scans',
                'json' => 1
            ]
        ]);

        $data = json_decode($response->getBody(), true);

        if (!empty($data['products'])) {
            foreach ($data['products'] as $product) {
                
                if (!empty($product['product_name']) && !in_array($product['product_name'], $uniqueProductNames) && count($products) < 9) {
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
                                'brands' => htmlspecialchars($product['brands']),
                                'quantity' => htmlspecialchars($product['quantity']),
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
    $_SESSION['search_results'] = searchProductsByName($productName);
    header('Location: ../pages/search_results.php');
    exit();
} else {
    header('Location: ../index.php');
    exit();
}
?>
