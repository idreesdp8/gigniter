<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('frontend/layout/meta_tags'); ?>
    <title>Gigniter - Online Ticket Booking Website HTML Template</title>
    <style>
        .detail_image_holder {
            overflow: hidden;
            height: 296px;
            width: auto;
        }

        .detail_image_holder img {
            height: 100%;
        }

        .gallery_image {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>
</head>

<body>
    <?php $this->load->view('frontend/layout/preloader'); ?>
    <?php $this->load->view('frontend/layout/header'); ?>
    <!-- Page content -->
    <!-- ==========Banner-Section========== -->
    <section class="detail-page-banner-section bg_img" data-background="<?php echo user_asset_url(); ?>images/banner/banner-3.png">
        <div class="container">
            <div class="row custom-row">
                <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                    <div class="detail_image_holder">
                        <!-- style="width: 165px; height: 296px;" -->
                        <img src="<?php echo $gig->poster ? poster_url() . $gig->poster : user_asset_url() . 'images/home/slider-02/card-img01.png' ?>" alt="image">
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-6">
                    <div class="custom-text">
                        <h5 class="title"><?php echo $gig->title; ?></h5>
                        <h6><?php echo $gig->user_name; ?></h6>
                        <p>
                            <?php echo $gig->genre_name ?> <span>|</span> <?php echo $gig->category_name ?>
                        </p>
                        <!-- <p>Music <span>|</span> Show <span>|</span> English</p> -->
                        <p class="">Release Date <span>:</span> <?php echo date('d M Y', strtotime($gig->gig_date)); ?></p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12"></div>
            </div>


        </div>
        <div class="width_fl">
            <div class="container">
                <div class="row custom-bottom">
                    <div class="col-lg-3 col-md-3 col-sm-12"></div>
                    <div class="col-lg-3 col-md-3 col-sm-12">
                        <div class="custom-item">
                            <div class="pie_progress booked-color-1" role="progressbar" data-goal="<?php echo $gig->booked; ?>">
                                <div class="pie_progress__number"><?php echo $gig->booked; ?>%</div>
                                <div class="pie_progress__label">Booked</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12 custom-items">
                        <div class="custom-item2">
                            <p><span class="mr-2"><img src="<?php echo user_asset_url(); ?>images/icons/ticket.png"></span><?php echo $gig->ticket_left; ?> tickets left</p>
                            <p><span class="mr-2"><img src="<?php echo user_asset_url(); ?>images/icons/calender.png"></span><?php echo $gig->days_left; ?> days left</p>
                        </div>
                        <?php
                        if ($stream_details) :
                        ?>
                            <div class="custom-item3">
                                <a type="button" class="btn btn-warning btn-booking show_modal" href="<?php echo user_base_url() . 'gigs/live/' . $gig->id; ?>">view live</a>
                            </div>
                        <?php
                        endif;
                        ?>
                        <div class="custom-item3">
                            <button type="button" class="btn btn-warning btn-booking show_modal" data-toggle="modal" data-target="#book_now_modal" data-id="<?php echo $gig->id; ?>">book now</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>



    </section>
    <!-- ==========Banner-Section========== -->

    <!-- ==========photo-Section========== -->
    <section class="section-margin-top">
        <div class="container">
            <?php
            if ($gig->user_id == $this->session->userdata('us_id')) :
            ?>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="photo-heading">
                            <h3>Stream Details</h3>
                        </div>
                    </div>
                </div>
                <!-- <div class="row"> -->
                <p class="sub-title"><strong>Stream URL: </strong><?php echo $stream_details ? $stream_details->stream_url : 'NA' ?></p>
                <p class="sub-title"><strong>Stream Secret Key: </strong><?php echo $stream_details ? $stream_details->stream_key : 'NA' ?></p>
                <!-- </div> -->
            <?php
            endif;
            ?>
            <?php
            if ($gig->images) :
            ?>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="photo-heading">
                            <h3>Photos</h3>
                        </div>
                    </div>
                </div>
            <?php
            endif;
            ?>
            <div class="row">
                <div class="col-lg-9 col-md-9 col-sm-12 col-12">
                    <?php
                    if ($gig->images) :
                    ?>
                        <!-- <div class="row photos"> -->
                        <div class="casting-slider-two owl-carousel">
                            <?php
                            foreach ($gig->images as $gig_gallery) :
                            ?>
                                <div class="cast-item">
                                    <div class="cast-thumb" style="border-radius: 0;">
                                        <img src="<?php echo gig_images_url() . $gig_gallery->image ?>" class="gallery_image" alt="gig_images">
                                    </div>
                                </div>
                                <!-- <div class="col-lg-4 col-md-4 col-sm-12 col-12"><img src="<?php echo gig_images_url() . $gig_gallery->image ?>" class="w-100"></div> -->
                            <?php
                            endforeach;
                            ?>
                        </div>
                        <!-- </div> -->
                    <?php
                    endif;
                    ?>

                    <div class="tab summery-review">
                        <ul class="tab-menu">
                            <li class="tab-1 active">
                                Summary
                            </li>
                            <!-- <li class="tab-1">
                                user review <span>147</span>
                            </li> -->
                        </ul>
                        <div class="tab-area">
                            <div class="tab-item active">
                                <div class="item">
                                    <h5 class="sub-title">Summary</h5>
                                    <p><?php echo $gig->subtitle ?></p>
                                </div>
                                <!-- <div class="item slider-item">
                                    <div class="header">
                                        <h5 class="sub-title">Performers</h5>

                                    </div>
                                    <div class="casting-slider-two owl-carousel">
                                        <div class="cast-item">
                                            <div class="cast-thumb">
                                                <a href="#0">
                                                    <img src="<?php echo user_asset_url(); ?>images/explore/performer-1.png" alt="cast">
                                                </a>
                                            </div>
                                            <div class="cast-content">
                                                <h6 class="cast-title"><a href="#0">Joe and Jonas</a></h6>
                                                <span class="cate">Guitarist</span>
                                            </div>
                                        </div>
                                        <div class="cast-item">
                                            <div class="cast-thumb">
                                                <a href="#0">
                                                    <img src="<?php echo user_asset_url(); ?>images/explore/performer-2.png" alt="cast">
                                                </a>
                                            </div>
                                            <div class="cast-content">
                                                <h6 class="cast-title"><a href="#0">Joe and Jonas</a></h6>
                                                <span class="cate">Performer</span>
                                            </div>
                                        </div>
                                        <div class="cast-item">
                                            <div class="cast-thumb">
                                                <a href="#0">
                                                    <img src="<?php echo user_asset_url(); ?>images/explore/performer-3.png" alt="cast">
                                                </a>
                                            </div>
                                            <div class="cast-content">
                                                <h6 class="cast-title"><a href="#0">Joe and Jonas</a></h6>
                                                <span class="cate">Guitarist</span>
                                            </div>
                                        </div>
                                        <div class="cast-item">
                                            <div class="cast-thumb">
                                                <a href="#0">
                                                    <img src="<?php echo user_asset_url(); ?>images/explore/performer-4.png" alt="cast">
                                                </a>
                                            </div>
                                            <div class="cast-content">
                                                <h6 class="cast-title"><a href="#0">Joe and Jonas</a></h6>
                                                <span class="cate">Singer</span>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                            </div>
                            <!-- <div class="tab-item">
                                <div class="movie-review-item">
                                    <div class="author">
                                        <div class="thumb">
                                            <a href="#0">
                                                <img src="<?php echo user_asset_url(); ?>images/cast/cast02.jpg" alt="cast">
                                            </a>
                                        </div>
                                        <div class="movie-review-info">
                                            <span class="reply-date">13 Days Ago</span>
                                            <h6 class="subtitle"><a href="#0">minkuk seo</a></h6>
                                            <span><i class="fas fa-check"></i> verified review</span>
                                        </div>
                                    </div>
                                    <div class="movie-review-content">
                                        <div class="review">
                                            <i class="flaticon-favorite-heart-button"></i>
                                            <i class="flaticon-favorite-heart-button"></i>
                                            <i class="flaticon-favorite-heart-button"></i>
                                            <i class="flaticon-favorite-heart-button"></i>
                                            <i class="flaticon-favorite-heart-button"></i>
                                        </div>
                                        <h6 class="cont-title">Awesome Movie</h6>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer volutpat enim non ante egestas vehicula. Suspendisse potenti. Fusce malesuada fringilla lectus venenatis porttitor. </p>
                                        <div class="review-meta">
                                            <a href="#0">
                                                <i class="flaticon-hand"></i><span>8</span>
                                            </a>
                                            <a href="#0" class="dislike">
                                                <i class="flaticon-dont-like-symbol"></i><span>0</span>
                                            </a>
                                            <a href="#0">
                                                Report Abuse
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="movie-review-item">
                                    <div class="author">
                                        <div class="thumb">
                                            <a href="#0">
                                                <img src="<?php echo user_asset_url(); ?>images/cast/cast04.jpg" alt="cast">
                                            </a>
                                        </div>
                                        <div class="movie-review-info">
                                            <span class="reply-date">13 Days Ago</span>
                                            <h6 class="subtitle"><a href="#0">rudra rai</a></h6>
                                            <span><i class="fas fa-check"></i> verified review</span>
                                        </div>
                                    </div>
                                    <div class="movie-review-content">
                                        <div class="review">
                                            <i class="flaticon-favorite-heart-button"></i>
                                            <i class="flaticon-favorite-heart-button"></i>
                                            <i class="flaticon-favorite-heart-button"></i>
                                            <i class="flaticon-favorite-heart-button"></i>
                                            <i class="flaticon-favorite-heart-button"></i>
                                        </div>
                                        <h6 class="cont-title">Awesome Movie</h6>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer volutpat enim non ante egestas vehicula. Suspendisse potenti. Fusce malesuada fringilla lectus venenatis porttitor. </p>
                                        <div class="review-meta">
                                            <a href="#0">
                                                <i class="flaticon-hand"></i><span>8</span>
                                            </a>
                                            <a href="#0" class="dislike">
                                                <i class="flaticon-dont-like-symbol"></i><span>0</span>
                                            </a>
                                            <a href="#0">
                                                Report Abuse
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="movie-review-item">
                                    <div class="author">
                                        <div class="thumb">
                                            <a href="#0">
                                                <img src="<?php echo user_asset_url(); ?>images/cast/cast01.jpg" alt="cast">
                                            </a>
                                        </div>
                                        <div class="movie-review-info">
                                            <span class="reply-date">13 Days Ago</span>
                                            <h6 class="subtitle"><a href="#0">rafuj</a></h6>
                                            <span><i class="fas fa-check"></i> verified review</span>
                                        </div>
                                    </div>
                                    <div class="movie-review-content">
                                        <div class="review">
                                            <i class="flaticon-favorite-heart-button"></i>
                                            <i class="flaticon-favorite-heart-button"></i>
                                            <i class="flaticon-favorite-heart-button"></i>
                                            <i class="flaticon-favorite-heart-button"></i>
                                            <i class="flaticon-favorite-heart-button"></i>
                                        </div>
                                        <h6 class="cont-title">Awesome Movie</h6>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer volutpat enim non ante egestas vehicula. Suspendisse potenti. Fusce malesuada fringilla lectus venenatis porttitor. </p>
                                        <div class="review-meta">
                                            <a href="#0">
                                                <i class="flaticon-hand"></i><span>8</span>
                                            </a>
                                            <a href="#0" class="dislike">
                                                <i class="flaticon-dont-like-symbol"></i><span>0</span>
                                            </a>
                                            <a href="#0">
                                                Report Abuse
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="movie-review-item">
                                    <div class="author">
                                        <div class="thumb">
                                            <a href="#0">
                                                <img src="<?php echo user_asset_url(); ?>images/cast/cast03.jpg" alt="cast">
                                            </a>
                                        </div>
                                        <div class="movie-review-info">
                                            <span class="reply-date">13 Days Ago</span>
                                            <h6 class="subtitle"><a href="#0">bela bose</a></h6>
                                            <span><i class="fas fa-check"></i> verified review</span>
                                        </div>
                                    </div>
                                    <div class="movie-review-content">
                                        <div class="review">
                                            <i class="flaticon-favorite-heart-button"></i>
                                            <i class="flaticon-favorite-heart-button"></i>
                                            <i class="flaticon-favorite-heart-button"></i>
                                            <i class="flaticon-favorite-heart-button"></i>
                                            <i class="flaticon-favorite-heart-button"></i>
                                        </div>
                                        <h6 class="cont-title">Awesome Movie</h6>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer volutpat enim non ante egestas vehicula. Suspendisse potenti. Fusce malesuada fringilla lectus venenatis porttitor. </p>
                                        <div class="review-meta">
                                            <a href="#0">
                                                <i class="flaticon-hand"></i><span>8</span>
                                            </a>
                                            <a href="#0" class="dislike">
                                                <i class="flaticon-dont-like-symbol"></i><span>0</span>
                                            </a>
                                            <a href="#0">
                                                Report Abuse
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="load-more text-center">
                                    <a href="#0" class="custom-button transparent">load more</a>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                    <img src="<?php echo user_asset_url(); ?>images/detail-page/custom-text-box.png" class="w-100">
                </div>
            </div>
        </div>
    </section>
    <!-- ==========photo-Section========== -->
    <!-- /page content -->

    <?php $this->load->view('frontend/gigs/book_now'); ?>

    <?php $this->load->view('frontend/layout/newsletter_footer'); ?>
    <?php $this->load->view('frontend/layout/scripts'); ?>
    <script src="<?php echo user_asset_url(); ?>js/add-to-cart.js"></script>
</body>

</html>