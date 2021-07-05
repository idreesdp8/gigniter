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
                <h2 class="exlpore-title">Payment Details</h2>
                <h5 class="explore-subtitle">Order #: <?php echo $transaction->booking->booking_no ?? '' ?></h5>
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
                        <h5 class="title">Payment Details</h5>
                        <!-- <ul>
                            <li>
                                <h6>Order #</h6>
                                <p><?php echo $transaction->booking->booking_no ?></p>
                            </li>
                            <li>
                                <h6>Customer Name</h6>
                                <p><?php echo $transaction->booking->customer->fname . ' ' . $transaction->booking->customer->lname ?></p>
                            </li>
                        </ul> -->
                        <div class="row">
                            <div class="col-lg-2">
                                <h6>Order #</h6>
                                <p><?php echo $transaction->booking->booking_no ?></p>
                            </div>
                            <div class="col-lg-2">
                                <h6>Customer Name</h6>
                                <p><?php echo $transaction->booking->customer->fname . ' ' . $transaction->booking->customer->lname ?></p>
                            </div>
                            <div class="col-lg-2">
                                <h6>Customer #</h6>
                                <p><?php echo $transaction->customer_id ?></p>
                            </div>
                            <div class="col-lg-2">
                                <h6>Total Amount</h6>
                                <p>$<?php echo $transaction->amount ?></p>
                            </div>
                            <div class="col-lg-2">
                                <h6>Status</h6>
                                <p><?php echo $transaction->booking->is_paid ? 'Paid' : 'Pending' ?></p>
                            </div>
                            <div class="col-lg-2">
                                <h6>Payment Date</h6>
                                <p><?php echo date('M d,Y', strtotime($transaction->created_on)) ?></p>
                            </div>
                            <div class="col-lg-12">
                                <h5>Tickets</h5>
                            </div>
                            <br>
                            <?php
                            if ($transaction->booking->items) :
                                foreach ($transaction->booking->items as $item) :
                            ?>
                                    <div class="col-lg-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title"><?php echo $item->ticket->name ?></h5>
                                                <h6 class="card-subtitle mb-2 text-muted"><?php echo $item->gig->title ?></h6>
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
                    <div class="d-flex">
                        <form action="<?php echo user_base_url() . 'transactions/cancel_booking'; ?>" method="post">
                            <input type="hidden" name="id" value="<?php echo $transaction->booking->id ?>">
                            <button type="submit" class="btn btn-danger h-auto">Cancel Booking</button>
                        </form>
                        <a type="button" class="btn btn-secondary ml-2" href="<?php echo user_base_url() . 'transactions'; ?>">Back</a>
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