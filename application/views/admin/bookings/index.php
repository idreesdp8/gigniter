<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('admin/layout/meta_tags'); ?>
    <title>Bookings</title>
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
                        <h5 class="card-title">Bookings</h5>
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
                        <table class="table table-striped">
                            <?php if (isset($records) && count($records) > 0) { ?>
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Booking #</th>
                                        <th>Price</th>
                                        <th>Item Count</th>
                                        <th>Paid</th>
                                        <th>Created on</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($records as $record) {
                                    ?>
                                        <tr>
                                            <td><?php echo $i ?></td>
                                            <td><?php echo $record->booking_no ?></td>
                                            <td>$<?php echo $record->price ?></td>
                                            <td><?php echo $record->item_count ?></td>
                                            <td><?php echo $record->is_paid ? 'Yes' : 'No' ?></td>
                                            <td><?php echo date('M d, Y', strtotime($record->created_on)) ?></td>
                                            <td>
                                                <div class="d-flex">
                                                    <a href="<?php echo admin_base_url().'bookings/show/'.$record->id ?>" type="button" class="btn btn-primary btn-icon ml-2"><i class="icon-pencil7"></i></a>
                                                    <form action="<?php echo admin_base_url() ?>bookings/trash/<?php echo $record->id ?>">
                                                        <button type="submit" class="btn btn-danger btn-icon ml-2"><i class="icon-trash"></i></button>
                                                    </form>
                                                </div>
                                            </td>
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