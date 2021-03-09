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
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Customer Name</label>
                                    <input type="text" class="form-control" value="<?php echo $booking->user_name ?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Booking Number</label>
                                    <input type="text" class="form-control" value="<?php echo $booking->booking_no ?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Total Amount</label>
                                    <input type="text" class="form-control" value="$<?php echo $booking->price ?>">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <h6>
                                    Ticket Tiers
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
                    <a href="<?php echo admin_base_url() ?>bookings" type="button" class="btn btn-secondary">Back</a>
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