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
    <section class="explore-banner-section bg_img" data-background="<?php echo user_asset_url(); ?>images/banner/banner-3.png">
        <div class="container">
            <div class="text-box text-center">
                <h2 class="exlpore-title"><?php echo $gig->title ?></h2>
                <h5 class="explore-subtitle"><?php echo $gig->address ?></h5>
            </div>
        </div>
    </section>
    <!-- ==========Banner-Section========== -->

    <!-- ==========Explore-content-Section========== -->
    <form method="post" action="<?php echo user_base_url() ?>gigs/checkout" id="basic_info_form">
        <div class="event-facility padding-bottom padding-top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <?php
                        if (!$user) :
                        ?>
                            <div class="checkout-widget d-flex flex-wrap align-items-center justify-cotent-between">
                                <div class="title-area">
                                    <h5 class="title">Already a Gigniter Member?</h5>
                                    <p>Sign in to proceed</p>
                                </div>
                                <a href="<?php echo user_base_url(); ?>login" class="sign-in-area">
                                    <i class="fas fa-user"></i><span>Sign in</span>
                                </a>
                            </div>
                        <?php
                        endif;
                        ?>
                        <div class="checkout-widget checkout-contact">
                            <h5 class="title">Share your Contact Details </h5>
                            <form class="checkout-contact-form">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" name="user_fname" placeholder="First Name" value="<?php echo $user->fname ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" name="user_lname" placeholder="Last Name" value="<?php echo $user->lname ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" placeholder="Enter your Mail" name="user_email" value="<?php echo $mail_link ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" placeholder="Enter your Phone Number" name="phone_no" value="<?php echo $user->phone_no ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="submit" value="Continue" class="custom-button">
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="booking-summery bg-one">
                            <h4 class="title">booking summery</h4>
                            <ul>
                                <li>
                                    <h6 class="subtitle">Venues</h6>
                                    <?php
                                    if ($gig->venues) :
                                        foreach ($gig->venues as $venue) :
                                    ?>
                                            <span class="info"><?php echo $venue ?></span>
                                    <?php
                                        endforeach;
                                    endif;
                                    ?>
                                </li>
                                <li>
                                    <h6 class="subtitle"><span><?php echo $tier->name ?></span><span><?php echo $tier->quantity ?></span></h6>
                                    <div class="info"><span><?php echo date('d M D', strtotime($gig->gig_date)) ?>, <?php echo date('H:i A', strtotime($gig->start_time)) ?></span> <span>Tickets</span></div>
                                </li>
                                <li>
                                    <h6 class="subtitle mb-0"><span>Tickets Price</span><span>$<?php echo $total_price; ?></span></h6>
                                </li>
                            </ul>
                            <ul class="side-shape">
                                <li>
                                    <span class="info"><span>price</span><span>$<?php echo $total_price; ?></span></span>
                                    <span class="info"><span>vat</span><span>$0</span></span>
                                </li>
                            </ul>
                        </div>
                        <div class="proceed-area  text-center">
                            <h6 class="subtitle"><span>Amount Payable</span><span>$<?php echo $total_price; ?></span></h6>
                            <button type="submit" class="custom-button back-button">proceed</button>
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
</body>

</html>