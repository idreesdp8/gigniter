<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('frontend/layout/meta_tags'); ?>
    <title>Gigniter - Online Ticket Booking Service</title>
    <style>
        .exlpore-title,
        .explore-subtitle {
            text-transform: uppercase;
        }

        input[type="text"] {
            color: black;
            padding: 5px !important;
        }
    </style>
</head>

<body>
    <?php $this->load->view('frontend/layout/preloader'); ?>
    <?php $this->load->view('frontend/layout/header'); ?>
    <!-- Page content -->
    <!-- ==========Banner-Section========== -->
    <section class="explore-banner-section bg_img" data-background="<?php echo user_asset_url(); ?>images/banner/banner-3.png">
        <div class="container">
            <div class="text-box text-center">
                <h2 class="exlpore-title">Cart</h2>
                <!-- <h5 class="explore-subtitle"></h5> -->
            </div>
        </div>
    </section>
    <!-- ==========Banner-Section========== -->

    <!-- ==========Explore-content-Section========== -->
    <form method="post" action="<?php echo user_base_url() ?>cart/checkout" id="basic_info_form">
        <div class="event-facility padding-bottom padding-top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="checkout-widget checkout-contact">
                            <h5 class="title">Cart Items </h5>
                            <?php
                            if ($cart_items) :
                            ?>
                                <div class="row">
                                <div class="col-lg-4">Ticket Name</div>
                                <div class="col-lg-4">Ticket Price</div>
                                <div class="col-lg-4">Quantity</div>
                                    <?php
                                    foreach ($cart_items as $item) :
                                    ?>
                                        <div class="col-lg-4">
                                        <?php echo $item->ticket_tier_name ?>
                                        </div>
                                        <div class="col-lg-4">
                                        <?php echo $item->ticket_tier_price ?>
                                        </div>
                                        <div class="col-lg-4">
                                        <?php echo $item->quantity ?>
                                        </div>
                                    <?php
                                    endforeach;
                                    ?>
                                    <div class="col-lg-6">Total</div>
                                    <div class="col-lg-6">
                                        $<?php echo $total_price ?></div>
                                </div>
                                <div class="form-group">
                                    <input type="submit" value="Proceed to Checkout" class="custom-button">
                                </div>
                            <?php
                            else :
                            ?>
                                <div class="row">
                                    <div class="col-lg-12">
                                        Your cart is empty!
                                    </div>
                                </div>
                            <?php
                            endif;
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- ==========Explore-content-Section========== -->
    <!-- /page content -->

    <?php $this->load->view('frontend/layout/footer'); ?>
    <?php $this->load->view('frontend/layout/scripts'); ?>
    <script>
        $('#cart_menu').addClass('active');
    </script>
</body>

</html>