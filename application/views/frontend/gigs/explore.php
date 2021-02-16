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
    <section class="explore-banner-section bg_img" data-background="<?php echo user_asset_url(); ?>images/banner/banner-2.png">
        <div class="container">
            <div class="text-box text-center">
                <h2 class="exlpore-title">EXPLORE MORE<span class="explore-animated-title"> GIGS</span></h2>
                <h5 class="explore-subtitle">Buy movie tickets in advance, find movie times watch trailer, read movie reviews and much more</h5>
            </div>
        </div>

    </section>
    <!-- ==========Banner-Section========== -->

    <!-- ==========Explore-content-Section========== -->
    <section class="Explore-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="content-bar">
                        <p>Show:
                            <select class="show-select">
                                <option value="1" active>1</option>
                                <option value="2">2</option>
                            </select>
                        </p>
                        <p>Sort By:
                            <select class="sort-select">
                                <option value="1" active>Most Popular</option>
                                <option value="2">2</option>
                            </select>
                        </p>

                        <div class="view d-flex ml-auto">
                            <button id="grid-btn" class="grid-view"><img src="<?php echo user_asset_url(); ?>images/icons/grid-view.png"></button>
                            <button id="list-btn" class="list-view"><img src="<?php echo user_asset_url(); ?>images/icons/list-view.png"></button>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                            <div class="language-box">
                                <h3>language</h3>
                                <div class="grid">
                                    <div class="custom-form bg">
                                        <div class="checkbox-contain">
                                            <div class="chiller_cb">
                                                <input id="myCheckbox" type="checkbox" checked>
                                                <label for="myCheckbox">Tamil</label>
                                                <span></span>
                                            </div>
                                            <div class="chiller_cb">
                                                <input id="myCheckbox2" type="checkbox">
                                                <label for="myCheckbox2">telegu</label>
                                                <span></span>
                                            </div>
                                            <div class="chiller_cb">
                                                <input id="myCheckbox3" type="checkbox">
                                                <label for="myCheckbox3">hindi</label>
                                                <span></span>
                                            </div>
                                            <div class="chiller_cb">
                                                <input id="myCheckbox4" type="checkbox">
                                                <label for="myCheckbox4">enlish</label>
                                                <span></span>
                                            </div>
                                            <div class="chiller_cb">
                                                <input id="myCheckbox5" type="checkbox">
                                                <label for="myCheckbox5">multiple languages</label>
                                                <span></span>
                                            </div>
                                            <div class="chiller_cb">
                                                <input id="myCheckbox6" type="checkbox">
                                                <label for="myCheckbox6">gujrati</label>
                                                <span></span>
                                            </div>
                                            <div class="chiller_cb">
                                                <input id="myCheckbox7" type="checkbox">
                                                <label for="myCheckbox7">bangali</label>
                                                <span></span>
                                            </div>

                                        </div>
                                    </div>
                                    <a href="#" class="explore-view-btn">View more <span class="float-right"><img src="<?php echo user_asset_url(); ?>images/icons/plus.png"></span></a>
                                </div>
                            </div>

                            <div class="experience-box">
                                <h3>Experience</h3>
                                <div class="grid">
                                    <div class="custom-form bg">
                                        <div class="checkbox-contain">
                                            <div class="chiller_cb">
                                                <input id="myCheckbox8" type="checkbox" checked>
                                                <label for="myCheckbox8">thriller</label>
                                                <span></span>
                                            </div>
                                            <div class="chiller_cb">
                                                <input id="myCheckbox9" type="checkbox">
                                                <label for="myCheckbox9">horror</label>
                                                <span></span>
                                            </div>
                                            <div class="chiller_cb">
                                                <input id="myCheckbox10" type="checkbox">
                                                <label for="myCheckbox10">drama</label>
                                                <span></span>
                                            </div>
                                            <div class="chiller_cb">
                                                <input id="myCheckbox11" type="checkbox">
                                                <label for="myCheckbox11">romance</label>
                                                <span></span>
                                            </div>
                                            <div class="chiller_cb">
                                                <input id="myCheckbox12" type="checkbox">
                                                <label for="myCheckbox12">action</label>
                                                <span></span>
                                            </div>
                                            <div class="chiller_cb">
                                                <input id="myCheckbox13" type="checkbox">
                                                <label for="myCheckbox13">comedy</label>
                                                <span></span>
                                            </div>
                                            <div class="chiller_cb">
                                                <input id="myCheckbox14" type="checkbox">
                                                <label for="myCheckbox14">romantic</label>
                                                <span></span>
                                            </div>

                                        </div>
                                    </div>
                                    <a href="#" class="explore-view-btn">View more <span class="float-right"><img src="<?php echo user_asset_url(); ?>images/icons/plus.png"></span></a>
                                </div>
                            </div>


                        </div>

                        <div id="list_view" class="col-lg-9 col-md-9 col-sm-12 col-12">
                            <?php
                            if ($gigs) :
                                foreach ($gigs as $gig) :
                            ?>
                                    <div class="card explore-card">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                                                <img class="explore-img" src="<?php echo user_asset_url(); ?>images/explore/card-img01.png">
                                            </div>
                                            <div class="col-lg-8 col-md-8 col-sm-12 col-12">
                                                <h5><?php echo $gig->title ?></h5>
                                                <h6><?php echo $gig->user_name ?></h6>
                                                <p>Music <span>|</span> Show <span>|</span> English</p>
                                                <p class="explore-margin-bottom">Release Date <span>: </span><?php echo date('d M Y', strtotime($gig->gig_date)) ?></p>

                                                <span class="badge badge-danger booked-badge"><?php echo $gig->booked ?>% Booked</span>
                                                <p><span class="mr-2 m-b-4"><img src="<?php echo user_asset_url(); ?>images/icons/ticket.png"></span><?php echo $gig->ticket_left ?> tickets left</p>
                                                <div class="custom-border">
                                                    <button class="btn btn-warning btn-booked">Book Now</button>
                                                    <p class="remaining-days"><span class="mr-2 m-b-4"><img src="<?php echo user_asset_url(); ?>images/icons/calender.png"></span><?php echo abs($gig->days_left) > 0 ? abs($gig->days_left) . ' days left' : 'Today' ?></p>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                            <?php
                                endforeach;
                            endif;
                            ?>
                        </div>

                        <div id="grid_view" class="col-lg-9 col-md-9 col-sm-12 col-12">
                            <?php
                            if ($gigs) :
                            ?>
                                <div class="row">
                                    <?php
                                    foreach ($gigs as $gig) :
                                    ?>
                                        <div class="col-md-4">
                                            <div class="card grid-card" style="background: transparent;">
                                                <div class="card-header p-0">
                                                    <img src="<?php echo user_asset_url(); ?>images/home/slider-02/card-img01.png" class="w-100">
                                                </div>
                                                <div class="card-footer grid-footer">
                                                    <div class="d-flex">
                                                        <div class="footer-text">
                                                            <h5><?php echo $gig->title ?></h5>
                                                            <h6><?php echo $gig->user_name ?></h6>
                                                            <p><?php echo date('d M Y', strtotime($gig->gig_date)) ?></p>
                                                            <p><span class="mr-2"><img src="<?php echo user_asset_url(); ?>images/icons/ticket.png"></span><?php echo $gig->ticket_left ?> tickets left</p>
                                                            <p class="mb-3"><span class="mr-2"><img src="<?php echo user_asset_url(); ?>images/icons/calender.png"></span><?php echo abs($gig->days_left) > 0 ? abs($gig->days_left) . ' days left' : 'Today' ?></p>
                                                        </div>
                                                        <div class="circlebar">
                                                            <div class="pie_progress3 booked-color-3" role="progressbar" data-goal="<?php echo $gig->booked ?>">
                                                                <div class="pie_progress__number"><?php echo $gig->booked ?>%</div>
                                                                <div class="pie_progress__label">Booked</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <button class="btn btn-warning btn-watch mb-4">book now</button>
                                                    <button class="btn btn-warning btn-view mb-4">view</button>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    endforeach;
                                    ?>
                                </div>
                            <?php
                            endif;
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ==========Explore-content-Section========== -->
    <!-- /page content -->

    <?php $this->load->view('frontend/layout/newsletter_footer'); ?>
    <?php $this->load->view('frontend/layout/scripts'); ?>
    <script>
        $(document).ready(function() {
            $('#explore_menu').addClass('active');
            $('.list-view').addClass("active");
            $('#grid_view').hide();

            $('#list-btn').click(function(event) {
                $('.grid-view').removeClass("active");
                $('.list-view').addClass("active");
                $('#grid_view').hide();
                $('#list_view').show();
            });

            $('#grid-btn').click(function(event) {
                $('.grid-view').addClass("active");
                $('.list-view').removeClass("active");
                $('#grid_view').show();
                $('#list_view').hide();
            });
        });
    </script>
</body>

</html>