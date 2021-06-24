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
                            <span class="breadcrumb-item active">Bookings</span>
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
								<button type="button" class="btn btn-info w-100" id="collect">Collect Payments</button>
                            </div>
                        </div>
                    </div>

                    <!-- <div class="card-body">
						Example of a table with <code>striped</code> rows. Use <code>.table-striped</code> added to the base <code>.table</code> class to add zebra-striping to any table odd row within the <code>&lt;tbody&gt;</code>. This styling doesn't work in IE8 and lower as <code>:nth-child</code> CSS selector isn't supported in these browser versions. Striped table can be combined with other table styles.
					</div> -->

                    <div class="table-responsive">
                        <div class="row mt-4 ml-4 mr-4 mb-0 align-items-center"> 
						   <div class="col-md-1">
                                <div class="form-group"> 
                                    <label for="gig_id"> Gig: </label> 
                                </div>
                            </div> 
                            <div class="col-md-3">
                                <div class="form-group"> 
                                    <select name="gig_id" id="gig_id" class="form-control">
                                        <option value="">Select Option</option>
                                        <?php
                                        if ($gigs) :
                                            foreach ($gigs as $gig) :
                                        ?>
                                                <option value="<?php echo $gig->id ?>" <?php echo (isset($gig_id) && $gig_id == $gig->id) ? 'selected' : '' ?>><?php echo $gig->title ?></option>
                                        <?php
                                            endforeach;
                                        endif;
                                        ?>
                                    </select>
                                </div>
                            </div> 
							<div class="col-md-1">
                                <div class="form-group"> 
                                    <label for="is_paid"> Paid: </label> 
                                </div>
                            </div> 
                            <div class="col-md-3">
                                <div class="form-group"> 
                                    <select name="is_paid" id="is_paid" class="form-control">
                                        <option value="">Select Option</option>
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                            </div> 
                            <!--<div class="col-md-2">
                                <button type="button" class="btn btn-info w-100" id="collect">Collect Payments</button>
                            </div>-->
                        </div>
                        <table class="table table-striped datatable-custom">
                            <?php if (isset($records) && count($records) > 0) { ?>
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" id="check-all"></th>
                                        <th>#</th>
                                        <th>Order #</th>
                                        <th>Gig Title</th>
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
                                            <td><input type="checkbox" class="booking-checkbox" value="<?php echo $record->id ?>" <?php echo $record->is_paid ? 'disabled' : '' ?>></td>
                                            <td><?php echo $i ?></td>
                                            <td><?php echo $record->booking_no ?></td>
                                            <td><?php echo $record->gig->title ?></td>
                                            <td>$<?php echo $record->price ?></td>
                                            <td><?php echo $record->item_count ?></td>
                                            <td>
                                                <?php
                                                if ($record->is_paid) :
                                                    echo '<span class="badge badge-success">Yes</span>';
                                                else :
                                                    echo '<span class="badge badge-danger">No</span>';
                                                endif;
                                                ?>
                                            </td>
                                            <td><?php echo date('M d, Y', strtotime($record->created_on)) ?></td>
                                            <td>
                                                <div class="d-flex">
                                                    <a href="<?php echo admin_base_url() . 'bookings/show/' . $record->id ?>" type="button" class="btn btn-primary btn-icon ml-2"><i class="icon-pencil7"></i></a>
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
        var swalInit = swal.mixin({
            buttonsStyling: false,
            confirmButtonClass: 'btn btn-primary',
            cancelButtonClass: 'btn btn-light'
        });

        function reload_datatable() {
            var is_paid = $('#is_paid').val();
            var gig_id = $('#gig_id').val();
            // console.log('Paid ' + is_paid);
            // console.log('Gig ' + gig_id);
            $('.datatable-custom').DataTable({
                "destroy": true,
                "columnDefs": [{
                    "orderable": false,
                    "targets": 0
                }],
                "order": [
                    [1, 'asc']
                ],
                "ajax": {
                    "url": base_url + 'bookings/reload_datatable',
                    "type": "POST",
                    "data": {
                        is_paid: is_paid,
                        gig_id: gig_id,
                    },
                    dataType: 'json',
                },
                dataSrc: function(json) {
                    if (json.tableData === null) {
                        return [];
                    }
                    return json.tableData;
                }
            }).ajax.reload();
            $('#check-all').prop('checked', false)
        }
        $(document).ready(function() {
            $('#sidebar_booking a').addClass('active');

            $('#is_paid').change(function() {
                reload_datatable();
            });
            $('#gig_id').change(function() {
                reload_datatable();
            });
            $('.datatable-custom').DataTable({
                columnDefs: [{
                    orderable: false,
                    targets: 0
                }],
                order: [
                    [1, 'asc']
                ]
            });
            $('#check-all').change(function() {
                $('input:checkbox').not(this).not(":disabled").prop('checked', this.checked);
            })
            $('#collect').click(function() {
                var ids = [];
                var checkboxes = $('input:checkbox');
                checkboxes.each(function(index, elem) {
                    if (elem.checked && elem.value > 0) {
                        ids.push(elem.value)
                    }
                })
                $.ajax({
                    url: base_url + 'bookings/collect_payment',
                    data: {
                        booking_ids: ids
                    },
                    method: 'post',
                    dataType: 'json',
                    success: function(resp) {
                        if (resp) {
                            $('.datatable-custom').DataTable({
                                "destroy": true,
                                "columnDefs": [{
                                    "orderable": false,
                                    "targets": 0
                                }],
                                "order": [
                                    [1, 'asc']
                                ],
                                "ajax": {
                                    "url": base_url + 'bookings/reload_datatable',
                                    "type": "POST",
                                    "data": {},
                                    dataType: 'json',
                                },
                                dataSrc: function(json) {
                                    if (json.tableData === null) {
                                        return [];
                                    }
                                    return json.tableData;
                                }
                            }).ajax.reload();
                            $('#check-all').prop('checked', false)
                            swalInit.fire({
                                type: 'success',
                                title: 'Payment successfuly collected',
                            });
                        } else {
                            swalInit.fire({
                                type: 'error',
                                title: 'Payment not collected',
                            });
                        }
                    }
                })
            })

        });
    </script>
</body>

</html>