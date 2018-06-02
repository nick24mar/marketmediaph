<?php

include "../models/Product.php";
$product = new Product();

$id = $_POST['p_id'];

$response = array("message" => $product->remove_product($id));

echo json_encode($response);