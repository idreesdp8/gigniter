<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('admin/layout/meta_tags'); ?>
    <title>Bookings</title>
    <style>
        input[type='text'] {
            border: 0px;
            padding: 0px;
        }
    </style>
</head>

<body>
    <?php $this->load->view('admin/layout/header'); ?>
    <!-- Page content -->
    <div class="page-content">
        <?php $this->load->view('admin/layout/sidebar'); ?>
        <!-- Main content -->
        <div class="content-wrapper">
            <!-- Page header -->
            <div class="page-header page-header-light">
                <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
                    <div class="d-flex">
                        <div class="breadcrumb">
                            <a href="<?php echo admin_base_url(); ?>dashboard" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                            <span class="breadcrumb-item active">Dashboard</span>
                        </div>

                        <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                    </div>
                </div>
            </div>
            <!-- /page header -->
            <!-- Content area -->
            <div class="content">
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h6 class="card-title">Booking</h6>
                        <div class="header-elements">
                            <!-- <div class="list-icons">
                                <a class="list-icons-item" data-action="collapse"></a>
                                <a class="list-icons-item" data-action="reload"></a>
                                <a class="list-icons-item" data-action="remove"></a>
                            </div> -->
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Order #</label>
                                    <input type="text" class="form-control" value="<?php echo $booking->booking_no ?>">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Customer</label>
                                    <input type="text" class="form-control" value="<?php echo $customer->name ?>">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Total Amount</label>
                                    <input type="text" class="form-control" value="$<?php echo $booking->price ?>">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Date</label>
                                    <input type="text" class="form-control" value="<?php echo date('M d, Y h:i A', strtotime($booking->created_on)) ?>">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <h6>
                                    Purchased Ticket Tiers
                                </h6>
                            </div>
                        </div>
                        <?php
                        if ($cart_items) :
                        ?>
                            <div class="row">
                                <?php
                                foreach ($cart_items as $item) :
                                ?>
                                    <div class="col-md-3">
                                        <div class="card">
                                            <div class="card-header header-elements-inline">
                                                <h6 class="card-title text-uppercase">
                                                    <?php echo $item->ticket_tier->name ?>
                                                </h6>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="d-flex justify-content-between">
                                                            <p>Quantity</p>
                                                            <p><?php echo $item->quantity ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="d-flex justify-content-between">
                                                            <p>Unit Price</p>
                                                            <p>$<?php echo $item->ticket_tier->price ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="d-flex justify-content-between">
                                                            <p>Total Price</p>
                                                            <p>$<?php echo $item->price ?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                endforeach;
                                ?>
                            </div>
                        <?php
                        endif;
                        ?>
                        <div class="row">
                            <div class="col-md-12">
                                <h6>
                                    Transaction Details
                                </h6>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <?php if ($booking->is_paid && isset($transactions) && count($transactions) > 0) { ?>
                                        <thead>
                                            <tr>
                                                <th>Order #</th>
                                                <th>Customer</th>
                                                <th>Amount ($)</th>
                                                <th>Gig Owner</th>
                                                <th>Admin fee (%)</th>
                                                <th>Transfered ($)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1;
                                            foreach ($transactions as $transaction) {
                                            ?>
                                                <tr>
                                                    <?php
                                                    if ($transaction->type == 'charge') :
                                                    ?>
                                                        <td><?php echo $booking->booking_no ?></td>
                                                        <td><?php echo $customer->name ?></td>
                                                        <td>$<?php echo $transaction->amount ?></td>
                                                        <td>-</td>
                                                        <td>-</td>
                                                        <td>-</td>
                                                    <?php
                                                    else :
                                                    ?>
                                                        <td><?php echo $booking->booking_no ?></td>
                                                        <td>-</td>
                                                        <td>-</td>
                                                        <td><?php echo $account->individual->first_name . ' ' . $account->individual->last_name ?></td>
                                                        <td>$<?php echo $transaction->admin_fee ?></td>
                                                        <td>$<?php echo $transaction->amount ?></td>
                                                    <?php
                                                    endif;
                                                    ?>
                                                </tr>
                                            <?php
                                                $i++;
                                            }
                                            ?>
                                        </tbody>
                                    <?php } else { ?>
                                        <div style="padding: 10px; text-align: center; color: #333;">No record found</div>
                                    <?php } ?>
                                </table>
                            </div>
                        </div>
                        <div class="d-flex justify-content-start mt-3">
                            <a href="<?php echo admin_base_url() ?>bookings" type="button" class="btn btn-light">Back</a>
                            <!-- <?php
                                    if (!$booking->is_paid) :
                                    ?>
                                <form action="<?php echo admin_base_url() ?>bookings/charge" method="post">
                                    <input type="hidden" name="customer_id" value="<?php echo $customer->id ?>">
                                    <input type="hidden" name="amount" value="<?php echo $booking->price ?>">
                                    <input type="hidden" name="booking_id" value="<?php echo $booking->id ?>">
                                    <button type="submit" class="btn bg-blue ml-3">Charge</button>
                                </form>
                            <?php
                                    endif;
                            ?> -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- /content area -->

            <?php $this->load->view('admin/layout/footer'); ?>

        </div>
        <!-- /main content -->
    </div>
    <!-- /page content -->

    <script>
        $(document).ready(function() {
            $('#sidebar_booking a').addClass('active');
        });
    </script>
</body>

</html>