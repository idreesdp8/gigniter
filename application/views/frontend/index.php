<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('frontend/layout/meta_tags'); ?>
    <title>Gigniter - Online Ticket Booking Service</title>
    <style>
        .banner-section::before {
            z-index: 0;
        }
    </style>
</head>

<body>
    <?php $this->load->view('frontend/layout/preloader'); ?>
    <?php $this->load->view('frontend/layout/header'); ?>
    <!-- Page content -->
    <!-- ==========Banner-Section========== -->
    <section class="banner-section banner-bg2 bg_img" data-background="<?php echo user_asset_url(); ?>images/banner/banner-1.png">

        <div class="container">
            <?php
            if ($featured_gigs) :
            ?>
                <div id="carousel_1" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <?php
                        foreach ($featured_gigs as $gig) :
                        ?>
                            <div class="carousel-item">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-12">

                                        <a href="<?php echo user_base_url(); ?>gigs/detail?gig=<?php echo $gig->id ?>">
                                            <img src="<?php echo $gig->poster ? poster_thumbnail_url() . $gig->poster : user_asset_url() . 'images/home/slider-02/card-img01.png' ?>" class="w-100">
                                        </a>
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-sm-8 col-12">
                                        <p class="custom-badge"><?php echo $gig->genre_name ?></p>
                                        <a href="<?php echo user_base_url(); ?>gigs/detail?gig=<?php echo $gig->id ?>">
                                            <h3 class="mt-2"><?php echo $gig->title ?>
                                        </a>
                                        <!-- <span class="custom-heading">Studio</span> -->
                                        </h3>
                                        <h5 class="mt-2"><?php echo $gig->user_name ?></h5>
                                        <div class="counter text-center mt-5 d-flex">
                                            <div class="spots-left stat">
                                                <?php if ($gig->ticket_left > 0) :
                                                ?>
                                                    <h3><span class="spot-number"><?php echo $gig->ticket_left ?></span></h3>
                                                    <p><span class="spot-text">Spot left</span></p>
                                                <?php
                                                else :
                                                ?>
                                                    <h5><span class="spot-number">Gig is On!</span></h3>
                                                        <!-- <p><span class="spot-text">Gig is On!</span></p> -->
                                                    <?php
                                                endif;
                                                    ?>

                                            </div>
                                            <span class="divider">|</span>
                                            <div class="days-left">
                                                <h3><span class="days-number"><?php echo abs($gig->days_left) ?></span></h3>
                                                <p><span class="days-text">Days left</span></p>
                                            </div>
                                            <div class="book-btn ml-5">
                                                <?php
                                                if ($this->session->userdata('us_id') != $gig->user_id && ($gig->ticket_left != 0 || $gig->is_overshoot)) :
                                                ?>
                                                    <a href="<?php echo user_base_url() . 'cart/book_tier/' . $gig->id ?>"><button type="button" class="btn btn-primary btn-booknow">book now</button></a>

                                                <?php
                                                endif;
                                                ?>
                                            </div>
                                        </div>
                                        <div class="d-flex responsive-class">
                                            <span class="mr-2"><img src="<?php echo user_asset_url(); ?>images/icons/calender.png"></span>
                                            <p class="mr-4 margin-date"><?php echo date('d M Y', strtotime($gig->gig_date)) ?></p>
                                            <span class="mr-2"><img src="<?php echo user_asset_url(); ?>images/icons/clock.png"></span>
                                            <p class="margin-time"><?php echo date('h:i a', strtotime($gig->start_time)) ?> - <?php echo date('h:i a', strtotime($gig->end_time)) ?> EST</p>
                                        </div>
                                        <div class="location">
                                            <p><span>•</span><i><strong> <?php echo strpos($gig->venues, 'Physical') === false ? 'Live Performance' : $gig->address ?></strong></i></p>
                                        </div>

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
                                foreach ($featured_gigs as $gig) :
                                ?>
                                    <div class="speaker-item1 card">
                                        <div class="speaker-thumb card-header">

                                            <a href="<?php echo user_base_url(); ?>gigs/detail?gig=<?php echo $gig->id ?>">
                                                <img src="<?php echo $gig->poster ? poster_thumbnail_url() . $gig->poster : user_asset_url() . 'images/home/slider-02/card-img01.png' ?>" alt="speaker">
                                                <p class="custom-badge"><?php echo $gig->genre ?></p>
                                            </a>
                                        </div>
                                        <div class="speaker-content card-footer">
                                            <a href="<?php echo user_base_url(); ?>gigs/detail?gig=<?php echo $gig->id ?>">
                                                <h3 class="mt-2"><?php echo $gig->title ?>
                                            </a>
                                            <!-- <span class="custom-heading">Studio</span> -->
                                            </h3>
                                            <h5 class="mt-2"><?php echo $gig->user_name ?></h5>
                                            <div class="counter text-center d-flex">
                                                <div class="spots-left stat">
                                                    <?php if ($gig->ticket_left > 0) :
                                                    ?>
                                                        <h3><span class="spot-number"><?php echo $gig->ticket_left ?></span></h3>
                                                        <p><span class="spot-text">Spot left</span></p>
                                                    <?php
                                                    else :
                                                    ?>
                                                        <h5><span class="spot-number">Gig is On!</span></h3>
                                                            <!-- <p><span class="spot-text">Gig is On!</span></p> -->
                                                        <?php
                                                    endif;
                                                        ?>
                                                </div>
                                                <span class="divider">|</span>
                                                <div class="days-left">
                                                    <h3><span class="days-number"><?php echo abs($gig->days_left) ?></span></h3>
                                                    <p><span class="days-text">Days left</span></p>
                                                </div>
                                            </div>
                                            <div class="book-btn m-auto">
                                                <?php
                                                if ($this->session->userdata('us_id') != $gig->user_id && ($gig->ticket_left != 0 || $gig->is_overshoot)) :
                                                ?>

                                                    <a href="<?php echo user_base_url() . 'cart/book_tier/' . $gig->id ?>"><button type="button" class="btn btn-primary btn-booknow">book now</button></a>
                                                <?php
                                                endif;
                                                ?>
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
    if ($now_showing) :
    ?>
        <section class="section-02 banner-bg2 bg_img" data-background="<?php echo user_asset_url(); ?>images/home/home-bg-2.png">
            <div class="my-5 text-center container">
                <div class="row d-flex align-items-center">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="carousel-02-text text-left">
                            <h2>Now Showing</h2>
                            <p>Be sure not to miss these events today.
                                <a href="<?php echo user_base_url() . 'gigs/explore?live=1' ?>" id="now_showing" class="float-right more-btn <?php echo empty($now_showing) ? 'd-none' : '' ?>">More<span class="ml-2"><img src="<?php echo user_asset_url(); ?>images/icons/arrow-more.png"></span></a>
                            </p>
                        </div>
                        <div class="speaker--slider text-center" id="carousel_2">
                            <div class="speaker-slider2 owl-carousel owl-theme">
                                <?php
                                foreach ($now_showing as $gig) :
                                ?>
                                    <div class="speaker-item1 card">
                                        <div class="speaker-thumb card-header">
                                            <img src="<?php echo $gig->poster ? poster_thumbnail_url() . $gig->poster : user_asset_url() . 'images/home/slider-02/card-img01.png' ?>" style="max-width: 360px; max-height: 354px;" alt="speaker">
                                            <?php //if ($gig->is_exclusive) :
                                            ?>
                                            <span class="badge badge-danger exclusive-badge">Live</span>
                                            <?php //endif;
                                            ?>
                                        </div>
                                        <div class="speaker-content card-footer">
                                            <h5 class="title">
                                                <h5><?php echo $gig->title ?></h5>
                                                <h6><?php echo $gig->user_name ?></h6>
                                                <p><i><?php echo $gig->address ?></i></p>
                                                <a href="<?php echo user_base_url() . 'gigs/detail?gig=' . $gig->id ?>" class="btn btn-warning btn-watch mb-4">Watch now</a>

                                        </div>
                                    </div>
                                <?php
                                endforeach;
                                ?>
                            </div>
                            <div class="speaker-prev2 speaker-prev">
                                <img src="<?php echo user_asset_url(); ?>images/icons/arrow-left.png">
                            </div>
                            <div class="speaker-next2 speaker-next">
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
    <section class="section-03">
        <div class="mb-1  text-center container">
            <div class="row d-flex align-items-center">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="carousel-02-text text-left">
                        <h2>Most Popular</h2>
                        <p>Be sure not to miss these events today.
                            <a href="<?php echo user_base_url() . 'gigs/explore?sort_by=most_popular' ?>" id="popular" class="float-right more-btn <?php echo empty($popular) ? 'd-none' : '' ?>">More<span class="ml-2"><img src="<?php echo user_asset_url(); ?>images/icons/arrow-more.png"></span></a>
                        </p>
                    </div>
                    <?php
                    if ($popular) :
                    ?>
                        <div class="speaker--slider text-center" id="carousel_3">
                            <div class="speaker-slider3 owl-carousel owl-theme">
                                <?php
                                foreach ($popular as $gig) :
                                ?>
                                    <div class="speaker-item1 card">
                                        <div class="speaker-thumb card-header">
                                            <a href="<?php echo user_base_url(); ?>gigs/detail?gig=<?php echo $gig->id ?>">
                                                <img src="<?php echo $gig->poster ? poster_thumbnail_url() . $gig->poster : user_asset_url() . 'images/home/slider-02/card-img01.png' ?>" style="max-width: 360px; max-height: 354px;">
                                                <?php if ($gig->is_exclusive) : ?>
                                                    <span class="badge badge-danger exclusive-badge">exclusive</span>
                                                <?php endif; ?>
                                            </a>
                                        </div>
                                        <div class="speaker-content card-footer">
                                            <h5 class="limit-single-line"><?php echo $gig->title ?></h5>
                                            <div class="d-flex">
                                                <div class="footer-text">

                                                    <h6><?php echo $gig->user_name ?></h6>
                                                    <p><?php echo date('d M Y', strtotime($gig->gig_date)) ?></p>
                                                    <p><span class="mr-2"><img src="<?php echo user_asset_url(); ?>images/icons/ticket.png"></span><?php echo $gig->ticket_left > 0 ? $gig->ticket_left . ' tickets left' : 'Gig is On!' ?></p>
                                                    <p class="mb-3"><span class="mr-2"><img src="<?php echo user_asset_url(); ?>images/icons/calender.png"></span><?php echo abs($gig->days_left) > 0 ? abs($gig->days_left) . ' days left' : 'Today' ?></p>
                                                </div>
                                                <div class="circlebar">
                                                    <div class="pie_progress <?php echo $gig->booked < 60 ? 'booked-color-2' : 'booked-color-1' ?>" role="progressbar" data-goal="<?php echo $gig->booked ?>">
                                                        <div class="pie_progress__number">0%</div>
                                                        <div class="pie_progress__label">Booked</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex">
                                                <?php
                                                if ($this->session->userdata('us_id') != $gig->user_id && ($gig->ticket_left != 0 || $gig->is_overshoot)) :
                                                ?>
                                                    <a style="margin-right:10px;width:100%;" href="<?php echo user_base_url() . 'cart/book_tier/' . $gig->id; ?>"><button type="button" class="btn btn-warning btn-watch mb-4">book now</button></a>
                                                <?php
                                                endif;
                                                ?>
                                                <a style="width:100%;" href="<?php echo user_base_url() . 'gigs/detail?gig=' . $gig->id ?>"><button class="btn btn-warning btn-view mb-4">view</button></a>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                endforeach;
                                ?>
                            </div>
                            <div class="speaker-prev3 speaker-prev">
                                <img src="<?php echo user_asset_url(); ?>images/icons/arrow-left.png">
                            </div>
                            <div class="speaker-next3 speaker-next">
                                <img src="<?php echo user_asset_url(); ?>images/icons/arrow-right.png">
                            </div>
                        </div>
                    <?php
                    elseif ($FE_gigs) :
                    ?>
                        <div class="speaker--slider text-center" id="carousel_3">
                            <div class="speaker-slider3 owl-carousel owl-theme">
                                <?php
                                foreach ($FE_gigs as $gig) :
                                ?>
                                    <div class="speaker-item1 card">
                                        <div class="speaker-thumb card-header">
                                            <a href="<?php echo user_base_url(); ?>gigs/detail?gig=<?php echo $gig->id ?>">
                                                <img src="<?php echo $gig->poster ? poster_thumbnail_url() . $gig->poster : user_asset_url() . 'images/home/slider-02/card-img01.png' ?>" style="max-width: 360px; max-height: 354px;">
                                                <?php if ($gig->is_exclusive) : ?>
                                                    <span class="badge badge-danger exclusive-badge">exclusive</span>
                                                <?php endif; ?>
                                            </a>
                                        </div>
                                        <div class="speaker-content card-footer">
                                            <h5 class="limit-single-line"><?php echo $gig->title ?></h5>
                                            <div class="d-flex">
                                                <div class="footer-text">

                                                    <h6><?php echo $gig->user_name ?></h6>
                                                    <p><?php echo date('d M Y', strtotime($gig->gig_date)) ?></p>
                                                    <p><span class="mr-2"><img src="<?php echo user_asset_url(); ?>images/icons/ticket.png"></span><?php echo $gig->ticket_left > 0 ? $gig->ticket_left . ' tickets left' : 'Gig is On!' ?></p>
                                                    <p class="mb-3"><span class="mr-2"><img src="<?php echo user_asset_url(); ?>images/icons/calender.png"></span><?php echo abs($gig->days_left) > 0 ? abs($gig->days_left) . ' days left' : 'Today' ?></p>
                                                </div>
                                                <div class="circlebar">
                                                    <div class="pie_progress <?php echo $gig->booked < 60 ? 'booked-color-2' : 'booked-color-1' ?>" role="progressbar" data-goal="<?php echo $gig->booked ?>">
                                                        <div class="pie_progress__number">0%</div>
                                                        <div class="pie_progress__label">Booked</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                            if ($this->session->userdata('us_id') != $gig->user_id && ($gig->ticket_left != 0 || $gig->is_overshoot)) :
                                            ?>
                                                <a style="margin-right:10px;width:100%;" href="<?php echo user_base_url() . 'cart/book_tier/' . $gig->id; ?>"><button type="button" class="btn btn-warning btn-watch mb-4">book now</button></a>
                                            <?php
                                            endif;
                                            ?>
                                            <a style="width:100%;" href="<?php echo user_base_url() . 'gigs/detail?gig=' . $gig->id ?>"><button class="btn btn-warning btn-view mb-4">view</button></a>
                                        </div>
                                    </div>
                                <?php
                                endforeach;
                                ?>
                            </div>
                            <div class="speaker-prev3 speaker-prev">
                                <img src="<?php echo user_asset_url(); ?>images/icons/arrow-left.png">
                            </div>
                            <div class="speaker-next3 speaker-next">
                                <img src="<?php echo user_asset_url(); ?>images/icons/arrow-right.png">
                            </div>
                        </div>
                    <?php
                    else :
                    ?>
                        <h6>
                            No Record Found
                        </h6>
                    <?php
                    endif;
                    ?>
                    <div class="divider-bar text-left mt-4">
                        <img src="<?php echo user_asset_url(); ?>images/icons/divider-bar.png" style="width: 38%;">
                    </div>
                </div>
    </section>
    <!-- ==========Carousel-3============== -->

    <!-- ==========Carousel-4============== -->
    <section class="section-04">
        <div class="my-5 text-center container">
            <div class="row d-flex align-items-center">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="carousel-02-text text-left">
                        <h2>Closing Soon</h2>
                        <p>Be sure not to miss these events today.
                            <a href="<?php echo user_base_url() . 'gigs/explore?sort_by=closing_soon' ?>" id="closing_soon" class="float-right more-btn <?php echo empty($closing_soon) ? 'd-none' : '' ?>">More<span class="ml-2"><img src="<?php echo user_asset_url(); ?>images/icons/arrow-more.png"></span></a>
                        </p>
                    </div>
                    <?php
                    if ($closing_soon) :
                    ?>
                        <div class="speaker--slider text-center" id="carousel_4">
                            <div class="speaker-slider4 owl-carousel owl-theme">
                                <?php
                                foreach ($closing_soon as $gig) :
                                ?>
                                    <div class="speaker-item1 card">
                                        <div class="speaker-thumb card-header">
                                            <a href="<?php echo user_base_url(); ?>gigs/detail?gig=<?php echo $gig->id ?>">
                                                <img src="<?php echo $gig->poster ? poster_thumbnail_url() . $gig->poster : user_asset_url() . 'images/home/slider-02/card-img01.png' ?>" style="max-width: 360px; max-height: 354px;">
                                                <?php if ($gig->is_exclusive) : ?>
                                                    <span class="badge badge-danger exclusive-badge">exclusive</span>
                                                <?php endif; ?>
                                            </a>
                                        </div>
                                        <div class="speaker-content card-footer">
                                            <h5 class="limit-single-line"><?php echo $gig->title ?></h5>
                                            <div class="d-flex">
                                                <div class="footer-text">

                                                    <h6><?php echo $gig->user_name ?></h6>
                                                    <p><?php echo date('d M Y', strtotime($gig->gig_date)) ?></p>
                                                    <p><span class="mr-2"><img src="<?php echo user_asset_url(); ?>images/icons/ticket.png"></span><?php echo $gig->ticket_left > 0 ? $gig->ticket_left . ' tickets left' : 'Gig is On!' ?></p>
                                                    <p class="mb-3"><span class="mr-2"><img src="<?php echo user_asset_url(); ?>images/icons/calender.png"></span><?php echo abs($gig->days_left) > 0 ? abs($gig->days_left) . ' days left' : 'Today' ?></p>
                                                </div>
                                                <div class="circlebar">
                                                    <div class="pie_progress <?php echo $gig->booked < 60 ? 'booked-color-2' : 'booked-color-1' ?>" role="progressbar" data-goal="<?php echo $gig->booked ?>">
                                                        <div class="pie_progress__number">0%</div>
                                                        <div class="pie_progress__label">Booked</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex">
                                                <?php
                                                if ($this->session->userdata('us_id') != $gig->user_id && ($gig->ticket_left != 0 || $gig->is_overshoot)) :
                                                ?>
                                                    <a style="margin-right:10px;width:100%;" href="<?php echo user_base_url() . 'cart/book_tier/' . $gig->id; ?>"><button type="button" class="btn btn-warning btn-watch mb-4">book now</button></a>
                                                <?php
                                                endif;
                                                ?>
                                                <a style="width:100%;" href="<?php echo user_base_url() . 'gigs/detail?gig=' . $gig->id ?>"><button class="btn btn-warning btn-view mb-4">view</button></a>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                endforeach;
                                ?>
                            </div>
                            <div class="speaker-prev4 speaker-prev">
                                <img src="<?php echo user_asset_url(); ?>images/icons/arrow-left.png">
                            </div>
                            <div class="speaker-next4 speaker-next">
                                <img src="<?php echo user_asset_url(); ?>images/icons/arrow-right.png">
                            </div>
                        </div>
                    <?php
                    elseif ($FE_gigs) :
                    ?>
                        <div class="speaker--slider text-center" id="carousel_4">
                            <div class="speaker-slider4 owl-carousel owl-theme">
                                <?php
                                foreach ($FE_gigs as $gig) :
                                ?>
                                    <div class="speaker-item1 card">
                                        <div class="speaker-thumb card-header">
                                            <a href="<?php echo user_base_url(); ?>gigs/detail?gig=<?php echo $gig->id ?>">
                                                <img src="<?php echo $gig->poster ? poster_thumbnail_url() . $gig->poster : user_asset_url() . 'images/home/slider-02/card-img01.png' ?>" style="max-width: 360px; max-height: 354px;">
                                                <?php if ($gig->is_exclusive) : ?>
                                                    <span class="badge badge-danger exclusive-badge">exclusive</span>
                                                <?php endif; ?>
                                            </a>
                                        </div>
                                        <div class="speaker-content card-footer">
                                            <h5 class="limit-single-line"><?php echo $gig->title ?></h5>
                                            <div class="d-flex">
                                                <div class="footer-text">

                                                    <h6><?php echo $gig->user_name ?></h6>
                                                    <p><?php echo date('d M Y', strtotime($gig->gig_date)) ?></p>
                                                    <p><span class="mr-2"><img src="<?php echo user_asset_url(); ?>images/icons/ticket.png"></span><?php echo $gig->ticket_left > 0 ? $gig->ticket_left . ' tickets left' : 'Gig is On!' ?></p>
                                                    <p class="mb-3"><span class="mr-2"><img src="<?php echo user_asset_url(); ?>images/icons/calender.png"></span><?php echo abs($gig->days_left) > 0 ? abs($gig->days_left) . ' days left' : 'Today' ?></p>
                                                </div>
                                                <div class="circlebar">
                                                    <div class="pie_progress <?php echo $gig->booked < 60 ? 'booked-color-2' : 'booked-color-1' ?>" role="progressbar" data-goal="<?php echo $gig->booked ?>">
                                                        <div class="pie_progress__number">0%</div>
                                                        <div class="pie_progress__label">Booked</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                            if ($this->session->userdata('us_id') != $gig->user_id && ($gig->ticket_left != 0 || $gig->is_overshoot)) :
                                            ?>
                                                <a style="margin-right:10px;width:100%;" href="<?php echo user_base_url() . 'cart/book_tier/' . $gig->id; ?>"><button type="button" class="btn btn-warning btn-watch mb-4">book now</button></a>
                                            <?php
                                            endif;
                                            ?>
                                            <a style="width:100%;" href="<?php echo user_base_url() . 'gigs/detail?gig=' . $gig->id ?>"><button class="btn btn-warning btn-view mb-4">view</button></a>
                                        </div>
                                    </div>
                                <?php
                                endforeach;
                                ?>
                            </div>
                            <div class="speaker-prev4 speaker-prev">
                                <img src="<?php echo user_asset_url(); ?>images/icons/arrow-left.png">
                            </div>
                            <div class="speaker-next4 speaker-next">
                                <img src="<?php echo user_asset_url(); ?>images/icons/arrow-right.png">
                            </div>
                        </div>
                    <?php
                    else :
                    ?>
                        <h6>
                            No Record Found
                        </h6>
                    <?php
                    endif;
                    ?>
                    <div class="divider-bar text-left mt-4">
                        <img src="<?php echo user_asset_url(); ?>images/icons/divider-bar.png" style="width: 38%;">

                    </div>
                </div>
    </section>
    <!-- ==========Carousel-4============== -->

    <!-- ==========Carousel-5============== -->
    <section class="section-05">
        <div class="my-5 text-center container">
            <div class="row d-flex align-items-center">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="carousel-02-text text-left">
                        <h2>Just In</h2>
                        <p>Be sure not to miss these events today.
                            <a href="<?php echo user_base_url() . 'gigs/explore?sort_by=just_in' ?>" id="just_in" class="float-right more-btn <?php echo empty($just_in) ? 'd-none' : '' ?>">More<span class="ml-2"><img src="<?php echo user_asset_url(); ?>images/icons/arrow-more.png"></span></a>
                        </p>
                    </div>
                    <?php
                    if ($just_in) :
                    ?>
                        <div class="speaker--slider text-center" id="carousel_5">
                            <div class="speaker-slider5 owl-carousel owl-theme">
                                <?php
                                foreach ($just_in as $gig) :
                                ?>
                                    <div class="speaker-item1 card">
                                        <div class="speaker-thumb card-header">
                                            <a href="<?php echo user_base_url(); ?>gigs/detail?gig=<?php echo $gig->id ?>">
                                                <img src="<?php echo $gig->poster ? poster_thumbnail_url() . $gig->poster : user_asset_url() . 'images/home/slider-02/card-img01.png' ?>" style="max-width: 360px; max-height: 354px;">
                                                <?php if ($gig->is_exclusive) : ?>
                                                    <span class="badge badge-danger exclusive-badge">exclusive</span>
                                                <?php endif; ?>
                                            </a>
                                        </div>
                                        <div class="speaker-content card-footer">
                                            <h5 class="limit-single-line"><?php echo $gig->title ?></h5>
                                            <div class="d-flex">
                                                <div class="footer-text">

                                                    <h6><?php echo $gig->user_name ?></h6>
                                                    <p><?php echo date('d M Y', strtotime($gig->gig_date)) ?></p>
                                                    <p><span class="mr-2"><img src="<?php echo user_asset_url(); ?>images/icons/ticket.png"></span><?php echo $gig->ticket_left > 0 ? $gig->ticket_left . ' tickets left' : 'Gig is On!' ?></p>
                                                    <p class="mb-3"><span class="mr-2"><img src="<?php echo user_asset_url(); ?>images/icons/calender.png"></span><?php echo abs($gig->days_left) > 0 ? abs($gig->days_left) . ' days left' : 'Today' ?></p>
                                                </div>
                                                <div class="circlebar">
                                                    <div class="pie_progress <?php echo $gig->booked < 60 ? 'booked-color-2' : 'booked-color-1' ?>" role="progressbar" data-goal="<?php echo $gig->booked ?>">
                                                        <div class="pie_progress__number">0%</div>
                                                        <div class="pie_progress__label">Booked</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex">
                                                <?php
                                                if ($this->session->userdata('us_id') != $gig->user_id && ($gig->ticket_left != 0 || $gig->is_overshoot)) :
                                                ?>
                                                    <a style="margin-right:10px;width:100%;" href="<?php echo user_base_url() . 'cart/book_tier/' . $gig->id; ?>"><button type="button" class="btn btn-warning btn-watch mb-4">book now</button></a>
                                                <?php
                                                endif;
                                                ?>
                                                <a style="width:100%;" href="<?php echo user_base_url() . 'gigs/detail?gig=' . $gig->id ?>"><button class="btn btn-warning btn-view mb-4">view</button></a>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                endforeach;
                                ?>
                            </div>
                            <div class="speaker-prev5 speaker-prev">
                                <img src="<?php echo user_asset_url(); ?>images/icons/arrow-left.png">
                            </div>
                            <div class="speaker-next5 speaker-next">
                                <img src="<?php echo user_asset_url(); ?>images/icons/arrow-right.png">
                            </div>
                        </div>
                    <?php
                    elseif ($FE_gigs) :
                    ?>
                        <div class="speaker--slider text-center" id="carousel_5">
                            <div class="speaker-slider5 owl-carousel owl-theme">
                                <?php
                                foreach ($FE_gigs as $gig) :
                                ?>
                                    <div class="speaker-item1 card">
                                        <div class="speaker-thumb card-header">
                                            <a href="<?php echo user_base_url(); ?>gigs/detail?gig=<?php echo $gig->id ?>">
                                                <img src="<?php echo $gig->poster ? poster_thumbnail_url() . $gig->poster : user_asset_url() . 'images/home/slider-02/card-img01.png' ?>" style="max-width: 360px; max-height: 354px;">
                                                <?php if ($gig->is_exclusive) : ?>
                                                    <span class="badge badge-danger exclusive-badge">exclusive</span>
                                                <?php endif; ?>
                                            </a>
                                        </div>
                                        <div class="speaker-content card-footer">
                                            <h5 class="limit-single-line"><?php echo $gig->title ?></h5>
                                            <div class="d-flex">
                                                <div class="footer-text">

                                                    <h6><?php echo $gig->user_name ?></h6>
                                                    <p><?php echo date('d M Y', strtotime($gig->gig_date)) ?></p>
                                                    <p><span class="mr-2"><img src="<?php echo user_asset_url(); ?>images/icons/ticket.png"></span><?php echo $gig->ticket_left > 0 ? $gig->ticket_left . ' tickets left' : 'Gig is On!' ?></p>
                                                    <p class="mb-3"><span class="mr-2"><img src="<?php echo user_asset_url(); ?>images/icons/calender.png"></span><?php echo abs($gig->days_left) > 0 ? abs($gig->days_left) . ' days left' : 'Today' ?></p>
                                                </div>
                                                <div class="circlebar">
                                                    <div class="pie_progress <?php echo $gig->booked < 60 ? 'booked-color-2' : 'booked-color-1' ?>" role="progressbar" data-goal="<?php echo $gig->booked ?>">
                                                        <div class="pie_progress__number">0%</div>
                                                        <div class="pie_progress__label">Booked</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                            if ($this->session->userdata('us_id') != $gig->user_id && ($gig->ticket_left != 0 || $gig->is_overshoot)) :
                                            ?>
                                                <a style="margin-right:10px;width:100%;" href="<?php echo user_base_url() . 'cart/book_tier/' . $gig->id; ?>"><button type="button" class="btn btn-warning btn-watch mb-4">book now</button></a>
                                            <?php
                                            endif;
                                            ?>
                                            <a style="width:100%;" href="<?php echo user_base_url() . 'gigs/detail?gig=' . $gig->id ?>"><button class="btn btn-warning btn-view mb-4">view</button></a>
                                        </div>
                                    </div>
                                <?php
                                endforeach;
                                ?>
                            </div>
                            <div class="speaker-prev5 speaker-prev">
                                <img src="<?php echo user_asset_url(); ?>images/icons/arrow-left.png">
                            </div>
                            <div class="speaker-next5 speaker-next">
                                <img src="<?php echo user_asset_url(); ?>images/icons/arrow-right.png">
                            </div>
                        </div>
                    <?php
                    else :
                    ?>
                        <h6>
                            No Record Found
                        </h6>
                    <?php
                    endif;
                    ?>
                    <div class="divider-bar text-left mt-4">
                        <img src="<?php echo user_asset_url(); ?>images/icons/divider-bar.png" style="width: 38%;">
                    </div>
                </div>
    </section>
    <!-- ==========Carousel-5============== -->
    <!-- /page content -->

    <?php //$this->load->view('frontend/gigs/book_now');
    ?>
    <?php $this->load->view('frontend/layout/newsletter_footer'); ?>
    <?php $this->load->view('frontend/layout/scripts'); ?>
    <!-- <script src="<?php echo user_asset_url(); ?>js/add-to-cart.js"></script> -->
    <script>
        // function explore_more(param) {
        //     $.ajax({
        //         url: base_url+'gigs/explore',
        //         data: param,
        //         method: 'post',

        //     })
        // }
        $(document).ready(function() {
            // $('#now_showing').click(function(){
            //     event.preventDefault();
            //     var param = {
            //         live: 1
            //     }
            //     explore_more(param)
            // })
            // $('#popular').click(function(){
            //     event.preventDefault();
            //     var param = {
            //         popular: 1
            //     }
            //     explore_more(param)
            // })
            // $('#closing_soon').click(function(){
            //     event.preventDefault();
            //     var param = {
            //         closing_soon: 1
            //     }
            //     explore_more(param)
            // })
            // $('#just_in').click(function(){
            //     event.preventDefault();
            //     var param = {
            //         just_in: 1
            //     }
            //     explore_more(param)
            // })

            $('.carousel-inner').children().first().addClass('active');

            $('.owl-carousel').each(function() {
                if ($(this).find('.owl-item').length < 4) {
                    $(this).parent().find('.speaker-prev').addClass('d-none');
                    $(this).parent().find('.speaker-next').addClass('d-none');
                }
            });
            $('.speaker-prev, .speaker-next').on('mouseover', function() {
                console.log($(this).parent().children('.owl-carousel'));
                $(this).parent().children('.owl-carousel').trigger('stop.owl.autoplay');
            });
            $('.speaker-prev, .speaker-next').on('mouseleave', function() {
                console.log($(this).parent().children('.owl-carousel'));
                $(this).parent().children('.owl-carousel').trigger('play.owl.autoplay');
            });
        });
        $('.owl-carousel').owlCarousel({
            rewind: true,
            autoplay: true,
            dots: false,
            autoplayTimeout: 2000,
            autoplayHoverPause: true,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 1,
                    loop: ($(this).find('.owl-item')).length > 0
                },
                600: {
                    items: 3,
                    loop: ($(this).find('.owl-item')).length > 0,
                    margin: 30,
                },
                1000: {
                    items: 3,
                    loop: ($(this).find('.owl-item')).length > 0,
                    margin: 30,
                }
            }
        });
        // $('.owl-carousel').owlCarousel({
        //     loop: ($(this).find('.owl-item')).length > 2,
        //     rewind: true,
        //     autoplay: true,
        //     dots: false,
        //     autoplayTimeout: 2000,
        //     margin: 30,
        //     autoplayHoverPause: true,
        //     responsiveClass:true,
        //     responsive:{
        //         0:{
        //             items:1,
        //             nav:true
        //         },
        //         600:{
        //             items:3,
        //             nav:ture
        //         },
        //         1000:{
        //             items:5,
        //             nav:true,
        //             loop:false
        //         }
        //     }
        // });
    </script>
</body>

</html>