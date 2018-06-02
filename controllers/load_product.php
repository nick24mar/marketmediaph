<?php

include "../models/Product.php";
$product = new Product();

$id = $_POST['p_id'];

$item = $product->load_product($id);

if ($item) {
    $response = array(
        "length" => count($item),
        "product" => $item
    );
    echo json_encode($response);
} else {
    echo json_encode(array("message" => "Invalid ID"));
}