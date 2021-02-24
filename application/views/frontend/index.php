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
            if ($featured_gigs) :
            ?>
                <div id="carousel_1" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <?php
                        foreach ($featured_gigs as $gig) :
                        ?>
                            <div class="carousel-item">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                        <p class="custom-badge"><?php echo $gig->genre_name ?></p>
                                        <h3 class="mt-2"><?php echo $gig->title ?>
                                            <!-- <span class="custom-heading">Studio</span> -->
                                        </h3>
                                        <h5 class="mt-2"><?php echo $gig->user_name ?></h5>
                                        <div class="counter text-center mt-5 d-flex">
                                            <div class="spots-left stat">
                                                <h3><span class="spot-number"><?php echo $gig->ticket_left ?></span></h3>
                                                <p><span class="spot-text">Spot left</span></p>
                                            </div>
                                            <span class="divider">|</span>
                                            <div class="days-left">
                                                <h3><span class="days-number"><?php echo abs($gig->days_left) ?></span></h3>
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
                                            <p class="margin-time"><?php echo date('h:i a', strtotime($gig->start_time)) ?> - <?php echo date('h:i a', strtotime($gig->end_time)) ?> EST</p>
                                        </div>
                                        <div class="location">
                                            <p><span>•</span><i><strong> <?php echo $gig->address ?></strong></i></p>
                                        </div>

                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                        <img src="<?php echo user_asset_url(); ?>images/home/slider-01/slide-1.png"  class="w-100">
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
                                            <img src="<?php echo user_asset_url(); ?>images/home/slider-01/slide-1.png" alt="speaker">
                                            <p class="custom-badge"><?php echo $gig->genre ?></p>
                                        </div>
                                        <div class="speaker-content card-footer">
                                            <h3 class="mt-2"><?php echo $gig->title ?>
                                                <!-- <span class="custom-heading">Studio</span> -->
                                            </h3>
                                            <h5 class="mt-2"><?php echo $gig->user_name ?></h5>
                                            <div class="counter text-center d-flex">
                                                <div class="spots-left stat">
                                                    <h3><span class="spot-number"><?php echo $gig->ticket_left ?></span></h3>
                                                    <p><span class="spot-text">Spot left</span></p>
                                                </div>
                                                <span class="divider">|</span>
                                                <div class="days-left">
                                                    <h3><span class="days-number"><?php echo abs($gig->days_left) ?></span></h3>
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
    <section class="section-02 banner-bg2 bg_img" data-background="<?php echo user_asset_url(); ?>images/home/home-bg-2.png">
        <div class="my-5 text-center container">
            <div class="row d-flex align-items-center">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="carousel-02-text text-left">
                        <h2>Now Showing</h2>
                        <p>Be sure not to miss these events today.
                            <a href="javascript:void(0)" class="float-right more-btn <?php echo empty($now_showing) ? 'd-none' : '' ?>">More<span class="ml-2"><img src="<?php echo user_asset_url(); ?>images/icons/arrow-more.png"></span></a>
                        </p>
                    </div>
                    <?php
                    if ($now_showing) :
                    ?>
                        <div class="speaker--slider text-center" id="carousel_2">
                            <div class="speaker-slider2 owl-carousel owl-theme">
                                <?php
                                foreach ($now_showing as $gig) :
                                ?>
                                    <div class="speaker-item1 card">
                                        <div class="speaker-thumb card-header">
                                            <img src="<?php echo $gig->poster ? poster_thumbnail_url().$gig->poster : user_asset_url().'images/home/slider-02/card-img01.png' ?>" style="max-width: 360px; max-height: 354px;" alt="speaker">
                                            <?php if ($gig->is_exclusive) : ?>
                                                <span class="badge badge-danger exclusive-badge">exclusive</span>
                                            <?php endif; ?>
                                        </div>
                                        <div class="speaker-content card-footer">
                                            <h5 class="title">
                                                <h5><?php echo $gig->title ?></h5>
                                                <h6><?php echo $gig->user_name ?></h6>
                                                <p><i><?php echo $gig->address ?></i></p>
                                                <button class="btn btn-warning btn-watch mb-4">Watch now</button>
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
                    <?php
                    else :
                    ?>
                        <h6>
                            No Record Found
                        </h6>
                    <?php
                    endif;
                    ?>
                </div>
            </div>
            <div class="divider-bar text-left mt-4">
                <img src="<?php echo user_asset_url(); ?>images/icons/divider-bar.png" style="width: 38%;">
            </div>
        </div>
    </section>
    <!-- ==========Carousel-2============== -->

    <!-- ==========Carousel-3============== -->
    <section class="section-03">
        <div class="mb-1  text-center container">
            <div class="row d-flex align-items-center">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="carousel-02-text text-left">
                        <h2>Most Popular</h2>
                        <p>Be sure not to miss these events today.
                            <a href="javascript:void(0)" class="float-right more-btn <?php echo empty($gigs) ? 'd-none' : '' ?>">More<span class="ml-2"><img src="<?php echo user_asset_url(); ?>images/icons/arrow-more.png"></span></a>
                        </p>
                    </div>
                    <?php
                    if ($gigs) :
                    ?>
                        <div class="speaker--slider text-center" id="carousel_3">
                            <div class="speaker-slider3 owl-carousel owl-theme">
                                <?php
                                foreach ($gigs as $gig) :
                                ?>
                                    <div class="speaker-item1 card">
                                        <div class="speaker-thumb card-header">
                                            <img src="<?php echo $gig->poster ? poster_thumbnail_url().$gig->poster : user_asset_url().'images/home/slider-02/card-img01.png' ?>" style="max-width: 360px; max-height: 354px;">
                                            <?php if ($gig->is_exclusive) : ?>
                                                <span class="badge badge-danger exclusive-badge">exclusive</span>
                                            <?php endif; ?>
                                        </div>
                                        <div class="speaker-content card-footer">
                                            <div class="d-flex">
                                                <div class="footer-text">
                                                    <h5><?php echo $gig->title ?></h5>
                                                    <h6><?php echo $gig->user_name ?></h6>
                                                    <p><?php echo date('d M Y', strtotime($gig->gig_date)) ?></p>
                                                    <p><span class="mr-2"><img src="<?php echo user_asset_url(); ?>images/icons/ticket.png"></span><?php echo $gig->ticket_left ?> tickets left</p>
                                                    <p class="mb-3"><span class="mr-2"><img src="<?php echo user_asset_url(); ?>images/icons/calender.png"></span><?php echo abs($gig->days_left) > 0 ? abs($gig->days_left) . ' days left' : 'Today' ?></p>
                                                </div>
                                                <div class="circlebar">
                                                    <div class="pie_progress booked-color-1" role="progressbar" data-goal="<?php echo $gig->booked ?>">
                                                        <div class="pie_progress__number">0%</div>
                                                        <div class="pie_progress__label">Booked</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <button class="btn btn-warning btn-watch mb-4">book now</button>
                                            <a href="<?php echo user_base_url(); ?>gigs/detail?gig=<?php echo $gig->id ?>" type="button" class="btn btn-warning btn-view mb-4">view</a>
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
                            <a href="javascript:void(0)" class="float-right more-btn <?php echo empty($gigs) ? 'd-none' : '' ?>">More<span class="ml-2"><img src="<?php echo user_asset_url(); ?>images/icons/arrow-more.png"></span></a>
                        </p>
                    </div>
                    <?php
                    if ($gigs) :
                    ?>
                        <div class="speaker--slider text-center" id="carousel_4">
                            <div class="speaker-slider4 owl-carousel owl-theme">
                                <?php
                                foreach ($gigs as $gig) :
                                ?>
                                    <div class="speaker-item1 card">
                                        <div class="speaker-thumb card-header">
                                            <img src="<?php echo $gig->poster ? poster_thumbnail_url().$gig->poster : user_asset_url().'images/home/slider-02/card-img01.png' ?>" style="max-width: 360px; max-height: 354px;">
                                            <?php if ($gig->is_exclusive) : ?>
                                                <span class="badge badge-danger exclusive-badge">exclusive</span>
                                            <?php endif; ?>
                                        </div>
                                        <div class="speaker-content card-footer">
                                            <div class="d-flex">
                                                <div class="footer-text">
                                                    <h5><?php echo $gig->title ?></h5>
                                                    <h6><?php echo $gig->user_name ?></h6>
                                                    <p><?php echo date('d M Y', strtotime($gig->gig_date)) ?></p>
                                                    <p><span class="mr-2"><img src="<?php echo user_asset_url(); ?>images/icons/ticket.png"></span><?php echo $gig->ticket_left ?> tickets left</p>
                                                    <p class="mb-3"><span class="mr-2"><img src="<?php echo user_asset_url(); ?>images/icons/calender.png"></span><?php echo abs($gig->days_left) > 0 ? abs($gig->days_left) . ' days left' : 'Today' ?></p>
                                                </div>
                                                <div class="circlebar">
                                                    <div class="pie_progress booked-color-3" role="progressbar" data-goal="<?php echo $gig->booked ?>">
                                                        <div class="pie_progress__number">0%</div>
                                                        <div class="pie_progress__label">Booked</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <button class="btn btn-warning btn-watch mb-4">book now</button>
                                            <a href="<?php echo user_base_url(); ?>gigs/detail?gig=<?php echo $gig->id ?>" type="button" class="btn btn-warning btn-view mb-4">view</a>
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
                            <a href="javascript:void(0)" class="float-right more-btn <?php echo empty($just_in) ? 'd-none' : '' ?>">More<span class="ml-2"><img src="<?php echo user_asset_url(); ?>images/icons/arrow-more.png"></span></a>
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
                                            <img src="<?php echo $gig->poster ? poster_thumbnail_url().$gig->poster : user_asset_url().'images/home/slider-02/card-img01.png' ?>" style="max-width: 360px; max-height: 354px;">
                                            <?php if ($gig->is_exclusive) : ?>
                                                <span class="badge badge-danger exclusive-badge">exclusive</span>
                                            <?php endif; ?>
                                        </div>
                                        <div class="speaker-content card-footer">
                                            <div class="d-flex">
                                                <div class="footer-text">
                                                    <h5><?php echo $gig->title ?></h5>
                                                    <h6><?php echo $gig->user_name ?></h6>
                                                    <p><?php echo date('d M Y', strtotime($gig->gig_date)) ?></p>
                                                    <p><span class="mr-2"><img src="<?php echo user_asset_url(); ?>images/icons/ticket.png"></span><?php echo $gig->ticket_left ?> tickets left</p>
                                                    <p class="mb-3"><span class="mr-2"><img src="<?php echo user_asset_url(); ?>images/icons/calender.png"></span><?php echo abs($gig->days_left) > 0 ? abs($gig->days_left) . ' days left' : 'Today' ?></p>
                                                </div>
                                                <div class="circlebar">
                                                    <div class="pie_progress booked-color-1" role="progressbar" data-goal="<?php echo $gig->booked ?>">
                                                        <div class="pie_progress__number">0%</div>
                                                        <div class="pie_progress__label">Booked</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <button class="btn btn-warning btn-watch mb-4">book now</button>
                                            <a href="<?php echo user_base_url(); ?>gigs/detail?gig=<?php echo $gig->id ?>" type="button" class="btn btn-warning btn-view mb-4">view</a>
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

    <?php $this->load->view('frontend/layout/newsletter_footer'); ?>
    <?php $this->load->view('frontend/layout/scripts'); ?>


    <script>
        $(document).ready(function() {
            // $('#start_gig_menu').addClass('active');
            $('.carousel-inner').children().first().addClass('active');
            $('.owl-carousel').each(function() {
                if($(this).find('.owl-item').length < 3) {
                    $(this).parent().find('.speaker-prev').addClass('d-none');
                    $(this).parent().find('.speaker-next').addClass('d-none');
                }
                // console.log($(this).find('.owl-item').length < 3);
            });
        });
        $('.owl-carousel').owlCarousel({
            loop: $(this).find('.owl-item').length > 2,
            rewind: true,
            autoplay: true,
            dots: false,
            autoplayTimeout: 3000,
            margin: 30,
        });
    </script>
</body>

</html>