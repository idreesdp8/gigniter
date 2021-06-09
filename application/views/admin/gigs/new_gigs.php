<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('admin/layout/meta_tags'); ?>
    <title>Gigs Waiting for Approval</title>
</head>

<body>
    <?php $this->load->view('admin/layout/header'); ?>
    <div class="page-content">
        <?php $this->load->view('admin/layout/sidebar'); ?>
        <div class="content-wrapper">
            <div class="page-header page-header-light">
                <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
                    <div class="d-flex">
                        <div class="breadcrumb">
                            <a href="<?php echo admin_base_url(); ?>dashboard" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                            <span class="breadcrumb-item active">Gigs Waiting for Approval</span>
                        </div>

                        <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                    </div>
                </div>
            </div>
            <div class="content">
                <?php $this->load->view('alert/alert'); ?>
                <!-- Striped rows -->
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h5 class="card-title">Gigs Waiting for Approval</h5>
                    </div>

                    <div class="table-responsive">
                        <!-- <div class="row mx-0">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>From:</label>
                                    <select name="from" id="from" class="form-control">
                                        <option value="1">Current Gigs</option>
                                        <option value="0">Past Gigs</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6"></div>
                            <div class="col-md-2 text-center align-self-center">
                            <a href="<?php echo user_base_url().'cart/refresh_popularity' ?>" type="button" class="btn btn-primary">Refresh Popularity</a>
                            </div>
                        </div> -->
                        <table class="table table-striped datatable-basic">
                            <?php if (isset($records) && count($records) > 0) { ?>
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>User</th>
                                        <th>Title</th>
                                        <th>Category</th>
                                        <th>Genre</th>
                                        <th>Concert Date</th>
                                        <th>Campaign Date</th>
                                        <th>Amount Goal</th>
                                        <th>Audience Goal</th>
                                        <th>Added on</th>
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
                                            <td><?php echo $record->user_name ?></td>
                                            <td><?php echo $record->title ?></td>
                                            <td><?php echo $record->category_label ?></td>
                                            <td><?php echo $record->genre_label ?></td>
                                            <td><?php echo date('M d, Y', strtotime($record->gig_date)) ?></td>
                                            <td><?php echo date('M d, Y', strtotime($record->campaign_date)) ?></td>
                                            <td><?php echo '$'.$record->goal_amount ?></td>
                                            <td><?php echo $record->ticket_limit ?></td>
                                            <td><?php echo date('M d, Y', strtotime($record->created_on)) ?></td>
                                            <td>
                                                <div class="d-flex">
                                                    <!-- <button type="button" data-toggle="modal" data-target="#showModal" class="btn btn-info btn-icon showModal" data-value=<?php //echo $record->id 
                                                                                                                                                                                ?>><i class="icon-search4"></i></button> -->
                                                    <a href="<?php echo admin_base_url().'gigs/approve_gig/'.$record->id ?>" data-popup="tooltip" data-original-title="Approve Gig" type="button" class="btn btn-primary btn-icon ml-2"><i class="icon-checkmark4"></i></a>
                                                    <a href="<?php echo admin_base_url().'gigs/reject_gig/'.$record->id ?>" data-popup="tooltip" data-original-title="Reject Gig" type="button" class="btn btn-danger btn-icon ml-2"><i class="icon-x"></i></a>
                                                    <!-- <a href="<?php echo admin_base_url() ?>gigs/update/<?php echo $record->id ?>" type="button" class="btn btn-primary btn-icon ml-2"><i class="icon-pencil7"></i></a>
                                                    <form action="<?php echo admin_base_url() ?>gigs/trash/<?php echo $record->id ?>">
                                                        <button type="submit" class="btn btn-danger btn-icon ml-2"><i class="icon-trash"></i></button>
                                                    </form> -->
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
                <!-- /striped rows -->

            </div>

            <?php $this->load->view('admin/layout/footer'); ?>

        </div>
    </div>

    <script>
        // function reload_datatable() {
        //     var from = $('#from').val();
        //     console.log('From ' + from);
        //     $('.datatable-basic').DataTable({
        //         "destroy": true,
        //         "ajax": {
        //             "url": base_url + 'gigs/reload_popular_datatable',
        //             "type": "POST",
        //             "data": {
        //                 from: from,
        //             },
        //             dataType: 'json',
        //         },
        //         dataSrc: function(json) {
        //             console.log(json);
        //             if (json.tableData === null) {
        //                 return [];
        //             }
        //             return json.tableData;
        //         }
        //     }).ajax.reload();
        // }
        $(document).ready(function() {
            $('#sidebar_gig').addClass('nav-item-open');
            $('#sidebar_gig ul').first().css('display', 'block');
            $('#sidebar_approval_gig_view a').addClass('active');

            // $('#from', this).change(function() {
            //     reload_datatable();
            // });
        });
    </script>
</body>

</html>