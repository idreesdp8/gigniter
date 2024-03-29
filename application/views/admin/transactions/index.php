<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('admin/layout/meta_tags'); ?>
    <title>Transactions</title>
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

                <?php $this->load->view('alert/alert'); ?>
                <!-- Striped rows -->
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h5 class="card-title">Transactions</h5>
                        <div class="header-elements">
                            <div class="list-icons">
                                <!-- <a class="list-icons-item" data-action="collapse"></a> -->
                                <!-- <a class="list-icons-item" data-action="reload"></a> -->
                                <!-- <a class="list-icons-item" data-action="remove"></a> -->
                            </div>
                        </div>
                    </div>

                    <!-- <div class="card-body">
						Example of a table with <code>striped</code> rows. Use <code>.table-striped</code> added to the base <code>.table</code> class to add zebra-striping to any table odd row within the <code>&lt;tbody&gt;</code>. This styling doesn't work in IE8 and lower as <code>:nth-child</code> CSS selector isn't supported in these browser versions. Striped table can be combined with other table styles.
					</div> -->

                    <div class="table-responsive">
                        <?php if (isset($records) && count($records) > 0) { ?>
                            <table class="table table-striped datatable-basic">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Order #</th>
                                        <th>Gig</th>
                                        <th>Amount</th>
                                        <th>Stripe Fee</th>
                                        <th>Transaction Type</th>
                                        <th>User</th>
                                        <!-- <th>Account Type</th> -->
                                        <!-- <th>Status</th> -->
                                        <th>Date</th>
                                        <!-- <th>Actions</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($records as $record) {
                                    ?>
                                        <tr>
                                            <td><?php echo $i ?></td>
                                            <td>
                                                <a href="<?php echo $record->booking ? admin_base_url() . 'bookings/show/' . $record->booking->id : '' ?>" target="_blank">
                                                    <?php echo $record->booking ? $record->booking->booking_no : 'N/A' ?>
                                                </a>
                                            </td>
                                            <td><span class="badge badge-secondary badge-pill"><?php echo $record->gig_names ?></span></td>
                                            <td>
                                                <?php
                                                if ($record->type == 'charge')
                                                    echo $record->booking ? '$' . $record->booking->price : 'N/A';
                                                if ($record->type == 'transfer')
                                                    echo '$' . $record->amount;
                                                ?>
                                            </td>
                                            <td><?php echo '$' . $record->stripe_fee ?></td>
                                            <td>
                                                <?php
                                                if ($record->type == 'charge')
                                                    echo '<span class="badge badge-danger badge-pill">Charged from</span>';
                                                if ($record->type == 'transfer')
                                                    echo '<span class="badge badge-success badge-pill">Transferred to</span>';
                                                ?>
                                            </td>
                                            <td><?php echo $record->user_name ?></td>
                                            <!-- <td>
                                                <?php
                                                if($record->booking) {
                                                    if ($record->booking->is_paid == 0)
                                                        echo 'Pending';
                                                    if ($record->booking->is_paid == 1)
                                                        echo 'Paid';
                                                    if ($record->booking->is_paid == 2)
                                                        echo 'Cancelled';

                                                } else {
                                                    echo 'Booking Deleted';
                                                }
                                                ?>
                                            </td> -->
                                            <td><?php echo date('M d, Y', strtotime($record->created_on)) ?></td>
                                            <!-- <td>
                                                <div class="d-flex">
                                                    <a href="<?php echo admin_base_url() . 'bookings/show/' . $record->id ?>" type="button" class="btn btn-primary btn-icon ml-2"><i class="icon-pencil7"></i></a>
                                                    <form action="<?php echo admin_base_url() ?>bookings/trash/<?php echo $record->id ?>">
                                                        <button type="submit" class="btn btn-danger btn-icon ml-2"><i class="icon-trash"></i></button>
                                                    </form>
                                                </div>
                                            </td> -->
                                        </tr>
                                    <?php
                                        $i++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        <?php } else { ?>
                            <div style="padding: 10px; text-align: center; color: #333;">No record found</div>
                        <?php } ?>
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
            $('#sidebar_transaction').addClass('nav-item-open');
            $('#sidebar_transaction ul').first().css('display', 'block');
            $('#sidebar_transaction_view a').addClass('active');
        });
    </script>
</body>

</html>