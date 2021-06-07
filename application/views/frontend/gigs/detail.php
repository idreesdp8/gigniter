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
            width: 100%;
            object-fit: cover;
        }

        .gallery_image {
            width: 100% !important;
            height: 100%;
            border-radius: 0 !important;
            object-fit: cover;
        }

        .social-share li {
            display: inline;
            padding: 5px 10px;
        }

        .tier-cast-thumb {
            width: 200px !important;
        }

        .owl-nav.disabled {
            display: none;
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
                        <!-- <p class="">Release Date <span>:</span> <?php echo date('d M Y', strtotime($gig->gig_date)); ?></p> -->
                        <div class="social-and-duration">
                            <div class="duration-area d-flex">
                                <div class="item mr-3">
                                    <i class="fas fa-calendar-alt mr-2"></i><span><?php echo date('d M, Y', strtotime($gig->gig_date)); ?></span>
                                </div>
                                <div class="item">
                                    <i class="far fa-clock mr-2"></i><span><?php echo $gig->duration ?></span>
                                </div>
                            </div>
                            <!-- <ul class="social-share">
                                <li><a href="#0"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#0"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="#0"><i class="fab fa-pinterest-p"></i></a></li>
                                <li><a href="#0"><i class="fab fa-linkedin-in"></i></a></li>
                                <li><a href="#0"><i class="fab fa-google-plus-g"></i></a></li>
                            </ul> -->
                        </div>
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
                            <div class="pie_progress <?php echo $gig->booked < 60 ? 'booked-color-2' : 'booked-color-1' ?>" role="progressbar" data-goal="<?php echo $gig->booked; ?>">
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
                            <a type="button" class="btn btn-warning btn-booking" href="<?php echo user_base_url() . 'cart/book_tier/' . $gig->id ?>">book now</a>
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
            <!-- <div class="row mt-5 mb-5">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">

                </div>
            </div> -->
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
                        <div class="casting-slider-two owl-carousel detailpage-crousal">
                            <?php
                            foreach ($gig->images as $gig_gallery) :
                            ?>
                                <div class="cast-item">
                                    <a href="<?php echo gig_images_url() . $gig_gallery->image ?>" class="img-pop">
                                        <div class="cast-thumb" style="border-radius: 0;">
                                            <img src="<?php echo gig_images_url() . $gig_gallery->image ?>" class="gallery_image" alt="image">
                                        </div>
                                    </a>
                                </div>
                                <!-- <div class="col-lg-4 col-md-4 col-sm-12 col-12"><img src="<?php echo gig_images_url() . $gig_gallery->image ?>" class="w-100"></div> -->
                            <?php
                            endforeach;
                            ?>
                        </div>
                    <?php
                    endif;
                    $this->dbs_user_id = $this->session->userdata('us_id');
                    ?>

                    <div class="post-item post-details mb-1">
                        <div class="post-thumb">
                            <div id="wrapper-video">
                                <?php if (!$this->dbs_user_id || ($this->dbs_user_id && !in_array($this->dbs_user_id, $gig->buyers) && !($gig->user_id == $this->dbs_user_id))) : ?>
                                    <div class="overlay-video"></div>
                                <?php
                                endif;
                                if (isset($gig->video)) : ?>
                                    <video playsinline="playsinline" autoplay="autoplay" muted="muted" loop="loop">
                                        <source src="https://storage.googleapis.com/coverr-main/mp4/Mt_Baker.mp4" type="video/mp4">
                                    </video>
                                <?php else : ?>
                                    <img src="<?php echo $gig->poster ? poster_url() . $gig->poster : user_asset_url() . 'images/blog/blog01.jpg' ?>" alt="blog">
                                <?php
                                endif;
                                if (!$this->dbs_user_id || ($this->dbs_user_id && !in_array($this->dbs_user_id, $gig->buyers) && !($gig->user_id == $this->dbs_user_id))) : ?>

                                    <div class=" container h-100 particlesContainer">
                                        <div class="d-flex h-100 text-center align-items-center">
                                            <div class="w-100 text-white">
                                                <h1 class="display-3">The Gig is ON!</h1>
                                                <p class="lead mb-0">Join Here</p>
                                                <a href="<?php echo user_base_url() . 'cart/book_tier/' . $gig->id ?>" style="width:250px; border: 1px solid #f1c600;" type="button" class="btn-theme-primary btn btn-primary mx-auto mt-4">Book your spot</a>
                                            </div>
                                        </div>
                                    </div>

                                <?php endif; ?>
                                        <div class="reactions-onfeed"></div>
                            </div>
                        </div>
                    </div>
                    <?php
                    $url = rawurlencode(user_base_url() . 'gigs/detail?gig=' . $gig->id);
                    $imgurl = rawurlencode($gig->poster ? poster_url() . $gig->poster : user_asset_url() . 'images/blog/blog01.jpg');
                    ?>
                    <div class="row">
                      <div class="col-lg-6 col-md-6 col-12 mb-3 text-lg-left text-center">
                          <ul class="social-share">
                              <li class="padding-5-10"><a onclick="window.open('https://www.facebook.com/sharer.php?u=<?php echo $url ?>','sharer','width=500,height=700'); return false;" href="https://www.facebook.com/sharer.php?u=<?php echo $url ?>"><i class="fab fa-facebook-f"></i></a></li>
                              <li class="padding-5-10"><a onclick="window.open('https://twitter.com/share?url=<?php echo $url ?>','sharer','width=500,height=700'); return false;" href="https://twitter.com/share?url=<?php echo $url ?>"><i class="fab fa-twitter"></i></a></li>
                              <li class="padding-5-10"><a onclick="window.open('https://pinterest.com/pin/create/button/?url=<?php echo $url ?>&media=<?php echo $imgurl; ?>&description=<?php echo $gig->title ?>','sharer','width=500,height=700'); return false;" href="https://pinterest.com/pin/create/button/?url=<?php echo $url ?>"><i class="fab fa-pinterest-p"></i></a></li>
                              <li class="padding-5-10"><a onclick="window.open('https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $url ?>','sharer','width=500,height=700'); return false;" href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $url ?>"><i class="fab fa-linkedin-in"></i></a></li>
                          </ul>
                            </div>
                          <div class="col-lg-6 col-md-6 col-12 text-lg-right text-center">
                            <div class="reactions-live d-inline-flex">
                              <p  data-emoji="thumbs-up" class="noselect like-emoji emoji-starter selector-reactions mr-2 reactions-btn mb-0">
                              <i class="like-blue fas fa-thumbs-up mr-2"></i><span>like</span>
                              </p>
                              <p  data-emoji="heart" class="noselect emoji-starter heart mr-2 reactions-btn mb-0">
                                <i class="heart-red fas fa-heart mr-2"></i><span>Heart</span>
                              </p>

                              </div>
                          </div>


                    </div>


                    <?php
                    if ($tiers) :
                    ?>
                        <div class="movie-details">
                            <div class="tab summery-review">
                                <div class="tab-area">
                                    <div class="tab-item active">
                                        <div class="item">
                                            <div class="header">
                                                <h5 class="sub-title">ticket tiers</h5>
                                                <div class="navigation <?php echo count($tiers) < 3 ? 'd-none' : '' ?>">
                                                    <div class="cast-prev"><i class="flaticon-double-right-arrows-angles"></i></div>
                                                    <div class="cast-next"><i class="flaticon-double-right-arrows-angles"></i></div>
                                                </div>
                                            </div>
                                            <div class="casting-slider owl-carousel">
                                                <?php
                                                foreach ($tiers as $tier) :
                                                ?>
                                                    <div class="cast-item mb-2">
                                                        <div class="cast-thumb tier-cast-thumb">
                                                            <a href="#0">
                                                                <img src="<?php echo $tier->image != '' ? bundle_url() . $tier->image : user_asset_url() . 'images/cap.png' ?>" alt="cast">
                                                            </a>
                                                        </div>
                                                        <div class="cast-content">
                                                            <h6 class="cast-title"><a href="#0"><?php echo $tier->name ?></a></h6>
                                                            <span class="cate">$<?php echo $tier->price ?>/<?php echo $tier->quantity;
                                                                                                            echo $tier->quantity > 1 ? ' Tickets' : ' Ticket' ?></span>
                                                            <a type="button" class="btn-theme-primary btn" href="<?php echo user_base_url() . 'cart/book_tier/' . $gig->id ?>">book now</a>
                                                        </div>
                                                    </div>
                                                <?php
                                                endforeach;
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    endif;
                    ?>

                    <!-- <div class="tab summery-review">
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
                                    <h5 class="sub-title">Summary</h5>
                                    <p><?php echo $gig->subtitle ?></p>
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
                    </div> -->
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
    <script>
        $(document).ready(function() {




            // ---------- PARAMETERS ---------

            var randomSpeeds = function(){ return getRandomInteger(1000, 3000) } // The lower, the faster
            var delay = 50 // The higher, the more delay
            var startScreenPercentage = 0.70 // starts from 70% of the screen...
            var endScreenPercentage = 0.97 // ...till 100% (end) of the screen
            // -------------------------------
            // Generates a random integer between the min and max
            var getRandomInteger = function(min, max){
              return Math.floor(Math.random() * (max-min+1)) + min
            }

            var fbReactions = ['angry', 'sad', 'surprise', 'happy', 'shy']
            var interval

  $('.heart').on('click', function(event){
      $('.reactions-onfeed').append('<p class="particle jquery-reactions onfeed-like"><i class="heart-red fas fa-heart mr-2"></i></p>')
  })
  $('.like-emoji').on('click', function(event){
      $('.reactions-onfeed').append('<p class="particle jquery-reactions onfeed-like"><i class="like-blue fas fa-thumbs-up mr-2"></i></p>')
  })
            $('.emoji-starter').on('click', function(event){
              interval = setInterval(function(){
                var emojiName = $(event.target).parent().data("emoji")
              //  $('.reactions-onfeed').append('<p class="particle jquery-reactions onfeed-like"><i class="like-blue fas fa-'+ emojiName +' mr-2"></i></p>')
                $('.particle').toArray().forEach(function(particle){
                  var bounds = getRandomInteger($('.reactions-onfeed').width() * startScreenPercentage, $('.reactions-onfeed').width() * endScreenPercentage)
                  $(particle).animate({ left: bounds, right: bounds}, delay, function(){
                    $(particle).animate({ top: '-100%', opacity: 0}, randomSpeeds() , function(){
                      $(particle).remove()
                    })
                  })
                }) /* forEach particle Loop close*/
                clearInterval(interval)
              }, 1 ) /* setInterval close*/
            })



            $('.cast-prev, .cast-next').on('mouseover', function() {
                console.log($(this).parents('.item').children('.owl-carousel'));
                $(this).parents('.item').children('.owl-carousel').trigger('stop.owl.autoplay');
            });
            $('.cast-prev, .cast-next').on('mouseleave', function() {
                console.log($(this).parents('.item').children('.owl-carousel'));
                $(this).parents('.item').children('.owl-carousel').trigger('play.owl.autoplay');
            });
        })
        $('.detailpage-crousal').owlCarousel({
            rewind: true,
            autoplay: true,
            dots: false,
            autoplayTimeout: 2000,
            margin: 30,
            autoplayHoverPause: true,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 1,
                    nav: true,
                    loop: ($(this).find('.owl-item')).length > 2
                },
                600: {
                    items: 3,
                    nav: true,
                    loop: ($(this).find('.owl-item')).length > 2
                },
                1000: {
                    items: 3,
                    nav: true,
                    loop: ($(this).find('.owl-item')).length > 2
                }
            }
        });
        $('.owl-carousel').owlCarousel({
            rewind: true,
            autoplay: true,
            dots: false,
            autoplayTimeout: 2000,
            margin: 30,
            autoplayHoverPause: true,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 1,
                    loop: ($(this).find('.owl-item')).length > 2
                },
                600: {
                    items: 3,
                    loop: ($(this).find('.owl-item')).length > 2
                },
                1000: {
                    items: 3,
                    loop: ($(this).find('.owl-item')).length > 2
                }
            }
        });
    </script>
</body>

</html>
