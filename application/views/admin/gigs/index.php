<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('admin/layout/meta_tags'); ?>
    <title>Gigs</title>
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
                            <span class="breadcrumb-item active">Gigs</span>
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
                        <h5 class="card-title">Gigs</h5>
                        <div class="header-elements">
                            <div class="list-icons">
                                <!-- <label class="mb-0">Filter: </label> -->
                                <!-- <select name="role" id="role" class="form-control select">
                                    <option value="">Select a role</option>
                                    <?php
                                    // if (isset($roles)) {
                                    //     foreach ($roles as $role) {
                                    ?>
                                            <option value="<?php //echo $role->id 
                                                            ?>"><?php //echo $role->name 
                                                                ?></option>
                                    <?php
                                    //     }
                                    // }
                                    ?>
                                </select> -->
                                <!-- <input type="text" name="search" id="search" class="form-control" placeholder="Search by title"> -->
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
                        <div id="table">
                            <?php $this->load->view('admin/gigs/index_partial'); ?>
                        </div>
                    </div>
                </div>
                <!-- /striped rows -->

                <!-- Vertical form modal -->
                <div id="showModal" class="modal fade" tabindex="-1">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Gig</h5>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <!-- <form action="<?php //echo admin_base_url() 
                                                ?>permissions/update" method="post"> -->
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" class="form-control" placeholder="Enter title" name="title" id="title" value="Taylor Swift">
                                </div>
                                <div class="form-group">
                                    <label>Subtitle</label>
                                    <textarea name="subtitle" id="subtitle" cols="30" rows="3" class="form-control" placeholder="Enter subtitle">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</textarea>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Category</label>
                                            <select name="category" id="category" class="form-control select">
                                                <option value="">Select category</option>
                                                <option value="1" selected>Option 1</option>
                                                <option value="2">Option 2</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Genre</label>
                                            <select name="genre" id="genre" class="form-control select">
                                                <option value="">Select genre</option>
                                                <option value="1" selected>Option 1</option>
                                                <option value="2">Option 2</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Address</label>
                                            <textarea name="address" id="address" cols="30" rows="4" class="form-control" placeholder="Enter address">121 Worcester Rd, Framingham MA 1701</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Goal</label>
                                            <input type="text" class="form-control" placeholder="Enter goal" name="goal" id="goal" value="200">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Poster</label>
                                            <div class="media mt-0 p-1" style="border: 2px dashed #ccc; height: 350px">
                                                <!-- <img src="<?php //echo poster_url() ?>WD_Poster_2018.jpg" alt="" class="m-auto h-100"> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Campaign Date</label>
                                            <input type="date" class="form-control" placeholder="Enter campaign date" name="campaign_date" id="campaign_date" value="2020-12-10">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Concert Date</label>
                                            <input type="date" class="form-control" placeholder="Enter concert date" name="gig_date" id="gig_date" value="2020-12-30">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Venue</label>
                                            <input type="text" class="form-control" placeholder="Enter venue" name="venue" id="venue" value="Physical">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select name="status" id="status" class="form-control select">
                                                <option value="">Select Status</option>
                                                <option value="1">Live</option>
                                                <option value="2" selected>Draft</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                            </div>
                            <!-- </form> -->
                        </div>
                    </div>
                </div>
                <!-- /vertical form modal -->

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