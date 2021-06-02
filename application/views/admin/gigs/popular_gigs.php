<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('admin/layout/meta_tags'); ?>
    <title>Popular Gigs</title>
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
                            <span class="breadcrumb-item active">Popular Gigs</span>
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
                        <h5 class="card-title">Popular Gigs</h5>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped datatable-basic">
                            <?php if (isset($records) && count($records) > 0) { ?>
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>User</th>
                                        <th>Title</th>
                                        <th>Category</th>
                                        <th>Genre</th>
                                        <th>Popularity</th>
                                        <th>Concert Date</th>
                                        <th>Satus</th>
                                        <th>Booked</th>
                                        <th>Added on</th>
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
                                            <td><?php echo $record->category ?></td>
                                            <td><?php echo $record->genre ?></td>
                                            <td><?php echo $record->popularity ?></td>
                                            <td><?php echo $record->gig_date ? date('M d, Y', strtotime($record->gig_date)) : 'NA' ?></td>
                                            <td>
                                                <?php
                                                if ($record->status == 0) :
                                                    $badge_class = 'badge-danger';
                                                elseif ($record->status == 1) :
                                                    $badge_class = 'badge-success';
                                                elseif ($record->status == 2) :
                                                    $badge_class = 'badge-primary';
                                                elseif ($record->status == 3) :
                                                    $badge_class = 'badge-secondary';
                                                endif;
                                                ?>
                                                <span class="badge <?php echo $badge_class ?>"><?php echo $record->status_label ?></span>
                                            </td>
                                            <td><?php echo round($record->booked, 0) ?>%</td>
                                            <td><?php echo date('M d, Y', strtotime($record->created_on)) ?></td>
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
        $(document).ready(function() {
            $('#sidebar_gig').addClass('nav-item-open');
            $('#sidebar_gig ul').first().css('display', 'block');
            $('#sidebar_popular_gig_view a').addClass('active');
        });
    </script>
</body>

</html>