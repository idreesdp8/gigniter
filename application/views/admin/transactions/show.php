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
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Order #</label>
                                    <p><?php echo $booking->booking_no ?></p>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Customer</label>
                                    <p><?php echo $customer->fname . ' ' . $customer->lname ?></p>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Total Amount</label>
                                    <p><?php echo '$' . $booking->price ?></p>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Status</label>
                                    <p>
                                        <?php
                                        if ($booking->is_paid == 0)
                                            echo 'Pending';
                                        if ($booking->is_paid == 1)
                                            echo 'Paid';
                                        if ($booking->is_paid == 2)
                                            echo 'Cancelled';
                                        ?>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Date</label>
                                    <p><?php echo date('M d, Y h:i A', strtotime($booking->created_on)) ?></p>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <h6>
                                    Tickets
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
                                            <div class="card-header">
                                                <h5 class="card-title text-uppercase">
                                                    <?php echo $item->ticket_tier->name ?>
                                                </h5>
                                                <h6 class="card-subtitle mb-2 text-muted"><?php echo $item->gig_title ?></h6>
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
                                    <?php
                                    if ($booking->is_paid && isset($transactions) && count($transactions) > 0) {
                                        $total_admin_fee = 0;
                                        $total_transfer = 0;
                                    ?>
                                        <thead>
                                            <tr>
                                                <th>Order #</th>
                                                <th>Customer</th>
                                                <th>Amount ($)</th>
                                                <th>Gig Owner</th>
                                                <th>Admin fee (%)</th>
                                                <th>Transfered ($)</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1;
                                            foreach ($transactions as $transaction) {
                                            ?>
                                                <tr>
                                                    <td><?php echo $booking->booking_no ?></td>
                                                    <?php
                                                    if ($transaction->type == 'charge') :
                                                    ?>
                                                        <td><?php echo $customer->fname . ' ' . $customer->lname ?></td>
                                                        <td><?php echo '$' . $transaction->amount ?></td>
                                                        <td>-</td>
                                                        <td>-</td>
                                                        <td>-</td>
                                                    <?php
                                                    else :
                                                    ?>
                                                        <!-- <td><?php echo $booking->booking_no ?></td> -->
                                                        <td>-</td>
                                                        <td>-</td>
                                                        <td><?php echo isset($account) ? $account->fname . ' ' . $account->lname : '' ?></td>
                                                        <td><?php echo '$' . $transaction->admin_fee ?></td>
                                                        <td><?php echo '$' . $transaction->amount ?></td>
                                                    <?php
                                                        $total_transfer += $transaction->amount;
                                                    endif;
                                                    ?>
                                                    <td><?php echo date('M d, Y', strtotime($transaction->created_on)) ?></td>
                                                </tr>
                                            <?php
                                                $i++;
                                                $total_admin_fee += $transaction->admin_fee;
                                            }
                                            ?>
                                            <tr>
                                                <td colspan="4">Total</td>
                                                <td><?php echo '$' . $total_admin_fee ?></td>
                                                <td><?php echo '$' . $total_transfer ?></td>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                    <?php } else { ?>
                                        <div style="padding: 10px; text-align: center; color: #333;">No record found</div>
                                    <?php } ?>
                                </table>
                            </div>
                        </div>
                        <div class="d-flex justify-content-start mt-3">
                            <a href="<?php echo admin_base_url() ?>bookings" type="button" class="btn btn-light">Back</a>
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