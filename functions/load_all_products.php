<?php

include "../models/Product.php";

$product = new Product();

$items = $product->load_all_products();

if($items) {
    foreach($items as $item) {
        echo render_product($item);
    }
} else {
    echo "No products yet..";
}

function render_product($item) {
   return '
        <a href="another_test.php?id='.$item["id"].'">
            <div class="card text-dark shadow">

                <div class="card-header d-flex">

                    <img class="align-self-start mt-1 mr-3" src="https://eabiawak.com/wp-content/uploads/2017/07/photo.png" 
                        alt="Generic placeholder image" width="54" height="54">

                    <div class="mt-2">
                        <span class="mt-0">Anonymous User</span>
                        <p>
                            <small class="text-muted">
                            '.date("M d Y | h:i A", strtotime($item["product_posted"])).'
                            </small>
                        </p>
                    </div>

                </div>
                
                <img class="card-img"
                src="https://blog.twitter.com/content/dam/blog-twitter/official/en_us/products/2017/rethinking-our-default-profile-photo/Avatar-Blog2-Round1.png.img.fullhd.medium.png" alt="Card image cap">
            
                <div class="card-body">
                    <div class="d-flex">
                        <h5 class="card-title mt-2 flex-grow-1">'.$item["product_name"].'</h5>
                        <h4 class="card-title mt-2">
                            <span class="badge badge-pill badge-dark"><b>&#8369;'.number_format($item["product_price"]).'</b></span>
                        </h4>
                    </div>

                    <p class="card-text">'.$item["product_description"].'</p>
                </div>
            </div>
        </a>
    ';
}