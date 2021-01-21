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
    <section class="detail-page-banner-section bg_img" data-background="<?php echo user_asset_url(); ?>images/banner/banner-3.png">
        <div class="container">
            <div class="row custom-row">
                <div class="col-lg-2 col-md-2 col-sm-6 col-12">
                    <div>
                        <img src="<?php echo user_asset_url(); ?>images/detail-page/banner-person.png" class="w-100" alt="image">
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-6">
                    <div class="custom-text">
                        <h5 class="title">Dekmantel</h5>
                        <h6>Tylor Swift</h6>
                        <p>Music <span>|</span> Show <span>|</span> English</p>
                        <p class="">Release Date <span>:</span> 24 Dec 2020 </p>
                    </div>
                </div>
                <div class="col-lg-7 col-md-7 col-12"></div>
            </div>


        </div>
        <div class="width_fl">
            <div class="container">
                <div class="row custom-bottom">
                    <div class="col-lg-2 col-md-2 col-sm-12"></div>
                    <div class="col-lg-3 col-md-3 col-sm-12">
                        <div class="custom-item">
                            <div class="pie_progress booked-color-1" role="progressbar" data-goal="75">
                                <div class="pie_progress__number">0%</div>
                                <div class="pie_progress__label">Booked</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-7 col-sm-12 col-12 custom-items">
                        <div class="custom-item2">
                            <p><span class="mr-2"><img src="<?php echo user_asset_url(); ?>images/icons/ticket.png"></span>10 tickets left</p>
                            <p><span class="mr-2"><img src="<?php echo user_asset_url(); ?>images/icons/calender.png"></span>3 days left</p>
                        </div>
                        <div class="custom-item3">
                            <a href="#0" class="btn btn-warning btn-booking">book now</a>
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
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="photo-heading">
                        <h3>Photos</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-9 col-md-9 col-sm-12 col-12">

                    <div class="row photos">
                        <div class="col-lg-4 col-md-4 col-sm-12 col-12"><img src="<?php echo user_asset_url(); ?>images/explore/photo-1.png" class="w-100"></div>
                        <div class="col-lg-4 col-md-4 col-sm-12 col-12 resp-margin"><img src="<?php echo user_asset_url(); ?>images/explore/photo-2.png" class="w-100"></div>
                        <div class="col-lg-4 col-md-4 col-sm-12 col-12"><img src="<?php echo user_asset_url(); ?>images/explore/photo-3.png" class="w-100"></div>
                    </div>

                    <div class="tab summery-review">
                        <ul class="tab-menu">
                            <li class="tab-1 active">
                                Summary
                            </li>
                            <li class="tab-1">
                                user review <span>147</span>
                            </li>
                        </ul>
                        <div class="tab-area">
                            <div class="tab-item active">
                                <div class="item">
                                    <h5 class="sub-title">Dekmantel Show</h5>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vehicula eros sit amet est tincidunt aliquet. Fusce laoreet ligula ac ultrices eleifend. Donec hendrerit fringilla odio, ut feugiat mi convallis nec. Fusce elit ex, blandit vitae mattis sit amet, iaculis ac elit. Ut diam mauris, viverra sit amet dictum vel, aliquam ac quam. Ut mi nisl, fringilla sit amet erat et, convallis porttitor ligula. Sed auctor, orci id luctus venenatis, dui dolor euismod risus, et pharetra orci lectus quis sapien. Duis blandit ipsum ac consectetur scelerisque. </p>
                                </div>
                                <div class="item slider-item">
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
                                </div>
                            </div>
                            <div class="tab-item">
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
                            </div>
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

    <?php $this->load->view('frontend/layout/newsletter_footer'); ?>
    <?php $this->load->view('frontend/layout/scripts'); ?>
</body>

</html>