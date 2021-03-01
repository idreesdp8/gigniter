<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('frontend/layout/meta_tags'); ?>
    <title>Gigniter - Online Ticket Booking Website HTML Template</title>
    <style>
        #grid_view {
            margin-top: 3rem;
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
                <h2 class="exlpore-title">My<span class="explore-animated-title"> GIGS</span></h2>
                <h5 class="explore-subtitle">Buy movie tickets in advance, find movie times watch trailer, read movie reviews and much more</h5>
            </div>
        </div>

    </section>
    <!-- ==========Banner-Section========== -->

    <!-- ==========Explore-content-Section========== -->
    <section class="Explore-content">
        <div class="container">
            <div class="row">
                <?php $this->load->view('alert/alert'); ?>
                <div id="grid_view" class="col-lg-12 col-md-12 col-sm-12 col-12">
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
                                            <img src="<?php echo $gig->poster ? poster_thumbnail_url() . $gig->poster : user_asset_url() . 'images/home/slider-02/card-img01.png' ?>" style="width: 358px; height: 352px;" class="w-100">
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
                                            <a href="<?php echo user_base_url() ?>gigs/update/<?php echo $gig->id ?>" class="btn btn-warning btn-view mb-4">edit</a>
                                            <form action="<?php echo user_base_url() ?>gigs/trash/<?php echo $gig->id ?>">
                                                <button type="submit" class="btn btn-warning btn-watch mb-4">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            endforeach;
                            ?>
                        </div>
                    <?php
                    else :
                    ?>
                        <div>No record found</div>
                    <?php
                    endif;
                    ?>
                </div>
            </div>
        </div>
    </section>

    <!-- ==========Explore-content-Section========== -->
    <!-- /page content -->

    <?php $this->load->view('frontend/layout/footer'); ?>
    <?php $this->load->view('frontend/layout/scripts'); ?>
    <script>
        const base_url = '<?php echo user_base_url(); ?>';
        $(document).ready(function() {
            // $('#explore_menu').addClass('active');

            // $('#category').change(function() {
            //     filter_gigs();
            // });
            // $('#genre').change(function() {
            //     filter_gigs();
            // });
        });

        // function filter_gigs() {
        //     var cat = $('#category').val();
        //     var gen = $('#genre').val();
        //     $.ajax({
        //         url: base_url + 'gigs/filter_gig',
        //         method: 'post',
        //         data: {
        //             'category': cat,
        //             'genre': gen,
        //         },
        //         dataType: 'json',
        //         success: function(result) {
        //             if(result.grid && result.list) {
        //                 $('#list_view').empty();
        //                 $('#grid_view').empty();
        //                 $('#list_view').html(result.list);
        //                 $('#grid_view').html(result.grid);
        //             } else {
        //                 $('#list_view').empty();
        //                 $('#grid_view').empty();
        //                 $('#list_view').html('<div>No Record Found</div>');
        //                 $('#grid_view').html('<div>No Record Found</div>');
        //             }
        //         }
        //     });
        // }
    </script>
</body>

</html>