<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('frontend/layout/meta_tags'); ?>
    <meta http-equiv="refresh" content="4;url=<?php echo isset($gig_id) ? user_base_url().'gigs/detail?gig='.$gig_id : user_base_url() ?>" />
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
    <section class="speaker-banner bg_img" data-background="<?php echo user_asset_url(); ?>images/banner/banner-2.png">
        <div class="container">
            <div class="speaker-banner-content">
                <h2 class="title">Thank You!</h2>
            </div>
        </div>
    </section>
    <!-- ==========Banner-Section========== -->

    <!-- ==========Speaker-Single========== -->
    <section class="apps-seciton padding-top pt-lg-0 mb-5">
        <div class="container">
            <div class="apps-wrapper bg-six padding-top padding-bottom">
                <div class="bg_img apps-bg" data-background="<?php echo user_asset_url() ?>images/apps/apps01.png"></div>
                <div class="row">
                    <div class="col-lg-7 offset-lg-5">
                        <div class="content">
                            <p>
                                Thank you for submitting your details. We appreciate your time. One of our representative will be in touch with you shortly.
                            </p>
                            <!-- <a href="<?php echo user_base_url(); ?>gigs/detail?gig=<?php echo $gig_id ?? '' ?>" class="btn btn-theme-primary" type="button">Back to Detail</a> -->
                        </div>
                    </div>
                </div>
            </div>
    </section>

    <!-- ==========Explore-content-Section========== -->
    <!-- /page content -->

    <?php $this->load->view('frontend/layout/footer'); ?>
    <?php $this->load->view('frontend/layout/scripts'); ?>
    <script>
        $('#cart_menu').addClass('active');
    </script>
</body>

</html>