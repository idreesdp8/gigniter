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

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Search: </label>
                                    <input type="search" name="search" id="search" class="form-control" placeholder="Search by name">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Restricted: </label>
                                    <select name="is_restricted" id="is_restricted" class="form-control">
                                        <option value="">Select Option</option>
                                        <option value="0">No</option>
                                        <option value="1">Yes</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive" id="table">
                        <?php $this->load->view('admin/transactions/user_stripe_details_partial', $records); ?>
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

            // var timer;
            $('#search').change(function() {
                // clearTimeout(timer);
                // var ms = 2000;
                // timer = setTimeout(function() {
                reload_table()
                // }, ms);
            });
            $('#is_restricted').change(function() {
                reload_table()
            })
        });

        function reload_table() {
            var search = $('#search').val();
            var is_restricted = $('#is_restricted').val();
            console.log(search);
            console.log(is_restricted);
            $.ajax({
                url: base_url + 'transactions/filter_user_stripe_details',
                data: {
                    search: search,
                    is_restricted: is_restricted,
                },
                method: 'POST',
                dataType: 'json',
                success: function(resp) {
                    $('#table').empty();
                    $('#table').html(resp.view);
                }
            })
        }
    </script>
</body>

</html>