<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('admin/layout/meta_tags'); ?>
    <title>Email Log</title>
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
                            <span class="breadcrumb-item active">Email Log</span>
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
                        <h5 class="card-title">Email Log</h5>
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
                        <table class="table table-striped datatable-custom">
                            <?php if (isset($logs) && count($logs) > 0) { ?>
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Sending User</th>
                                        <th>Email</th>
                                        <th>Reason</th>
                                        <th>Created on</th>
                                        <!-- <th>Actions</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($logs as $record) {
                                    ?>
                                        <tr>
                                            <td><?php echo $i ?></td>
                                            <td><?php echo $record->user_name ?></td>
                                            <td><?php echo $record->email ?></td>
                                            <td>$<?php echo $record->email_for ?></td>
                                            <td><?php echo date('M d, Y H:i A', strtotime($record->created_on)) ?></td>
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
        var swalInit = swal.mixin({
            buttonsStyling: false,
            confirmButtonClass: 'btn btn-primary',
            cancelButtonClass: 'btn btn-light'
        });

        $(document).ready(function() {
            $('#sidebar_email-log a').addClass('active');

            $('.datatable-custom').DataTable({
                columnDefs: [{
                    orderable: false,
                    targets: 0
                }],
                order: [
                    [0, 'asc']
                ]
            });

        });
    </script>
</body>

</html>