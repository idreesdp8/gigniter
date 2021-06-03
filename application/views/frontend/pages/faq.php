<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('frontend/layout/meta_tags'); ?>
    <title>Gigniter - Online Ticket Booking Website HTML Template</title>
</head>

<body>
    <?php $this->load->view('frontend/layout/preloader'); ?>
    <?php $this->load->view('frontend/layout/header'); ?>

    <!-- ==========Banner-Section========== -->
    <section class="main-page-header speaker-banner bg_img" data-background="<?php echo user_asset_url(); ?>images/banner/banner-3.png">
        <div class="container">
            <div class="speaker-banner-content">
                <h2 class="title">Frequently Asked Questions</h2>
                <!-- <ul class="breadcrumb">
                    <li>
                        <a href="index.html">
                            Home
                        </a>
                    </li>
                    <li>
                        <a href="blog.html">
                            blog
                        </a>
                    </li>
                    <li>
                        blog single
                    </li>
                </ul> -->
            </div>
        </div>
    </section>
    <!-- ==========Banner-Section========== -->

    <!-- ==========Blog-Section========== -->
    <section class="faq-section padding-top">
        <div class="container">
            <div class="section-header-3">
                <span class="cate">HOW CAN WE HELP?</span>
                <!-- <h2 class="title">Frequently Asked Questions</h2> -->
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor  ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida</p>
            </div>
            <div class="faq-area padding-bottom">
                <div class="faq-wrapper">
                    <div class="faq-item active open">
                        <div class="faq-title">
                            <h6 class="title">Can I Upgrade my Tickets after Placing an Order?</h6>
                            <span class="right-icon"></span>
                        </div>
                        <div class="faq-content">
                            <p>Being that Tickto does not own any of the tickets sold on our site, we do not have the ability to exchange or replace tickets with other inventory. </p>
                            <p>If you would like to "upgrade" or change the location of your seats, you can relist your current tickets for sale here and purchase other tickets of your choice. </p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-title">
                            <h6 class="title">Why did the delivery method of my tickets change?</h6>
                            <span class="right-icon"></span>
                        </div>
                        <div class="faq-content">
                            <p>Being that Tickto does not own any of the tickets sold on our site, we do not have the ability to exchange or replace tickets with other inventory. </p>
                            <p>If you would like to "upgrade" or change the location of your seats, you can relist your current tickets for sale here and purchase other tickets of your choice. </p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-title">
                            <h6 class="title">Why is there a different name printed on the tickets
                                and will this give me problems at my event?</h6>
                            <span class="right-icon"></span>
                        </div>
                        <div class="faq-content">
                            <p>Being that Tickto does not own any of the tickets sold on our site, we do not have the ability to exchange or replace tickets with other inventory. </p>
                            <p>If you would like to "upgrade" or change the location of your seats, you can relist your current tickets for sale here and purchase other tickets of your choice. </p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-title">
                            <h6 class="title">My tickets are not consecutive seats, are they still  
                                guaranteed together?</h6>
                            <span class="right-icon"></span>
                        </div>
                        <div class="faq-content">
                            <p>Being that Tickto does not own any of the tickets sold on our site, we do not have the ability to exchange or replace tickets with other inventory. </p>
                            <p>If you would like to "upgrade" or change the location of your seats, you can relist your current tickets for sale here and purchase other tickets of your choice. </p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-title">
                            <h6 class="title">Why is there a different name printed on the tickets
                                and will this give me problems at my event?</h6>
                            <span class="right-icon"></span>
                        </div>
                        <div class="faq-content">
                            <p>Being that Tickto does not own any of the tickets sold on our site, we do not have the ability to exchange or replace tickets with other inventory. </p>
                            <p>If you would like to "upgrade" or change the location of your seats, you can relist your current tickets for sale here and purchase other tickets of your choice. </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ==========Blog-Section========== -->

    <?php $this->load->view('frontend/layout/newsletter_footer'); ?>
    <?php $this->load->view('frontend/layout/scripts'); ?>
</body>

</html>