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

        .img-wrapper {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-evenly;
        }

        .img-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .img-wrapper>div {
            width: 120px;
            margin-bottom: 10px;
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
                            if ($booking->is_paid == 0 && $booking->hours > 48) :
                            ?>
                                <a type="button" class="btn btn-danger ml-2 float-right" href="javascript:void(0);" onclick="operate_booking_deletion('<?php echo $booking->id; ?>');">Cancel Order</a>
                            <?php
                            endif;
                            ?>
                            <?php
                            if ($booking->is_paid == 0 && $booking->hours < 48) :
                            ?>
                                <a type="button" class="btn btn-warning ml-2 float-right" href="<?php echo user_base_url().'bookings/amend_order/'.$booking->id; ?>">Amend Order</a>
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
                                        <p><?php echo '$'.number_format($booking->price, 2, '.', ','); ?></p>
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
                                        <div class="circlebar text-center">
                                            <div class="pie_progress3 booked-color-3 m-auto" role="progressbar" data-goal="<?php echo $gig->booked ?>">
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
                                                    <?php if ($item->quantity > 1 && $booking->is_paid == 1) : ?>
                                                        <!-- data-toggle="modal" data-target="#exampleModal" -->
                                                        <span class="float-right open_modal" data-cart_id="<?php echo $item->id ?>" data-value="<?php echo $item->quantity - 1 ?>"><small data-toggle="tooltip" data-placement="top" title="Transfer to Friend"><i class="fas fa-exchange-alt"></i></small></span>
                                                    <?php endif; ?>
                                                </h5>
                                                <a href="<?php echo user_base_url(); ?>gigs/detail?gig=<?php echo $gig->id ?>">
                                                    <h6 class="card-subtitle mb-2 text-muted"><?php echo $gig->title ?></h6>
                                                </a>
                                                <div class="ticket_info">
                                                    <span class="card-text">Gig Category</span>
                                                    <span class="card-text"><?php echo $gig->category->label ?></span>
                                                </div>
                                                <div class="ticket_info">
                                                    <span class="card-text">Gig Genre</span>
                                                    <span class="card-text"><?php echo $gig->genre->label ?></span>
                                                </div>
                                                <div class="ticket_info">
                                                    <span class="card-text">Gig Venues</span>
                                                    <span class="card-text"><?php echo $gig->venues ?></span>
                                                </div>
                                                <div class="ticket_info">
                                                    <span class="card-text">Gig Date</span>
                                                    <span class="card-text"><?php echo date('M d, Y', strtotime($gig->gig_date)) ?></span>
                                                </div>
                                                <div class="ticket_info">
                                                    <span class="card-text">Unit Price</span>
                                                    <span class="card-text"><?php echo '$'.number_format($item->ticket->price, 2, '.', ','); ?></span>
                                                </div>
                                                <div class="ticket_info">
                                                    <span class="card-text">Quantity</span>
                                                    <span class="card-text"><?php echo 'x' . $item->purchased ?></span>
                                                </div>
                                                <?php
                                                if ($item->friends) :
                                                    echo '<div class="ticket_shared text-warning"><strong>Shared Tickets</strong>';
                                                    foreach ($item->friends as $friend) :
                                                ?>
                                                        <div class="ticket_info">
                                                            <span class="card-text"><?php echo $friend ?></span>
                                                            <span class="card-text">x1</span>
                                                        </div>
                                                <?php
                                                    endforeach;
                                                    echo '</div>';
                                                endif;
                                                ?>
                                                <div class="ticket_info">
                                                    <span class="card-text">Total Price</span>
                                                    <span class="card-text"><?php echo '$'.number_format($item->price, 2, '.', ','); ?></span>
                                                </div>
                                                <div class="mt-3 mb-3">
                                                    <h6 class="card-subtitle mb-2 text-muted">Ticket Validation</h6>
                                                    <?php
                                                    if (isset($item->ticket_tier_id)) :
                                                        $rows = $this->bookings_model->get_tickets_by_tierid_cartid($item->ticket_tier_id, $item->id);
                                                        if (isset($rows)) :
                                                            foreach ($rows as $row) :
                                                    ?>
                                                                <div class="ticket_info">
                                                                    <span class="card-text"><?php echo $row->ticket_no ?></span>
                                                                    <span class="card-text">
                                                                        <?php
                                                                        if ($row->is_validated) :
                                                                        ?>
                                                                            <span class="bundle-pill pill-success">Validated</span>
                                                                        <?php
                                                                        else :
                                                                        ?>
                                                                            <span class="bundle-pill pill-warning">Not Validated</span>
                                                                        <?php
                                                                        endif;
                                                                        ?>
                                                                    </span>
                                                                </div>
                                                    <?php
                                                            endforeach;
                                                        endif;
                                                    endif;
                                                    ?>
                                                </div>
                                                <?php
                                                if ($booking->is_paid == 1) :
                                                ?>
                                                    <div class="text-center">
                                                        <form target="_blank" action="<?php echo user_base_url() ?>bookings/download_tickets" method="post">
                                                            <input type="hidden" name="booking_id" value="<?php echo $item->booking_id ?>">
                                                            <input type="hidden" name="gig_id" value="<?php echo $item->gig_id ?>">
                                                            <input type="hidden" name="ticket_tier_id" value="<?php echo $item->ticket_tier_id ?>">
                                                            <input type="hidden" name="user_id" value="<?php echo $item->user_id ?>">
                                                            <button type="submit" class="btn btn-theme-primary">Download Tickets</button>
                                                        </form>
                                                    </div>
                                                <?php
                                                endif;
                                                ?>
                                                <!-- <?php if (isset($item->ticket_tier_id)) {
                                                            $rows = $this->bookings_model->get_tickets_by_tierid_cartid($item->ticket_tier_id, $item->id);
                                                            if (isset($rows)) { ?>
                                                <div class="img-wrapper">
                                                    <?php
                                                                foreach ($rows as $row) {
                                                                    if (strlen($row->qr_token) > 0) {
                                                                        $qr_code_url = '';

                                                                        if ($_SERVER['HTTP_HOST'] == "localhost") {
                                                                            $qr_code_url = qrcode_url() . "ticket_" . $row->qr_token . ".png";
                                                                        } else {
                                                                            $qr_code_url = qrcode_url() . "ticket_" . $row->qr_token . ".png";
                                                                        }   ?>
                                                            <div>
                                                                <img src="<?php echo $qr_code_url; ?>" style="width:120px; height:120px;">
                                                            </div>
                                                    <?php
                                                                    }
                                                                } ?>
                                                </div>
                                        <?php
                                                            }
                                                        } ?> -->
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
                    <input type="hidden" name="booking_id" value="<?php echo $booking->id ?>">
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
        function operate_booking_deletion(del_id) {
            $(document).ready(function() {
                swal({
                    title: "Do you want to Cancel this Booking?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        window.location = "<?php echo user_base_url() . 'bookings/cancel_booking/'; ?>" + del_id;
                    } else {
                        swal({
                            icon: 'info',
                            title: 'Your booking is safe!',
                        });
                    }
                });
            });
        }
        $(document).ready(function() {

            $('.open_modal').on('click', function() {
                var qty = $(this).data('value');
                var cart_id = $(this).data('cart_id');
                $('.modal-body').empty();
                $('.modal-body').append('<input type="hidden" name="cart_id" value="' + cart_id + '">');
                for (let index = 0; index < qty; index++) {
                    $('.modal-body').append('<div class="friend-input"><input type="email" name="email[]" class="form-control" required /></div>')
                }
                // console.log(qty);
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