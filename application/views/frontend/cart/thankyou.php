<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('frontend/layout/meta_tags'); ?>
    <title>Gigniter - Online Ticket Booking Website HTML Template</title>
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
    <!-- <section class="explore-banner-section bg_img" data-background="<?php echo user_asset_url(); ?>images/banner/banner-3.png">
        <div class="container">
            <div class="text-box text-center">
                <h2 class="exlpore-title">Cart</h2>
                <h5 class="explore-subtitle"></h5>
            </div>
        </div>
    </section> -->
    <!-- ==========Banner-Section========== -->

    <!-- ==========Explore-content-Section========== -->
    <form method="post" action="<?php echo user_base_url() ?>cart/checkout" id="basic_info_form">
        <div class="event-facility padding-bottom padding-top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="checkout-widget checkout-contact">
                            <h5 class="title">Thank you </h5>
                            <a href="<?php user_base_url() ?>" type="button" class="btn btn-primary">Back to Home</a>
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