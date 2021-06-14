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
    <section class="speaker-banner bg_img" data-background="./assets/images/banner/banner07.jpg">
        <div class="container">
            <div class="speaker-banner-content">
                <h2 class="title">Artist Profile</h2>

            </div>
        </div>
    </section>
    <!-- ==========Banner-Section========== -->

    <!-- ==========Speaker-Single========== -->
    <section class="speaker-single padding-top pt-lg-0">
        <div class="container">
            <div class="speaker-wrapper bg-six padding-top padding-bottom">
                <div class="speaker-thumb">
                    <img src="<?php echo profile_image_url() . $user->image ?>" alt="speaker">
                    <!-- <a href="#0">www.website.com</a> -->
                </div>
                <div class="speaker-content">
                    <div class="author">
                        <h2 class="title"><?php echo ($user->fname ? ucfirst($user->fname) : '') . ' ' . ($user->lname ? ucfirst($user->lname) : '') ?></h2>
                        <!-- <div class="info">Independent consultant, coach and executive coach</div> -->
                    </div>
                    <div class="speak-con-wrapper">
                        <div class="speak-con-area">
                            <div class="item">
                                <div class="item-thumb">
                                    <img src="<?php echo user_asset_url(); ?>images/event-icon03.png" alt="event">
                                </div>
                                <div class="item-content">
                                    <span class="up">Contact Artist:</span>
                                    <a class="theme-primary-color" href="MailTo:<?php echo $user->mail ?>"><?php echo $user->mail ?></a>
                                </div>
                            </div>
                            <ul class="social-icons">
                                <?php
                                if (isset($user->facebook)) :
                                ?>
                                    <li>
                                        <a class="btn-theme-primary artist-links" target="_blank" href="<?php echo $user->facebook ?>">
                                            <i class="fab fa-facebook-f"></i>
                                        </a>
                                    </li>
                                <?php
                                endif;
                                if (isset($user->instagram)) :
                                ?>
                                    <li>
                                        <a class="btn-theme-primary artist-links" target="_blank" href="<?php echo $user->instagram ?>">
                                            <i class="fab fa-instagram"></i>
                                        </a>
                                    </li>
                                <?php
                                endif;
                                if (isset($user->twitter)) :
                                ?>
                                    <li>
                                        <a class="btn-theme-primary artist-links" target="_blank" href="<?php echo $user->twitter ?>">
                                            <i class="fab fa-twitter"></i>
                                        </a>
                                    </li>
                                <?php
                                endif;
                                if (isset($user->linkedin)) :
                                ?>
                                    <li>
                                        <a class="btn-theme-primary artist-links" target="_blank" href="<?php echo $user->linkedin ?>">
                                            <i class="fab fa-linkedin-in"></i>
                                        </a>
                                    </li>
                                <?php
                                endif;
                                if (isset($user->pinterest)) :
                                ?>
                                    <li>
                                        <a class="btn-theme-primary artist-links" target="_blank" href="<?php echo $user->pinterest ?>">
                                            <i class="fab fa-pinterest"></i>
                                        </a>
                                    </li>
                                <?php
                                endif;
                                if (isset($user->behance)) :
                                ?>
                                    <li>
                                        <a class="btn-theme-primary artist-links" target="_blank" href="<?php echo $user->behance ?>">
                                            <i class="fab fa-behance"></i>
                                        </a>
                                    </li>
                                <?php
                                endif;
                                ?>
                            </ul>
                        </div>
                    </div>
                    <div class="content">
                        <h3 class="subtitle">About me</h3>
                        <p><?php echo $user->description ?></p>
                        <!-- <p>A successful marketing plan relies heavily on the pulling-power of advertising copy. Writing result-oriented ad copy is difficult, as it must appeal to, entice, and convince consumers to take action. There is no magic formula to write perfect ad copy; it is based on a number of factors, including ad placement, demographic, even the consumer’s mood when they see your ad. </p>
                        <p>So how is any writer supposed to pen a stunning piece of advertising copy — copy that sizzles and sells? The following tips will jumpstart your creative thinking and help you write a better ad.</p>
                        <p>Consumers are inundated with ads, so it’s vital that your ad catches the eye and immediately grabs interest. You could do this with a headline or slogan (such as VW’s “Drivers Wanted” campaign), color or layout (Target’s new colorful, simple ads are a testimony to this) or illustration (such as the Red Bull characters or Zoloft’s depressed ball and his ladybug friend).</p> -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ==========Speaker-Single========== -->

    <!-- ==========Speaker-Section========== -->
    <section class="speaker-section padding-bottom padding-top">
        <div class="container">
            <div class="section-header-3">

                <h2 class="title">Artist's Gig</h2>
                <p>World is committed to making participation in the event a harassment free experience for
                    everyone, regardless of level of experience, gender, gender identity and expression</p>
            </div>
            <div class="speaker--slider text-center" id="carousel_5">

                <div class="speaker-slider6 owl-carousel owl-theme owl-loaded owl-drag">

                    <div class="speaker-item1 card">
                        <div class="speaker-thumb card-header">
                            <a href="https://gigniter.digitalpoin8.com/index.php/gigs/detail?gig=95">
                                <img src="https://gigniter.digitalpoin8.com/downloads/posters/thumb/1622531420concert.jpg" style="max-width: 360px; max-height: 354px;">
                                <span class="badge badge-danger exclusive-badge">exclusive</span>
                            </a>
                        </div>
                        <div class="speaker-content card-footer">
                            <h5 class="limit-single-line">Jazz Concert</h5>
                            <div class="d-flex">
                                <div class="footer-text">
                                    <h6>john smith</h6>
                                    <p>15 Jun 2021</p>
                                    <p><span class="mr-2"><img src="https://gigniter.digitalpoin8.com/frontend_assets/images/icons/ticket.png"></span>200 tickets left</p>
                                    <p class="mb-3"><span class="mr-2"><img src="https://gigniter.digitalpoin8.com/frontend_assets/images/icons/calender.png"></span>5 days left</p>
                                </div>
                                <div class="circlebar">
                                    <div class="pie_progress booked-color-2" role="progressbar" data-goal="0" aria-valuenow="0">
                                        <div class="pie_progress__number">0%</div>
                                        <div class="pie_progress__label">Booked</div>

                                    </div>
                                </div>

                            </div>
                            <div class="d-flex">
                                <a type="button" class="btn btn-warning btn-watch mb-4" href="https://gigniter.digitalpoin8.com/index.php/cart/book_tier/95">book now</a>
                                <a href="https://gigniter.digitalpoin8.com/index.php/gigs/detail?gig=95" type="button" class="btn btn-warning btn-view mb-4">view</a>
                            </div>
                        </div>
                    </div>



                    <div class="speaker-item1 card">
                        <div class="speaker-thumb card-header">
                            <a href="https://gigniter.digitalpoin8.com/index.php/gigs/detail?gig=95">
                                <img src="https://gigniter.digitalpoin8.com/downloads/posters/thumb/1622531420concert.jpg" style="max-width: 360px; max-height: 354px;">
                                <span class="badge badge-danger exclusive-badge">exclusive</span>
                            </a>
                        </div>
                        <div class="speaker-content card-footer">
                            <h5 class="limit-single-line">POP Concert</h5>
                            <div class="d-flex">
                                <div class="footer-text">
                                    <h6>john smith</h6>
                                    <p>15 Jun 2021</p>
                                    <p><span class="mr-2"><img src="https://gigniter.digitalpoin8.com/frontend_assets/images/icons/ticket.png"></span>200 tickets left</p>
                                    <p class="mb-3"><span class="mr-2"><img src="https://gigniter.digitalpoin8.com/frontend_assets/images/icons/calender.png"></span>5 days left</p>
                                </div>
                                <div class="circlebar">
                                    <div class="pie_progress booked-color-2" role="progressbar" data-goal="0" aria-valuenow="0">
                                        <div class="pie_progress__number">0%</div>
                                        <div class="pie_progress__label">Booked</div>

                                    </div>
                                </div>

                            </div>
                            <div class="d-flex">
                                <a type="button" class="btn btn-warning btn-watch mb-4" href="https://gigniter.digitalpoin8.com/index.php/cart/book_tier/95">book now</a>
                                <a href="https://gigniter.digitalpoin8.com/index.php/gigs/detail?gig=95" type="button" class="btn btn-warning btn-view mb-4">view</a>
                            </div>
                        </div>
                    </div>



                    <div class="speaker-item1 card">
                        <div class="speaker-thumb card-header">
                            <a href="https://gigniter.digitalpoin8.com/index.php/gigs/detail?gig=95">
                                <img src="https://gigniter.digitalpoin8.com/downloads/posters/thumb/1622531420concert.jpg" style="max-width: 360px; max-height: 354px;">
                                <span class="badge badge-danger exclusive-badge">exclusive</span>
                            </a>
                        </div>
                        <div class="speaker-content card-footer">
                            <h5 class="limit-single-line">Music Concert</h5>
                            <div class="d-flex">
                                <div class="footer-text">
                                    <h6>john smith</h6>
                                    <p>15 Jun 2021</p>
                                    <p><span class="mr-2"><img src="https://gigniter.digitalpoin8.com/frontend_assets/images/icons/ticket.png"></span>200 tickets left</p>
                                    <p class="mb-3"><span class="mr-2"><img src="https://gigniter.digitalpoin8.com/frontend_assets/images/icons/calender.png"></span>5 days left</p>
                                </div>
                                <div class="circlebar">
                                    <div class="pie_progress booked-color-2" role="progressbar" data-goal="0" aria-valuenow="0">
                                        <div class="pie_progress__number">0%</div>
                                        <div class="pie_progress__label">Booked</div>

                                    </div>
                                </div>

                            </div>
                            <div class="d-flex">
                                <a type="button" class="btn btn-warning btn-watch mb-4" href="https://gigniter.digitalpoin8.com/index.php/cart/book_tier/95">book now</a>
                                <a href="https://gigniter.digitalpoin8.com/index.php/gigs/detail?gig=95" type="button" class="btn btn-warning btn-view mb-4">view</a>
                            </div>
                        </div>
                    </div>
                    <div class="speaker-item1 card">
                        <div class="speaker-thumb card-header">
                            <a href="https://gigniter.digitalpoin8.com/index.php/gigs/detail?gig=95">
                                <img src="https://gigniter.digitalpoin8.com/downloads/posters/thumb/1622531420concert.jpg" style="max-width: 360px; max-height: 354px;">
                                <span class="badge badge-danger exclusive-badge">exclusive</span>
                            </a>
                        </div>
                        <div class="speaker-content card-footer">
                            <h5 class="limit-single-line">Music Concert</h5>
                            <div class="d-flex">
                                <div class="footer-text">
                                    <h6>john smith</h6>
                                    <p>15 Jun 2021</p>
                                    <p><span class="mr-2"><img src="https://gigniter.digitalpoin8.com/frontend_assets/images/icons/ticket.png"></span>200 tickets left</p>
                                    <p class="mb-3"><span class="mr-2"><img src="https://gigniter.digitalpoin8.com/frontend_assets/images/icons/calender.png"></span>5 days left</p>
                                </div>
                                <div class="circlebar">
                                    <div class="pie_progress booked-color-2" role="progressbar" data-goal="0" aria-valuenow="0">
                                        <div class="pie_progress__number">0%</div>
                                        <div class="pie_progress__label">Booked</div>

                                    </div>
                                </div>

                            </div>
                            <div class="d-flex">
                                <a type="button" class="btn btn-warning btn-watch mb-4" href="https://gigniter.digitalpoin8.com/index.php/cart/book_tier/95">book now</a>
                                <a href="https://gigniter.digitalpoin8.com/index.php/gigs/detail?gig=95" type="button" class="btn btn-warning btn-view mb-4">view</a>
                            </div>
                        </div>
                    </div>



                </div>

            </div>
        </div>
    </section>



    <?php $this->load->view('frontend/layout/newsletter_footer'); ?>
    <?php $this->load->view('frontend/layout/scripts'); ?>
    <script>
        $(document).ready(function() {

            $('.speaker-prev, .speaker-next').on('mouseover', function() {
                console.log($(this).parent().children('.owl-carousel'));
                $(this).parent().children('.owl-carousel').trigger('stop.owl.autoplay');
            });
            $('.speaker-prev, .speaker-next').on('mouseleave', function() {
                console.log($(this).parent().children('.owl-carousel'));
                $(this).parent().children('.owl-carousel').trigger('play.owl.autoplay');
            });
        });

        $('.speaker-slider6').owlCarousel({
            rewind: true,
            autoplay: true,
            dots: false,
            nav: true,
            autoplayTimeout: 2000,
            margin: 30,
            autoplayHoverPause: true,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 1,
                    loop: ($(this).find('.owl-item')).length > 0
                },
                600: {
                    items: 3,
                    loop: ($(this).find('.owl-item')).length > 0
                },
                1000: {
                    items: 3,
                    loop: ($(this).find('.owl-item')).length > 0
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