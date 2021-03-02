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
            margin: 0 -50%;
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
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="language-box">
                                        <h3>Category</h3>
                                        <!-- class="select-bar" -->
                                        <select class="category-genre-select" id="category">
                                            <option value="">Select Category</option>
                                            <?php
                                            foreach ($categories as $category) :
                                            ?>
                                                <option value="<?php echo $category->value ?>"><?php echo $category->label ?></option>
                                            <?php
                                            endforeach;
                                            ?>
                                        </select>
                                        <!-- <div class="grid">
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
                                        </div> -->
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="experience-box">
                                        <h3>Genre</h3>
                                        <select class="category-genre-select" id="genre">
                                            <option value="">Select Genre</option>
                                            <?php
                                            foreach ($genres as $genre) :
                                            ?>
                                                <option value="<?php echo $genre->value ?>"><?php echo $genre->label ?></option>
                                            <?php
                                            endforeach;
                                            ?>
                                        </select>
                                        <!-- <div class="grid">
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
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="list_view" class="col-lg-12 col-md-12 col-sm-12 col-12">
                            <?php $this->load->view('frontend/gigs/partial_explore_list'); ?>
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

    <?php $this->load->view('frontend/gigs/book_now'); ?>
    <?php $this->load->view('frontend/layout/newsletter_footer'); ?>
    <?php $this->load->view('frontend/layout/scripts'); ?>
    <script>
        const base_url = '<?php echo user_base_url(); ?>';
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

            $('#category').change(function() {
                filter_gigs();
            });
            $('#genre').change(function() {
                filter_gigs();
            });

            function get_gig_book_now_data(id) {
                $.ajax({
                    url: base_url + 'gigs/get_gig_book_now_data',
                    data: {
                        id: id
                    },
                    method: 'POST',
                    dataType: 'json',
                    success: function(response) {
                        $('#gig_id').val(id);
                        $('#book_now_tier').empty();
                        $('#book_now_tier').append('<option value="">Choose Tier</option>')
                        $(response).each(function(index, value) {
                            $('#book_now_tier').append('<option value="' + value.id + '">' + value.name +' ($' + value.price +')</option>')
                        });
                    }
                });
            }
            $('.show_modal').click(function() {
                var id = $(this).attr('data-id');
                get_gig_book_now_data(id);
            });
        });

        function filter_gigs() {
            var cat = $('#category').val();
            var gen = $('#genre').val();
            $.ajax({
                url: base_url + 'gigs/filter_gig',
                method: 'post',
                data: {
                    'category': cat,
                    'genre': gen,
                },
                dataType: 'json',
                success: function(result) {
                    if (result.grid && result.list) {
                        $('#list_view').empty();
                        $('#grid_view').empty();
                        $('#list_view').html(result.list);
                        $('#grid_view').html(result.grid);
                    } else {
                        $('#list_view').empty();
                        $('#grid_view').empty();
                        $('#list_view').html('<div>No Record Found</div>');
                        $('#grid_view').html('<div>No Record Found</div>');
                    }
                }
            });
        }
    </script>
</body>

</html>