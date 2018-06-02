<?php include_once "includes/header.php" ?>

    <div class="container">

        <div class="message">
        </div>

        <div id="result">results here.</div>

        <div class="hide" id="controls">
            <button type="button" 
                data-toggle="modal" data-target="#updateModal"
                class="btn btn-secondary btn-sm rounded">update</button>
            <button type="button" class="btn btn-danger btn-sm rounded" id="btn_delete">delete</button>
        </div>

        <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateModalTitle">Update your item</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="updateForm" class="mb-3">
                        
                            <div class="form-group">
                                <input type="text" id="name" name="p_name" class="form-control">
                            </div>

                            <div class="form-group">
                                <input type="number" id="p-price" name="p_price" min="0" class="form-control">
                            </div>

                            <div class="form-group">
                                <textarea id="p-desc" rows="5" name="p_desc" class="form-control"></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button 
                            style="width: 8rem"
                            type="button" id="btn_save" data-dismiss="modal"
                            class="btn btn-secondary btn-sm rounded">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include_once "includes/footer.php" ?>
<script src="assets/js/product.js"></script>