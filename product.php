
<?php 

include "includes/header.php";

include_once "models/Product.php";

$product = new Product();

if(!array_key_exists("delete", $_GET)) {
    if (!array_key_exists("update", $_GET)) {
        $p_id = $_GET['id'];
        $item = $product->load_product($p_id);
    
        if ($item) {
            echo render_product($item, $p_id);
        } else {
            echo "<div class='alert alert-warning'>Invalid id</div>";
        }
    }
} else {
    echo "
        <div class='alert alert-success'>
            Product deleted..
            <a href='market.php'>Back to market</a>
        </div>
    ";
}

if(array_key_exists("update", $_GET)) {
    echo "
        <div class='alert alert-success'>
            Product updated..
            <a href='market.php'>Back to market</a>
        </div>
    ";
}

function render_product($item) {
    return '
        <div class="card text-dark">
            <div class="card-body">
                <div class="product-details">
                    <h4 class="card-title">'.$item["product_name"].'</h4>
                    <p class="card-text"><b>&#8369;'.number_format($item["product_price"]).'</b></p>
                    <p class="card-text">'.$item["product_description"].'</p>
                    <p class="card-text">
                        <small class="text-muted">
                        '.date("m/d/Y h:i A", strtotime($item["product_posted"])).'
                        </small>
                    </p>
                </div>

                <div class="collapse mt-2" id="collapse-form">

                    <form id="updateForm">
                        <fieldset>
                            <legend>Update Product 
                                <span class="float-right">
                                    <button type="button" id="btnClose"
                                    class="btn btn-danger btn-sm"
                                    data-toggle="collapse" 
                                    data-target="#collapse-form" 
                                    aria-expanded="false" 
                                    aria-controls="collapse-form">
                                        &times;
                                    </button>
                                </span>
                            </legend>
                        </fieldset>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Name: </label>
                                    <input type="text" id="name" name="p_name" class="form-control" value="'.$item["product_name"].'">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="p-price">Price: </label>
                                    <input type="number" id="p-price" name="p_price" min="0" class="form-control" value="'.$item["product_price"].'">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="p-desc">Description: </label>
                            <textarea id="p-desc" rows="5" name="p_desc" class="form-control">'.$item["product_description"].'</textarea>
                        </div>

                        <button type="submit" class="btn btn-outline-secondary float-right rounded">
                            Submit
                        </button>

                    </form>
                </div>
            </div>
            <div class="card-footer">
                <button type="button" id="btnUpdate" class="btn btn-default btn-sm"
                    data-toggle="collapse" 
                    data-target="#collapse-form" 
                    aria-expanded="false" 
                    aria-controls="collapse-form">
                    <i class="fa fa-edit" aria-hidden="true"></i>
                    Update
                </button>
                
                <button type="button" id="btnDelete" name="btn_delete" class="btn btn-outline-danger btn-sm">
                    <i class="fa fa-trash-alt" aria-hidden="true"></i>
                    Delete
                </button>
            </div>
        </div>
     ';
}
?>

<?php include "includes/footer.php";?>
    
<script src="assets/js/product.js"></script>