<?php

include "../models/Product.php";
$product = new Product();

$formBody = $_POST;

$product->update_product($formBody); //Send to server to update product

$updatedProduct = $product->load_product($formBody['p_id']); // Get the udpated product for response

echo json_encode($updatedProduct);