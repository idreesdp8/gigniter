<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('frontend/layout/meta_tags'); ?>
    <title>Gigniter - Online Ticket Booking Website HTML Template</title>
    <style>
        td,
        th {
            color: #fff;
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
                <div class="col-lg-12 col-md-12 col-sm-12 col-12 mt-4">
                    <?php $this->load->view('alert/alert'); ?>
                    <?php
                    if ($gigs) :
                    ?>
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Genre</th>
                                    <th>Goal</th>
                                    <th>Featured</th>
                                    <th>Campaign Date</th>
                                    <th>Gig Date</th>
                                    <th>Start Time</th>
                                    <th>End Time</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($gigs as $gig) :
                                ?>
                                    <tr>
                                        <td><?php echo $gig->title ?></td>
                                        <td><?php echo $gig->category_name ?></td>
                                        <td><?php echo $gig->genre_name ?></td>
                                        <td><?php echo $gig->goal ?></td>
                                        <td><?php echo $gig->is_featured ? 'Yes' : 'No' ?></td>
                                        <td><?php echo date('M d Y', strtotime($gig->campaign_date)) ?></td>
                                        <td><?php echo date('M d Y', strtotime($gig->gig_date)) ?></td>
                                        <td><?php echo date('h:i a', strtotime($gig->start_time)) ?></td>
                                        <td><?php echo date('h:i a', strtotime($gig->end_time)) ?></td>
                                        <td>
                                            <?php
                                            if ($gig->status == 0) {
                                                echo 'Inactive';
                                            } else if ($gig->status == 1) {
                                                echo 'Active';
                                            } else if ($gig->status == 2) {
                                                echo 'Live';
                                            } else {
                                                echo 'Completed';
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="<?php echo user_base_url() ?>gigs/update/<?php echo $gig->id ?>" type="button" class="btn btn-primary ml-2"><i class="fas fa-pen"></i></a>
                                                <form action="<?php echo user_base_url() ?>gigs/trash/<?php echo $gig->id ?>">
                                                    <button type="submit" class="btn btn-danger ml-2"><i class="fas fa-trash"></i></button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                <?php
                                endforeach;
                                ?>
                            </tbody>
                        </table>
                    <?php
                    else :
                    ?>
                        No Record Found
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