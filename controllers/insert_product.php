<?php

include "../models/Product.php";
$product = new Product();

$item = array(
    "p_name" => $_POST['p_name'],
    "p_desc" => $_POST['p_desc'],
    "p_price" => $_POST['p_price']
);

echo $product->insert_product($item);