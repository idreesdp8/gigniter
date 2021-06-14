<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('frontend/layout/meta_tags'); ?>
    <title>Gigniter - Online Ticket Booking Website HTML Template</title>
    <style>
        .poster_image {
            max-width: 343px;
            max-height: 435px;
        }

        .explore_image_holder {
            overflow: hidden;
        }

        .explore_image_holder img {
            height: 100%;
            /* margin: 0 -50%; */
        }

        .btn-white {
            background: #fff;
            color: #000;
            border: 1px solid #fff;
            border-radius: 0;
            width: auto;
            height: auto;
            padding: 7px 25px;
            text-transform: uppercase;
        }
        .content-bar select {
            margin: 0 !important;
            width: 100% !important;
        }
    </style>
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
                        <div class="row">
                            <div class="col">
                                <span>Genre:</span>
                                <select class="genre-select" id="genre">
                                    <option value="">Select Genre</option>
                                    <?php
                                    foreach ($genres as $genre) :
                                    ?>
                                        <option value="<?php echo $genre->value ?>"><?php echo $genre->label ?></option>
                                    <?php
                                    endforeach;
                                    ?>
                                </select>
                            </div>
                            <div class="col">
                                <span>Category:</span>
                                <select class="category-select" id="category">
                                    <option value="">Select Category</option>
                                    <?php
                                    foreach ($categories as $category) :
                                    ?>
                                        <option value="<?php echo $category->value ?>"><?php echo $category->label ?></option>
                                    <?php
                                    endforeach;
                                    ?>
                                </select>
                            </div>
                            <div class="col">
                                <span>Show:</span>
                                <select class="show-select" id="limit">
                                    <option value="10" active>10</option>
                                    <option value="20">20</option>
                                    <option value="50">50</option>
                                </select>
                            </div>
                            <div class="col">
                                <span>Sort By:</span>
                                <select class="sort-select" id="sort">
                                    <option value="">Select Option</option>
                                    <option value="most_popular">Most Popular</option>
                                    <option value="just_in">Just In</option>
                                    <option value="closing_soon">Closing Soon</option>
                                </select>
                            </div>
                            <div class="col">
                                <span>Live Shows:</span>
                                <select class="sort-select" id="live">
                                    <option value="">Select Option</option>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                        </div>


                    </div>

                    <div id="grid_view" class="col-lg-12 col-md-12 col-sm-12 col-12">
                        <?php $this->load->view('frontend/gigs/partial_explore_grid'); ?>
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
            // $('#explore_menu').addClass('active');
            // $('.list-view').addClass("active");
            // $('#grid_view').hide();

            // $('#list-btn').click(function(event) {
            //     $('.grid-view').removeClass("active");
            //     $('.list-view').addClass("active");
            //     $('#grid_view').hide();
            //     $('#list_view').show();
            // });

            // $('#grid-btn').click(function(event) {
            //     $('.grid-view').addClass("active");
            //     $('.list-view').removeClass("active");
            //     $('#grid_view').show();
            //     $('#list_view').hide();
            // });

            $('#category').change(function() {
                filter_gigs();
            });
            $('#genre').change(function() {
                filter_gigs();
            });
            $('#sort').change(function() {
                filter_gigs();
            });
        });

        function filter_gigs() {
            var cat = $('#category').val();
            var gen = $('#genre').val();
            var sort = $('#sort').val();
            $.ajax({
                url: base_url + 'gigs/filter_gig',
                method: 'post',
                data: {
                    'category': cat,
                    'genre': gen,
                    'sort': sort,
                },
                dataType: 'json',
                success: function(result) {
                    if (result.grid && result.list) {
                        $('#grid_view').empty();
                        $('#grid_view').html(result.grid);
                    } else {
                        $('#grid_view').empty();
                        $('#grid_view').html('<div>No Record Found</div>');
                    }
                }
            });
        }
    </script>
</body>

</html>