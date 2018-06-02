<?php

include "../models/Product.php";

$product = new Product();

$items = $product->load_all_products();

if(count($items) > 0) {
    $response = array(
        "length" => count($items),
        "items" => array_values($items)
    );

    echo json_encode($response);
} else {
    echo json_encode(array("message" => "No products yet.."));
}