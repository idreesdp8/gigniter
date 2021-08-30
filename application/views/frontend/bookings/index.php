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
                <h2 class="exlpore-title">My Bookings</h2>
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
                    <div class="table-responsive checkout-widget checkout-contact">
                        <h5 class="title">Bookings </h5>
                        <?php
                        if ($bookings) :
                        ?>
                            <table class="table text-white table-striped custom-table-mobile">
                                <thead>
                                    <tr>
                                        <th>Order #</th>
                                        <th>Amount</th>
                                        <th>Gig Name</th>
                                        <th>Ticket(s)</th>
                                        <th>Status</th>
                                        <th>Purchase Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($bookings as $booking) :
                                    ?>
                                        <tr>
                                            <td><?php echo $booking->booking_no ?></td>
                                            <td><?php echo '$'.number_format($booking->price, 2, '.', ',');  ?></td>
                                            <td>
                                                <a class="theme-primary-color" href="<?php echo user_base_url() . 'gigs/detail?gig=' . $booking->gig_id ?>" target="_blank">
                                                <?php echo $booking->gig_name ?>
                                            </a>
                                        </td>
                                        <td><?php echo $booking->ticket_names ?></td>
                                        <td>
                                            <?php
                                                if ($booking->is_paid == 0)
                                                echo '<span class="bundle-pill pill-warning">On Hold</span>';
                                                if ($booking->is_paid == 1)
                                                echo '<span class="bundle-pill pill-success">Paid</span>';
                                                if ($booking->is_paid == 2)
                                                echo '<span class="bundle-pill pill-danger">Cancelled</span>';
                                                // echo $booking->is_paid ? 'Paid' : 'Pending'
                                                ?>
                                            </td>
                                            <td><?php echo date('M d, Y', strtotime($booking->created_on)) ?></td>
                                            <td>
                                                <a href="<?php echo user_base_url() . 'bookings/show/' . $booking->id ?>" type="button" data-toggle="tooltip" data-placement="top" title="View order detail" class="btn btn-info mob-responsive"><i class="fa fa-eye"></i></a>
                                                <?php
                                                if ($booking->is_paid == 0 && $booking->hours > 48) :
                                                ?>
                                                    <a href="javascript:void(0);" onclick="operate_booking_deletion('<?php echo $booking->id; ?>');" type="button" data-toggle="tooltip" data-placement="top" title="Cancel order" class="btn btn-danger mob-responsive"><i class="fa fa-times"></i></a>
                                                <?php
                                                endif;
                                                ?>
                                                <?php
                                                if ($booking->is_paid == 0 && $booking->hours < 48) :
                                                ?>
                                                    <a href="<?php echo user_base_url().'bookings/amend_order/'.$booking->id; ?>" type="button" data-toggle="tooltip" data-placement="top" title="Amend order" class="btn btn-warning mob-responsive"><i class="fa fa-cog"></i></a>
                                                <?php
                                                endif;
                                                ?>
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
                            <div>You do not have any bookings.</div>
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
		function operate_booking_deletion(del_id){
			$( document ).ready(function() {
				swal({
					title: "Do you want to Cancel this Booking?",
					icon: "warning",
					buttons: true,
					dangerMode: true, 
				}).then((willDelete) => {
					if (willDelete) { 
						window.location = "<?php echo user_base_url().'bookings/cancel_booking/'; ?>" + del_id; 
					} else {
						swal({
							icon: 'info',
							title: 'Your booking is safe!',
						}); 
					}
				}); 
			});  
		}
    </script>
</body>
</html>