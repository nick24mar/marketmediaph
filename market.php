<?php include "includes/header.php"; ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-2">
            <aside class="text-center sidenav bg-custom p-3 text-white">
                <h5>Controls here</h5>
                <hr>
                <button 
                    class="btn btn-primary btn-sm btn-block rounded" 
                    type="button" 
                    data-toggle="modal" 
                    data-target="#collapse-form">
                        <i class="fas fa-plus fa-sm"></i>&nbsp;Sell Something
                </button>

                <p class="mt-3">Lorem ipsum dolor sit amet 
                    consectetur adipisicing elit. Nobis eveniet 
                    possimus ipsum? Velit optio, aliquam vero
                    assumenda consectetur rerum accusantium ex 
                    vitae culpa eaque unde ipsa cupiditate enim,
                    at magni dolorum impedi</p>
            </aside>
        </div>

        <div class="col-md-10">
            <div class="content mb-2">

                <div class="modal fade" id="collapse-form" tabindex="-1" role="dialog" aria-labelledby="collapse-form" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h6 class="modal-title" id="collapse-form">
                                    <i class="fas fa-cart-plus fa-sm"></i>
                                    <b>Sell something on Market Media PH</b>
                                </h6>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="productForm" method="post" >

                                    <div class="form-group">
                                        <input type="text" id="name" name="p_name" placeholder="What are you selling" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <input type="number" id="p-price" name="p_price" min="0" placeholder="Price" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <textarea id="p-des" rows="5" name="p_desc" class="form-control" placeholder="Describe your item"></textarea>
                                    </div>

                                </form>
                            </div>
                            <div class="modal-footer">
                                <button 
                                    style="width: 8rem"
                                    type="button" id="btn_post" data-dismiss="modal"
                                    class="btn btn-primary btn-sm rounded">Post</button>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="card-columns" id="products">
                    Loading...
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "includes/footer.php";?>
<script src="assets/js/market.js"></script>
