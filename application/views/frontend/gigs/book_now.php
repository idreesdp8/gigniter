<div class="modal fade" id="book_now_modal" tabindex="-1" role="dialog" aria-labelledby="book_now_modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="background-color: #05102f">
            <div class="modal-header">
                <h5 class="modal-title w-100" id="book_now_modalLabel">Ticket Tiers</h5>
                <!-- <button type="button" class="close" style="color: white; opacity: 1;" data-dismiss="modal" aria-label="Close"> -->
                    <span data-dismiss="modal" aria-hidden="true"><i class="fas fa-times"></i></span>
                <!-- </button> -->
            </div>
            <form method="post" method="post" action="<?php echo user_base_url() ?>cart/add" id="basic_info_form">
                <div class="modal-body">
                    <div class="row">
                    <input type="hidden" name="gig_id" id="gig_id">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Tier</label>
                                <select name="tier" id="book_now_tier" class="form-control">
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Quantity</label>
                                <input type="text" name="quantity" id="quantity" class="form-control">
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add to Cart</button>
                    <!-- id="add_to_cart"  -->
                </div>
            </form>
        </div>
    </div>
</div>