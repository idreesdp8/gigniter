<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('frontend/layout/meta_tags'); ?>
    <title>Gigniter - Online Ticket Booking Website HTML Template</title>
    <style>
        .exlpore-title,
        .explore-subtitle {
            text-transform: uppercase;
        }

        .card {
            background-color: #11326f;
            box-shadow: 0 4px 8px 0 #061332ab;
        }

        .ticket_info {
            display: flex;
            justify-content: space-between;
        }

        .modal-title {
            width: 100%;
        }

        .close {
            color: red;
            width: auto;
            text-shadow: none;
            opacity: 1;
        }

        .friend-input {
            margin: 10px;
        }
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
                <h2 class="exlpore-title">Order Details</h2>
                <h5 class="explore-subtitle">Order #: <?php echo $booking->booking_no ?? '' ?></h5>
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
                        <h5 class="title">Order Details
                            <?php
                            if ($booking->is_paid == 0) :
                            ?>
                                <a type="button" class="btn btn-danger ml-2 float-right" href="<?php echo user_base_url() . 'bookings/cancel_booking/' . $booking->id; ?>">Cancel Order</a>
                            <?php
                            endif;
                            ?>
                        </h5>
                        <div class="row">
                            <div class="col-lg-9">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <h6>Order #</h6>
                                        <p><?php echo $booking->booking_no ?></p>
                                    </div>
                                    <div class="col-lg-4">
                                        <h6>Customer Name</h6>
                                        <p><?php echo $booking->customer->fname . ' ' . $booking->customer->lname ?></p>
                                    </div>
                                    <!-- <div class="col-lg-4">
                                        <h6>Customer Stripe #</h6>
                                        <p><?php echo $booking->customer_stripe_id ?? 'NA' ?></p>
                                    </div> -->
                                    <div class="col-lg-4">
                                        <h6>Total Amount</h6>
                                        <p>$<?php echo $booking->price ?></p>
                                    </div>
                                    <div class="col-lg-4">
                                        <h6>Status</h6>
                                        <p>
                                            <?php
                                            if ($booking->is_paid == 0)
                                                echo 'On Hold';
                                            if ($booking->is_paid == 1)
                                                echo 'Paid';
                                            if ($booking->is_paid == 2)
                                                echo 'Cancelled';
                                            ?>
                                        </p>
                                    </div>
                                    <div class="col-lg-4">
                                        <h6>Payment Date</h6>
                                        <p><?php echo date('M d, Y', strtotime($booking->created_on)) ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="circlebar">
                                            <div class="pie_progress3 booked-color-3" role="progressbar" data-goal="<?php echo $gig->booked ?>">
                                                <div class="pie_progress__number"><?php echo $gig->booked ?>%</div>
                                                <div class="pie_progress__label">Booked</div>
                                            </div>
                                            <div>
                                                <?php if ($gig->ticket_left < 1) : ?>
                                                    <p class="text-success">Gig is Activated</p>
                                                <?php else : ?>
                                                    <p class="text-warning"><?php echo $gig->ticket_left ?> spots left to activate the gig</p>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <h6>Tickets</h6>
                            </div>
                            <br>
                            <?php
                            if ($booking->items) :
                                foreach ($booking->items as $item) :
                            ?>
                                    <div class="col-lg-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">
                                                    <?php echo $item->ticket->name ?>
                                                    <?php if ($item->quantity > 2 && $booking->is_paid == 1) : ?>
                                                        <!-- data-toggle="modal" data-target="#exampleModal" -->
                                                        <span class="float-right open_modal" data-value="<?php echo $item->quantity - 1 ?>"><small data-toggle="tooltip" data-placement="top" title="Transfer to Friend"><i class="fas fa-exchange-alt"></i></small></span>
                                                    <?php endif; ?>
                                                </h5>
                                                <a href="<?php echo user_base_url(); ?>gigs/detail?gig=<?php echo $gig->id ?>">
                                                    <h6 class="card-subtitle mb-2 text-muted"><?php echo $item->gig->title ?></h6>
                                                </a>
                                                <div class="ticket_info">
                                                    <span class="card-text">Gig Category</span>
                                                    <span class="card-text"><?php echo $item->gig->category->label ?></span>
                                                </div>
                                                <div class="ticket_info">
                                                    <span class="card-text">Gig Genre</span>
                                                    <span class="card-text"><?php echo $item->gig->genre->label ?></span>
                                                </div>
                                                <div class="ticket_info">
                                                    <span class="card-text">Gig Venues</span>
                                                    <span class="card-text"><?php echo $item->gig->venues ?></span>
                                                </div>
                                                <div class="ticket_info">
                                                    <span class="card-text">Gig Date</span>
                                                    <span class="card-text"><?php echo date('M d, Y h:i A', strtotime($item->gig->gig_date)) ?></span>
                                                </div>
                                                <div class="ticket_info">
                                                    <span class="card-text">Unit Price</span>
                                                    <span class="card-text">$<?php echo $item->ticket->price ?></span>
                                                </div>
                                                <div class="ticket_info">
                                                    <span class="card-text">Quantity</span>
                                                    <span class="card-text"><?php echo 'x' . $item->quantity ?></span>
                                                </div>
                                                <div class="ticket_info">
                                                    <span class="card-text">Total Price</span>
                                                    <span class="card-text">$<?php echo $item->price ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            <?php
                                endforeach;
                            endif;
                            ?>
                        </div>
                    </div>
                    <div class="d-flex float-right">
                        <a type="button" class="btn btn-secondary ml-2" href="<?php echo user_base_url() . 'bookings'; ?>">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form role="form" method="post" action="<?php echo user_base_url() ?>bookings/invite_friends" id="basic_info_form">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Invite Friends</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Invite</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- ==========Explore-content-Section========== -->
    <!-- /page content -->

    <?php $this->load->view('frontend/layout/footer'); ?>
    <?php $this->load->view('frontend/layout/scripts'); ?>
    <script>
        $(document).ready(function() {
            $('.open_modal').on('click', function() {
                var qty = $(this).data('value');
                $('.modal-body').empty();
                for (let index = 0; index < qty; index++) {
                    $('.modal-body').append('<div class="friend-input"><input type="email" name="email[]" class="form-control" required /></div>')
                }
                console.log(qty);
                $('#exampleModal').modal('show');
            });
            // $('#basic_info_form').on('submit', function(e) {
            //     e.preventDefault();
            //     var form_data = new FormData(e[0]);
            //     console.log(form_data);
            //     $.ajax({
            //         url: $(this).attr('action'),
            //         method: $(this).attr('method'),
            //         data: form_data,
            //         contentType: false,
            //         processData: false,
            //         success: function(resp) {

            //         }
            //     });
            //     // console.log(data);
            // })
        })
    </script>
</body>

</html>