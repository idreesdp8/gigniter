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
                        <!-- <div class="form-group m-auto d-inline-flex align-items-center" style="padding: 20px 20px 0px;">
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
                        </div> -->
                        <div class="row m-0">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Status:</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="">Select Option</option>
                                        <?php
                                        if ($statuses) :
                                            foreach ($statuses as $status) :
                                        ?>
                                                <option value="<?php echo $status->value ?>"><?php echo $status->label ?></option>
                                        <?php
                                            endforeach;
                                        endif;
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Featured:</label>
                                    <select name="is_featured" id="is_featured" class="form-control">
                                        <option value="">Select Option</option>
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Sort by:</label>
                                    <select name="sort" id="sort" class="form-control">
                                        <option value="">Select Option</option>
                                        <option value="most_popular">Most Popular</option>
                                        <option value="just_in">Just In</option>
                                        <option value="closing_soon">Closing Soon</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <a type="button" class="btn btn-info w-100" href="<?php echo admin_base_url() . 'gigs/change_status/2' ?>">Publish Live</a>
                            </div>
                            <div class="col-md-2">
                                <a type="button" class="btn btn-secondary w-100" href="<?php echo admin_base_url() . 'gigs/change_status/3' ?>">Off Air Concerts</a>
                            </div>
                        </div>
                        <div id="table" class="p-3">
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
            var is_featured = $('#is_featured').val();
            console.log('Status ' + status);
            console.log('Sort ' + sort_by);
            console.log('Featured ' + is_featured);
            $('.datatable-custom').DataTable({
                "destroy": true,
                "ajax": {
                    "url": base_url + 'gigs/reload_datatable',
                    "type": "POST",
                    "data": {
                        sort_by: sort_by,
                        status: status,
                        is_featured: is_featured,
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

            $('#is_featured', this).change(function() {
                reload_datatable();
            });
            $('#status', this).change(function() {
                reload_datatable();
            });
            $('#sort', this).change(function() {
                reload_datatable();
            });

            var showModal = document.getElementsByClassName('showModal')
            for (var i = 0; i < showModal.length; i++) {
                showModal[i].addEventListener('click', function(e) {
                    openModal(e.currentTarget.dataset.value)
                })
            }

            function openModal(gig_id) {
                console.log(gig_id)
                $.ajax({
                    url: base_url + 'gigs/get_gig_history',
                    data: {
                        gig_id: gig_id
                    },
                    method: 'POST',
                    dataType: 'json',
                    success: function(response) {
                        var html_text = ''
                        $('#gigName').html(response.gig.title)
                        if (response.gig_history.length > 0) {
                            response.gig_history.map(function(value, index) {
                                var class_text = '';
                                if (value.action === 'gig_approved') {
                                    class_text += 'text-success';
                                } else if (value.action === 'gig_rejected') {
                                    class_text += 'text-danger';
                                } else if (value.action === 'gig_submitted') {
                                    class_text += 'text-primary';
                                } else if (value.action === 'gig_created') {
                                    class_text += 'text-teal';
                                }
                                var dateTime = new Date(value.created_on)
                                let options = {
                                    year: 'numeric',
                                    month: 'short',
                                    day: 'numeric',
                                    hour: 'numeric',
                                    minute: 'numeric',
                                    hour12: true
                                };
                                html_text += '<h6 class="font-weight-semibold ' + class_text + '">' + value.text + '<p class="font-weight-normal font-size-sm text-muted">' + dateTime.toLocaleString('en-GB', options) + '</p></h6>'
                            })
                        } else {
                            html_text += '<div>No gig history found!</div>'
                        }
                        $('.modal-body').empty().html(html_text)
                        $('#showModal').modal('show');
                    }
                })
            }


            var swalInit = swal.mixin({
                buttonsStyling: false,
                confirmButtonClass: 'btn btn-primary',
                cancelButtonClass: 'btn btn-light'
            });

            // $('.deleteBtn i').click(function () {
            //     // setTimeout(function () {
            //         $(this).parents('.deleteBtn').trigger('click');
            //     // }, 500)
            // })

            $('.deleteBtn').on('click', function(e) {
                e.preventDefault();
                var gig_id = $(this).attr('data-id')
                // var form = e.target.form
                console.log(gig_id)
                swalInit.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel!',
                    confirmButtonClass: 'btn btn-success',
                    cancelButtonClass: 'btn btn-danger',
                    buttonsStyling: false
                }).then(function(result) {
                    if (result.value) {
                        // form.submit();
                        $.ajax({
                            url: base_url + "gigs/trash/" + gig_id,
                            method: "get",
                            dataType: "json",
                            success: function(result) {
                                console.log(result.status);
                                location.reload();
                            }
                        })
                        // swalInit.fire(
                        //     'Deleted!',
                        //     'Gig has been deleted.',
                        //     'success'
                        // );
                    } else if (result.dismiss === swal.DismissReason.cancel) {
                        swalInit.fire(
                            'Cancelled',
                            'Gig is safe',
                            'error'
                        );
                    }
                });
            });
            $('.releasePayment').on('click', function(e) {
                e.preventDefault();
                var gig_id = $(this).attr('data-id')
                // var form = e.target.form
                console.log(gig_id)
                $.ajax({
                    url: base_url + "gigs/releasePayment/" + gig_id,
                    method: "get",
                    dataType: "json",
                    success: function(result) {
                        console.log(result.status);
                        if (result.status) {
                            swalInit.fire(
                                'Success',
                                'Payment has been successfully transferred to Gig owner',
                                'success'
                            );
                        } else {
                            swalInit.fire(
                                'Error',
                                result.message,
                                'error'
                            );
                        }
                        // location.reload();
                    }
                })
            });
        });
    </script>
</body>

</html>