<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('frontend/layout/meta_tags'); ?>
    <title>Gigniter - Online Ticket Booking Service</title>
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
                        <img src="<?php echo $poster ? session_url() . $poster : user_asset_url() . '' ?>" alt="image">
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-6">
                    <div class="custom-text">
                        <h5 class="title"><?php echo $title; ?></h5>
                        <h6><?php echo $username; ?></h6>
                        <p>
                            <?php echo $genre ?> <span>|</span> <?php echo $category ?>
                        </p>
                        <div class="social-and-duration">
                            <div class="duration-area d-flex">
                                <div class="item mr-3">
                                    <i class="fas fa-calendar-alt mr-2"></i><span><?php echo $gig_date ?></span>
                                </div>
                                <div class="item">
                                    <i class="far fa-clock mr-2"></i><span><?php echo $duration ?></span>
                                </div>
                            </div>
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
                            <div class="pie_progress <?php echo $booked < 60 ? 'booked-color-2' : 'booked-color-1' ?>" role="progressbar" data-goal="<?php echo $booked; ?>">
                                <div class="pie_progress__number"><?php echo $booked; ?>%</div>
                                <div class="pie_progress__label">Booked</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12 custom-items">
                        <div class="custom-item2">
                            <p><span class="mr-2"><img src="<?php echo user_asset_url(); ?>images/icons/ticket.png"></span><?php echo $ticket_limit; ?> tickets left</p>
                            <p><span class="mr-2"><img src="<?php echo user_asset_url(); ?>images/icons/calender.png"></span><?php echo $days_left; ?> days left</p>
                        </div>
                        <div class="custom-item3 d-flex">
                            <a type="button" class="skicky-buttons btn btn-warning btn-booking ml-2 d-flex align-items-center" href="javascript:close_window();">close</a>
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
                        <h3>Stream Details</h3>
                    </div>
                </div>
            </div>
            <!-- <div class="row"> -->
            <p class="sub-title"><strong>Stream URL: </strong><?php echo $stream_url ?></p>
            <p class="sub-title"><strong>Stream Secret Key: </strong><?php echo $stream_key ?></p>
            <?php
            if (isset($images)) :
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
                    if (isset($images)) :
                    ?>
                        <!-- <div class="row photos"> -->
                        <div class="casting-slider-two owl-carousel detailpage-crousal">
                            <?php
                            foreach ($images as $gig_gallery) :
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
                                <?php
                                if (isset($video) && $video != '') :
                                ?>
                                    <video playsinline="playsinline" autoplay="autoplay" muted="muted" loop="loop">
                                        <source src="<?php echo $video ? session_url() . $video : 'https://storage.googleapis.com/coverr-main/mp4/Mt_Baker.mp4' ?>" type="video/mp4">
                                    </video>
                                <?php else : ?>
                                    <img src="<?php echo $poster ? session_url() . $poster : user_asset_url() . 'images/blog/blog01.jpg' ?>" alt="blog">
                                <?php
                                endif;
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-12 mb-3 text-lg-left text-center">
                            <ul class="social-share">
                                <li class="padding-5-10"><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li class="padding-5-10"><a href="#"><i class="fab fa-twitter"></i></a></li>
                                <li class="padding-5-10"><a href="#"><i class="fab fa-pinterest-p"></i></a></li>
                                <li class="padding-5-10"><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                            </ul>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12 text-lg-right text-center">
                            <div class="reactions-live d-inline-flex">
                                <p data-emoji="thumbs-up" class="noselect like-emoji emoji-starter selector-reactions mr-2 reactions-btn mb-0">
                                    <i class="like-blue fas fa-thumbs-up mr-2"></i><span>Like</span>&nbsp(<span id="like-count"><?php echo '0' ?></span>)
                                </p>
                                <p data-emoji="heart" class="noselect emoji-starter heart mr-2 reactions-btn mb-0">
                                    <i class="heart-red fas fa-heart mr-2"></i><span>Heart</span>&nbsp(<span id="heart-count"><?php echo '0' ?></span>)
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
                                                                <?php
                                                                $bundle = $tier['bundle'][0];
                                                                ?>
                                                                <img src="<?php echo $bundle['image'] != '' ? session_url() . $bundle['image'] : user_asset_url() . 'images/cap.png' ?>" alt="cast">
                                                            </a>
                                                        </div>
                                                        <div class="cast-content">
                                                            <h6 class="cast-title"><a href="#0"><?php echo $tier['name'] ?></a></h6>
                                                            <span class="cate">$<?php echo $tier['price'] ?>/<?php echo $tier['quantity'];
                                                                                                                echo $tier['quantity'] > 1 ? ' Tickets' : ' Ticket' ?></span>
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
        function close_window() {
            swal({
                title: "Are you sure you want to close the preview?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                buttons: ["No", "Yes"],
            }).then((willDelete) => {
                if (willDelete) {
                    close();
                }
            });
        }
        $(document).ready(function() {

            $(window).scroll(function() {
                var sticky = $('.skicky-buttons'),
                    scroll = $(window).scrollTop();

                if (scroll >= 500) sticky.addClass('fixed-button-top');
                else sticky.removeClass('fixed-button-top');
            });
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