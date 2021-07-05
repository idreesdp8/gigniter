<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('frontend/layout/meta_tags'); ?>
    <title>Gigniter - Online Ticket Booking Service</title>
    <style>
        .exlpore-title,
        .explore-subtitle {
            text-transform: uppercase;
        }

        /* input[type="text"],
        input[type="number"] {
            color: black;
            padding: 5px !important;
        } */
    </style>
</head>

<body>
    <?php $this->load->view('frontend/layout/preloader'); ?>
    <?php $this->load->view('frontend/layout/header'); ?>
    <!-- Page content -->
    <!-- ==========Banner-Section========== -->
    <section class="explore-banner-section bg_img" data-background="<?php echo user_asset_url(); ?>images/banner/banner-3.png">
        <div class="container">
            <div class="text-box text-center">
                <h2 class="exlpore-title">Payment History</h2>
                <!-- <h5 class="explore-subtitle"><?php echo $gig->address ?? 'Test Address' ?></h5> -->
            </div>
        </div>
    </section>
    <!-- ==========Banner-Section========== -->

    <!-- ==========Explore-content-Section========== -->
    <div class="event-facility padding-bottom padding-top">
        <div class="container">
            <?php $this->load->view('alert/alert'); ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="checkout-widget checkout-contact">
                        <h5 class="title">Payments </h5>
                        <?php
                        if ($gigs) :
                        ?>
                            <table class="table text-white table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Gig Title</th>
                                        <th>Tickets Quantity</th>
                                        <th>Gig Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($gigs as $key => $value) :
                                    ?>
                                        <tr>
                                            <td><?php echo $key+1 ?></td>
                                            <td><?php echo $value->title ?></td>
                                            <td><?php echo $value->ticket_limit  ?></td>
                                            <td><?php echo date('M d, Y H:i A', strtotime($value->gig_date)) ?></td>
                                            <td><?php echo $value->status_label ?></td>
                                            <td>
                                                <a href="<?php echo user_base_url() . 'transactions/show/' . $value->id ?>" type="button" class="btn btn-info"><i class="fa fa-eye"></i></a>
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
                            <div>No record found.</div>
                        <?php
                        endif;
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ==========Explore-content-Section========== -->
    <!-- /page content -->

    <?php $this->load->view('frontend/layout/footer'); ?>
    <?php $this->load->view('frontend/layout/scripts'); ?>
    <script>
    </script>
</body>

</html>