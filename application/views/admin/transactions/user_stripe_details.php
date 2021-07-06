<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('admin/layout/meta_tags'); ?>
    <title>User Stripe Record</title>
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
                            <span class="breadcrumb-item active">User Stripe Record</span>
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
                        <h5 class="card-title">User Stripe Record</h5>
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
                                        <th>User Name</th>
                                        <th>Stripe Email</th>
                                        <th>Stripe Account ID</th>
                                        <th>Restricted</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($records as $record) {
                                    ?>
                                        <tr>
                                            <td><?php echo $i ?></td>
                                            <td><?php echo (isset($record->user) && !empty($record->user)) ? ($record->user->fname ?? '') . ' ' . ($record->user->lname ?? '') : 'NA' ?></td>
                                            <td><?php echo (isset($record->stripe_details) && !empty($record->stripe_details)) ? $record->stripe_details->stripe_id : 'NA' ?></td>
                                            <td><?php echo (isset($record->stripe_details) && !empty($record->stripe_details)) ? $record->stripe_details->stripe_account_id : 'NA' ?></td>
                                            <td>
                                                <?php
                                                if (isset($record->stripe_details) && !empty($record->stripe_details)) :
                                                    if ($record->stripe_details->is_restricted) :
                                                        echo '<span class="badge badge-danger badge-pill">Yes</span>';
                                                    else :
                                                        echo '<span class="badge badge-success badge-pill">No</span>';
                                                    endif;
                                                else :
                                                    echo 'NA';
                                                endif;
                                                ?>
                                            </td>
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
            $('#sidebar_user-stripe a').addClass('active');
        });
    </script>
</body>

</html>