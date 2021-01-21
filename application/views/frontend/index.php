<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('frontend/layout/meta_tags'); ?>
    <title>Gigniter - Online Ticket Booking Website HTML Template</title>
</head>

<body>
    <?php $this->load->view('frontend/layout/preloader'); ?>
    <?php $this->load->view('frontend/layout/header'); ?>
    <!-- Page content -->
    <!-- ==========Banner-Section========== -->
    <section class="banner-section banner-bg2 bg_img" data-background="<?php echo user_asset_url(); ?>images/banner/banner-1.png">

        <div class="container">
            <?php
            if ($gigs) :
            ?>
                <div id="carousel_1" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <?php
                        foreach ($gigs as $gig) :
                        ?>
                            <div class="carousel-item">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                        <p class="custom-badge">Intimate and Live</p>
                                        <h3 class="mt-2">Coke <span class="custom-heading">Studio</span></h3>
                                        <h5 class="mt-2"><?php echo $gig->user_name ?></h5>
                                        <div class="counter text-center mt-5 d-flex">
                                            <div class="spots-left stat">
                                                <h3><span class="spot-number">3</span></h3>
                                                <p><span class="spot-text">Spot left</span></p>
                                            </div>
                                            <span class="divider">|</span>
                                            <div class="days-left">
                                                <h3><span class="days-number">10</span></h3>
                                                <p><span class="days-text">Days left</span></p>
                                            </div>
                                            <div class="book-btn ml-5">
                                                <button class="btn btn-primary btn-booknow">Book Now</button>
                                            </div>
                                        </div>
                                        <div class="d-flex responsive-class">
                                            <span class="mr-2"><img src="<?php echo user_asset_url(); ?>images/icons/calender.png"></span>
                                            <p class="mr-4 margin-date"><?php echo date('d M Y', strtotime($gig->gig_date)) ?></p>
                                            <span class="mr-2"><img src="<?php echo user_asset_url(); ?>images/icons/clock.png"></span>
                                            <p class="margin-time">7.00 pm - 10.00 pm EST</p>
                                        </div>
                                        <div class="location">
                                            <p><span>•</span><i><strong> Apollo Theater New York USA</strong></i></p>
                                        </div>

                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                        <img src="<?php echo user_asset_url(); ?>images/home/slider-01/slide-1.png" class="w-100">
                                    </div>
                                </div>
                            </div>
                        <?php
                        endforeach;
                        ?>
                        <a class="carousel-control-prev" href="#carousel_1" role="button" data-slide="prev"><img src="<?php echo user_asset_url(); ?>images/icons/arrow-left.png"></a>
                        <a class="carousel-control-next" href="#carousel_1" role="button" data-slide="next"><img src="<?php echo user_asset_url(); ?>images/icons/arrow-right.png"></a>
                    </div>
                </div>
                <!-- Slider for mobile  -->
                <div class="row d-flex align-items-center">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="speaker--slider text-center" id="carousel_mobile">
                            <div class="speaker-slider-mobile owl-carousel owl-theme">
                                <?php
                                foreach ($gigs as $gig) :
                                ?>
                                    <div class="speaker-item1 card">
                                        <div class="speaker-thumb card-header">
                                            <img src="<?php echo user_asset_url(); ?>images/home/slider-01/slide-1.png" alt="speaker">
                                            <p class="custom-badge">Intimate and Live</p>
                                        </div>
                                        <div class="speaker-content card-footer">
                                            <h3 class="mt-2">Coke <span class="custom-heading">Studio</span></h3>
                                            <h5 class="mt-2"><?php echo $gig->user_name ?></h5>
                                            <div class="counter text-center d-flex">
                                                <div class="spots-left stat">
                                                    <h3><span class="spot-number">3</span></h3>
                                                    <p><span class="spot-text">Spot left</span></p>
                                                </div>
                                                <span class="divider">|</span>
                                                <div class="days-left">
                                                    <h3><span class="days-number">10</span></h3>
                                                    <p><span class="days-text">Days left</span></p>
                                                </div>
                                            </div>
                                            <div class="book-btn m-auto">
                                                <button class="btn btn-primary btn-booknow">Book Now</button>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                endforeach;
                                ?>
                            </div>
                            <div class="speaker-prev-mobile">
                                <img src="<?php echo user_asset_url(); ?>images/icons/arrow-left.png">
                            </div>
                            <div class="speaker-next-mobile">
                                <img src="<?php echo user_asset_url(); ?>images/icons/arrow-right.png">
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            endif;
            ?>
            <!-- slider for mobile -->

        </div>

    </section>
    <!-- ==========Banner-Section========== -->
    <!-- ==========Carousel-2============== -->
    <?php
    if ($gigs) :
    ?>
        <section class="section-02 banner-bg2 bg_img" data-background="<?php echo user_asset_url(); ?>images/home/home-bg-2.png">
            <div class="my-5 text-center container">
                <div class="row d-flex align-items-center">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="carousel-02-text text-left">
                            <h2>Now showing</h2>
                            <p>Be sure not to miss these events today. <a href="javascript:void(0)" class="float-right more-btn">More<span class="ml-2"><img src="<?php echo user_asset_url(); ?>images/icons/arrow-more.png"></span></a></p>
                        </div>
                        <div class="speaker--slider text-center" id="carousel_2">
                            <div class="speaker-slider2 owl-carousel owl-theme">
                                <?php
                                foreach ($gigs as $gig) :
                                ?>
                                    <div class="speaker-item1 card">
                                        <div class="speaker-thumb card-header">
                                            <img src="<?php echo user_asset_url(); ?>images/home/slider-02/card-img01.png" alt="speaker">
                                        </div>
                                        <div class="speaker-content card-footer">
                                            <h5 class="title">
                                                <h5>Afropunk</h5>
                                                <h6><?php echo $gig->user_name ?></h6>
                                                <p><i>Theater Amsterdam, Netherlands</i></p>
                                                <button class="btn btn-warning btn-watch mb-4">Watch now</button>
                                        </div>
                                    </div>
                                <?php
                                endforeach;
                                ?>
                            </div>
                            <div class="speaker-prev2">
                                <img src="<?php echo user_asset_url(); ?>images/icons/arrow-left.png">
                            </div>
                            <div class="speaker-next2">
                                <img src="<?php echo user_asset_url(); ?>images/icons/arrow-right.png">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="divider-bar text-left mt-4">
                    <img src="<?php echo user_asset_url(); ?>images/icons/divider-bar.png" style="width: 38%;">
                </div>
            </div>
        </section>
    <?php
    endif;
    ?>
    <!-- ==========Carousel-2============== -->

    <!-- ==========Carousel-3============== -->
    <?php
    if ($gigs) :
    ?>
        <section class="section-03">
            <div class="mb-1  text-center container">
                <div class="row d-flex align-items-center">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="carousel-02-text text-left">
                            <h2>Most Popular</h2>
                            <p>Be sure not to miss these events today. <a href="#" class="float-right more-btn">More<span class="ml-2"><img src="<?php echo user_asset_url(); ?>images/icons/arrow-more.png"></span></a></p>
                        </div>
                        <div class="speaker--slider text-center" id="carousel_3">
                            <div class="speaker-slider3 owl-carousel owl-theme">
                                <?php
                                foreach ($gigs as $gig) :
                                ?>
                                    <div class="speaker-item1 card">
                                        <div class="speaker-thumb card-header">
                                            <img src="<?php echo user_asset_url(); ?>images/home/slider-03/card-img01.png">
                                            <span class="badge badge-danger exclusive-badge">exclusive</span>
                                        </div>
                                        <div class="speaker-content card-footer">
                                            <div class="d-flex">
                                                <div class="footer-text">
                                                    <h5>Afropunk</h5>
                                                    <h6><?php echo $gig->user_name ?></h6>
                                                    <p><?php echo date('d M Y', strtotime($gig->gig_date)) ?></p>
                                                    <p><span class="mr-2"><img src="<?php echo user_asset_url(); ?>images/icons/ticket.png"></span>10 tickets left</p>
                                                    <p class="mb-3"><span class="mr-2"><img src="<?php echo user_asset_url(); ?>images/icons/calender.png"></span>3 days left</p>
                                                </div>
                                                <div class="circlebar">
                                                    <div class="pie_progress booked-color-1" role="progressbar" data-goal="75">
                                                        <div class="pie_progress__number">0%</div>
                                                        <div class="pie_progress__label">Booked</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <button class="btn btn-warning btn-watch mb-4">book now</button>
                                            <button class="btn btn-warning btn-view mb-4">view</button>
                                        </div>
                                    </div>
                                <?php
                                endforeach;
                                ?>
                            </div>
                            <div class="speaker-prev3">
                                <img src="<?php echo user_asset_url(); ?>images/icons/arrow-left.png">
                            </div>
                            <div class="speaker-next3">
                                <img src="<?php echo user_asset_url(); ?>images/icons/arrow-right.png">
                            </div>
                        </div>
                        <div class="divider-bar text-left mt-4">
                            <img src="<?php echo user_asset_url(); ?>images/icons/divider-bar.png" style="width: 38%;">
                        </div>
                    </div>
        </section>
    <?php
    endif;
    ?>
    <!-- ==========Carousel-3============== -->

    <!-- ==========Carousel-4============== -->
    <?php
    if ($gigs) :
    ?>
        <section class="section-04">
            <div class="my-5 text-center container">
                <div class="row d-flex align-items-center">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="carousel-02-text text-left">
                            <h2>Closing Soon</h2>
                            <p>Be sure not to miss these events today. <a href="javascript:void(0)" class="float-right more-btn">More<span class="ml-2"><img src="<?php echo user_asset_url(); ?>images/icons/arrow-more.png"></span></a></p>
                        </div>
                        <div class="speaker--slider text-center" id="carousel_4">
                            <div class="speaker-slider4 owl-carousel owl-theme">
                                <?php
                                foreach ($gigs as $gig) :
                                ?>
                                    <div class="speaker-item1 card">
                                        <div class="speaker-thumb card-header">
                                            <img src="<?php echo user_asset_url(); ?>images/home/slider-04/card-img03.png">
                                        </div>
                                        <div class="speaker-content card-footer">
                                            <div class="d-flex">
                                                <div class="footer-text">
                                                    <h5>Afropunk</h5>
                                                    <h6><?php echo $gig->user_name ?></h6>
                                                    <p><?php echo date('d M Y', strtotime($gig->gig_date)) ?></p>
                                                    <p><span class="mr-2"><img src="<?php echo user_asset_url(); ?>images/icons/ticket.png"></span>10 tickets left</p>
                                                    <p class="mb-3"><span class="mr-2"><img src="<?php echo user_asset_url(); ?>images/icons/calender.png"></span>3 days left</p>
                                                </div>
                                                <div class="circlebar">
                                                    <div class="pie_progress booked-color-3" role="progressbar" data-goal="90">
                                                        <div class="pie_progress__number">0%</div>
                                                        <div class="pie_progress__label">Booked</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <button class="btn btn-warning btn-watch mb-4">book now</button>
                                            <button class="btn btn-warning btn-view mb-4">view</button>
                                        </div>
                                    </div>
                                <?php
                                endforeach;
                                ?>
                            </div>
                            <div class="speaker-prev4">
                                <img src="<?php echo user_asset_url(); ?>images/icons/arrow-left.png">
                            </div>
                            <div class="speaker-next4">
                                <img src="<?php echo user_asset_url(); ?>images/icons/arrow-right.png">
                            </div>
                        </div>
                        <div class="divider-bar text-left mt-4">
                            <img src="<?php echo user_asset_url(); ?>images/icons/divider-bar.png" style="width: 38%;">

                        </div>
                    </div>
        </section>
    <?php
    endif;
    ?>
    <!-- ==========Carousel-4============== -->

    <!-- ==========Carousel-5============== -->
    <?php
    if ($gigs) :
    ?>
        <section class="section-05">
            <div class="my-5 text-center container">
                <div class="row d-flex align-items-center">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="carousel-02-text text-left">
                            <h2>Just In</h2>
                            <p>Be sure not to miss these events today. <a href="#" class="float-right more-btn">More<span class="ml-2"><img src="<?php echo user_asset_url(); ?>images/icons/arrow-more.png"></span></a></p>
                        </div>
                        <div class="speaker--slider text-center" id="carousel_5">
                            <div class="speaker-slider5 owl-carousel owl-theme">
                                <?php
                                foreach ($gigs as $gig) :
                                ?>
                                    <div class="speaker-item1 card">
                                        <div class="speaker-thumb card-header">
                                            <img src="<?php echo user_asset_url(); ?>images/home/slider-05/card-img01.png">
                                            <span class="badge badge-danger exclusive-badge">exclusive</span>
                                        </div>
                                        <div class="speaker-content card-footer">
                                            <div class="d-flex">
                                                <div class="footer-text">
                                                    <h5>Afropunk</h5>
                                                    <h6><?php echo $gig->user_name ?></h6>
                                                    <p><?php echo date('d M Y', strtotime($gig->gig_date)) ?></p>
                                                    <p><span class="mr-2"><img src="<?php echo user_asset_url(); ?>images/icons/ticket.png"></span>10 tickets left</p>
                                                    <p class="mb-3"><span class="mr-2"><img src="<?php echo user_asset_url(); ?>images/icons/calender.png"></span>3 days left</p>
                                                </div>
                                                <div class="circlebar">
                                                    <div class="pie_progress booked-color-1" role="progressbar" data-goal="75">
                                                        <div class="pie_progress__number">0%</div>
                                                        <div class="pie_progress__label">Booked</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <button class="btn btn-warning btn-watch mb-4">book now</button>
                                            <button class="btn btn-warning btn-view mb-4">view</button>
                                        </div>
                                    </div>
                                <?php
                                endforeach;
                                ?>
                            </div>
                            <div class="speaker-prev5">
                                <img src="<?php echo user_asset_url(); ?>images/icons/arrow-left.png">
                            </div>
                            <div class="speaker-next5">
                                <img src="<?php echo user_asset_url(); ?>images/icons/arrow-right.png">
                            </div>
                        </div>
                        <div class="divider-bar text-left mt-4">
                            <img src="<?php echo user_asset_url(); ?>images/icons/divider-bar.png" style="width: 38%;">
                        </div>
                    </div>
        </section>
    <?php
    endif;
    ?>
    <!-- ==========Carousel-5============== -->
    <!-- /page content -->

    <?php $this->load->view('frontend/layout/newsletter_footer'); ?>
    <?php $this->load->view('frontend/layout/scripts'); ?>


    <script>
        $(document).ready(function() {
            $('#start_gig_menu').addClass('active');
            $('.carousel-inner').children().first().addClass('active');
        });
    </script>
</body>

</html>