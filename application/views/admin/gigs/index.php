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
                        <div class="form-group m-auto d-inline-flex align-items-center" style="padding: 20px 20px 0px;">
                            <span class="mr-1">Category:</span>
                            <select name="category" id="category" class="form-control mr-1">
                                <option value="">Select Option</option>
                                <?php
                                if ($categories) :
                                    foreach ($categories as $category) :
                                ?>
                                        <option value="<?php echo $category->label ?>"><?php echo $category->label ?></option>
                                <?php
                                    endforeach;
                                endif;
                                ?>
                            </select>
                            <span class="mr-1">Genre:</span>
                            <select name="genre" id="genre" class="form-control mr-1">
                                <option value="">Select Option</option>
                                <?php
                                if ($genres) :
                                    foreach ($genres as $genre) :
                                ?>
                                        <option value="<?php echo $genre->label ?>"><?php echo $genre->label ?></option>
                                <?php
                                    endforeach;
                                endif;
                                ?>
                            </select>
                            <span class="mr-1">Status:</span>
                            <select name="status" id="status" class="form-control mr-1">
                                <option value="">Select Option</option>
                                <?php
                                if ($statuses) :
                                    foreach ($statuses as $status) :
                                ?>
                                        <option value="<?php echo $status->label ?>"><?php echo $status->label ?></option>
                                <?php
                                    endforeach;
                                endif;
                                ?>
                            </select>
                            <span class="mr-1">Featured:</span>
                            <select name="is_featured" id="is_featured" class="form-control mr-1">
                                <option value="">Select Option</option>
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                            </select>
                            <span class="mr-1">Sort by:</span>
                            <select name="sort" id="sort" class="form-control">
                                <option value="">Select Option</option>
                                <option value="most_popular">Most Popular</option>
                                <option value="just_in">Just In</option>
                                <option value="closing_soon">Closing Soon</option>
                            </select>
                        </div>
                        <div id="table">
                            <?php $this->load->view('admin/gigs/index_partial'); ?>
                        </div>
                    </div>
                </div>
                <!-- /striped rows -->

            </div>

            <?php $this->load->view('admin/layout/footer'); ?>

        </div>
    </div>

    <script>
        function reload_datatable() {
            var sort_by = $('#sort').val();
            var status = $('#status').val();
            console.log('Status '+ status);
            console.log('Sort '+ sort_by);
            $('.datatable-custom').DataTable({
                "destroy": true,
                "ajax": {
                    "url": base_url + 'gigs/reload_datatable',
                    "type": "POST",
                    "data": {
                        sort_by: sort_by,
                        status: status,
                    },
                    dataType: 'json',
                },
                dataSrc: function(json) {
                    console.log(json);
                    if (json.tableData === null) {
                        return [];
                    }
                    return json.tableData;
                }
            }).ajax.reload();
        }
        $(document).ready(function() {
            $('#sidebar_gig').addClass('nav-item-open');
            $('#sidebar_gig ul').first().css('display', 'block');
            $('#sidebar_gig_view a').addClass('active');

            // $('#is_featured').change(function() {
            //     console.log($(this).val());
            //     console.log($('.datatable-basic'));
            //     // $('.datatable-basic').draw();
            // });

            manageTable = $('.datatable-custom').DataTable({
                // 'bFilter': false,
                // 'searching': true,
                // "sDom":"ltipr"
            });

            $('#is_featured', this).change(function() {
                if (manageTable.column(8).search() !== this.value) {
                    manageTable.column(8).search(this.value).draw();
                }
            });
            $('#category', this).change(function() {
                if (manageTable.column(3).search() !== this.value) {
                    manageTable.column(3).search(this.value).draw();
                }
            });
            $('#genre', this).change(function() {
                if (manageTable.column(4).search() !== this.value) {
                    manageTable.column(4).search(this.value).draw();
                }
            });
            $('#status', this).change(function() {
                reload_datatable();
            });
            $('#sort', this).change(function() {
                reload_datatable();
            });
        });
    </script>
</body>

</html>