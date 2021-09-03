<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('admin/layout/meta_tags'); ?>
    <title>Gig Stream Details</title>
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
                            <span class="breadcrumb-item active">Gig Stream Details</span>
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
                        <h5 class="card-title">Gig Stream Details</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Gig</label>
                                    <p><?php echo $gig->title ?></p>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Gig Date</label>
                                    <p><?php echo date('d M, Y', strtotime($gig->gig_date)); ?></p>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <h6>
                                    Stream Details
                                </h6>
                            </div>
                            <?php
                            if ($stream_details) :
                            ?>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Stream Server Url</label>
                                    <p><?php echo $stream_details->stream_key; ?></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Stream Secret</label>
                                    <p><?php echo $stream_details->stream_url; ?></p>
                                </div>
                            </div>
                            <?php
                            else :
                            ?>
                                <div class="col-md-12">
                                    No Stream Data found
                                </div>
                            <?php
                            endif;
                            ?>
                        </div>
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
            $('#sidebar_gig_view a').addClass('active');
        });
    </script>
</body>

</html>