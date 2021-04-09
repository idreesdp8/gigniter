<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('frontend/layout/meta_tags'); ?>
    <title>Gigniter - Online Ticket Booking Website HTML Template</title>
    <style>
        #grid_view {
            margin-top: 3rem;
        }

        input[type="text"],select {
            color: black;
            padding: 5px !important;
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
                <h2 class="exlpore-title">My<span class="explore-animated-title"> SHOWS</span></h2>
                <h5 class="explore-subtitle">Buy movie tickets in advance, find movie times watch trailer, read movie reviews and much more</h5>
            </div>
        </div>

    </section>
    <!-- ==========Banner-Section========== -->

    <!-- ==========Explore-content-Section========== -->
    <section class="Explore-content">
        <div class="container">
            <div class="row">
                <div id="grid_view" class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <?php $this->load->view('alert/alert'); ?>
                    <!-- <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12"></div>
                        <div class="col-lg-3 col-md-3 col-sm-12 col-12 mb-4">
                            Status: <select id="status">
                                <option value="">Choose Status</option>
                                <option value="">All</option>
                                <option value="live">Live</option>
                                <option value="completed">Past</option>
                                <option value="upcoming">Upcoming</option>
                            </select>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12 col-12 mb-4">
                            Search: <input type="text" id="search">
                        </div>
                    </div> -->
                    <div id="partial_view">
                        <?php $this->load->view('frontend/live/partial_my_shows'); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ==========Explore-content-Section========== -->
    <!-- /page content -->

    <?php $this->load->view('frontend/layout/footer'); ?>
    <?php $this->load->view('frontend/layout/scripts'); ?>
    <script>
        $(document).ready(function() {
            // $('#explore_menu').addClass('active');

            $('#status').change(function() {
                filter_gigs();
            });
            var timer;
            $('#search').keyup(function() {
                clearTimeout(timer);
                var ms = 1000;
                timer = setTimeout(function() {
                    filter_gigs();
                }, ms);
            });
        });

        function filter_gigs() {
            var status = $('#status').val();
            var search = $('#search').val();
            // console.log(status);
            // console.log(search);
            $.ajax({
                url: base_url + 'gigs/filter_my_shows',
                method: 'post',
                data: {
                    'status': status,
                    'search': search,
                },
                // dataType: 'json',
                success: function(result) {
                    console.log(result);
                    $('#partial_view').empty();
                    // var parseHTML = $.parseHTML(result);
                    $('#partial_view').html(result);
                    // if(result.status) {
                    // } else {
                    //     $('#partial_view').empty();
                    //     $('#partial_view').html('No record found!');
                    // }
                }
            });
        }
    </script>
</body>

</html>