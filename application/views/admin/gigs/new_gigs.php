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
                        <?php if (isset($records) && count($records) > 0) { ?>
                            <table class="table table-striped datatable-basic">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>User</th>
                                        <th>Title</th>
                                        <th>Category</th>
                                        <th>Genre</th>
                                        <th>Concert Date</th>
                                        <th>Campaign Date</th>
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
                                            <td><?php echo $record->ticket_limit ?></td>
                                            <td><?php echo date('M d, Y', strtotime($record->created_on)) ?></td>
                                            <td>
                                                <div class="d-flex">
                                                    <!--  -->
                                                    <a href="<?php echo admin_base_url() . 'gigs/approve_gig/' . $record->id ?>" data-popup="tooltip" data-original-title="Approve Gig" type="button" class="btn btn-primary btn-icon ml-2"><i class="icon-checkmark4"></i></a>
                                                    <!-- <a href="<?php echo admin_base_url() . 'gigs/reject_gig/' ?>" data-id="<?php echo $record->id ?>" data-popup="tooltip" data-original-title="Reject Gig" type="button" onclick="reject_gig(this.id)" id="reject_gig" class="btn btn-danger btn-icon ml-2"><i class="icon-x"></i></a> -->
                                                    <div data-id="<?php echo $record->id ?>" data-popup="tooltip" data-original-title="Reject Gig" type="button" onclick="reject_gig()" id="reject_gig" class="btn btn-danger btn-icon ml-2"><i class="icon-x"></i></div>
                                                </div>
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
                <!-- /striped rows -->

            </div>

            <?php $this->load->view('admin/layout/footer'); ?>

        </div>
    </div>

    <script>
        var swalInit = swal.mixin({
            buttonsStyling: false,
            confirmButtonClass: 'btn btn-primary',
            cancelButtonClass: 'btn btn-light'
        });

        function reject_gig() {
            // var url = $('#reject_gig').attr('href');
            var url = "<?php echo admin_base_url() . 'gigs/reject_gig/' ?>";
            var gig_id = $('#reject_gig').attr('data-id');
            console.log(url);
            // swalInit.fire({
            //     title: 'Please select a Reason for rejecting the gig!',
            //     showCloseButton: true,
            //     html: '<h5>Meow</h5>'
            // })
            $.ajax({
                url: base_url + 'rejection_reasons/get_rejection_reasons',
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    var inputOptions = new Promise(function(resolve) {
                        resolve(response);
                    });
                    swalInit.fire({
                        title: 'Select a Reason for rejecting the gig',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, reject!',
                        cancelButtonText: 'No, cancel!',
                        confirmButtonClass: 'btn btn-success',
                        cancelButtonClass: 'btn btn-danger',
                        input: 'radio',
                        inputOptions: inputOptions,
                        inputClass: 'form-check-styled',
                        inputValidator: function(value) {
                            return !value && 'You need to choose something!'
                        },
                        onOpen: function() {
                            $('.swal2-radio').css("flex-direction", "column")
                            $('.swal2-radio label+label').css("margin-left", "0")
                            $('.swal2-radio.form-check-styled input[type=radio]').uniform();
                        }
                    }).then(function(result) {
                        if (result.value) {
                            console.log(result.value);
                            $.ajax({
                                url: url,
                                method: 'post',
                                data: {
                                    gig_id: gig_id,
                                    rejection_reason: result.value
                                },
                                dataType: 'json',
                                success: function(resp) {
                                    if (resp.status) {
                                        window.location.href = base_url + resp.route;
                                    } else {
                                        swalInit.fire({
                                            title: 'Error',
                                            type: 'warning'
                                        });
                                    }
                                }
                            })
                        } else if (result.dismiss === swal.DismissReason.cancel) {
                            swalInit.fire(
                                'Cancelled',
                                'Gig is not rejected!',
                                'error'
                            );
                        }
                    });
                }
            })
        }

        $(document).on('click', 'input[type=radio]', function() {
            const radio = $(this)
            if(radio.val() == 'other') {
                $('.swal2-content').append('<input class="swal2-input form-control" placeholder="Reason?" type="text" style="display: flex;">');
                $('.swal2-input').on('input',function() {
                    var reason = $(this).val();
                    radio.val(reason);
                })
            }
        })
        $(document).ready(function() {
            $('#sidebar_gig').addClass('nav-item-open');
            $('#sidebar_gig ul').first().css('display', 'block');
            $('#sidebar_approval_gig_view a').addClass('active');

            // var swalInit = swal.mixin({
            //     buttonsStyling: false,
            //     confirmButtonClass: 'btn btn-primary',
            //     cancelButtonClass: 'btn btn-light'
            // });

            // $('#reject_gig').on('click', function(e) {
            //     e.preventDefault();
            //     console.log('meow')
            //     var url = $(this).attr('href');
            //     var gig_id = $(this).attr('data-id');
            //     console.log(url);
            //     // swalInit.fire({
            //     //     title: 'Please select a Reason for rejecting the gig!',
            //     //     showCloseButton: true,
            //     //     html: '<h5>Meow</h5>'
            //     // })
            //     $.ajax({
            //         url: base_url + 'rejection_reasons/get_rejection_reasons',
            //         method: 'GET',
            //         dataType: 'json',
            //         success: function(response) {
            //             console.log(response);
            //             var inputOptions = new Promise(function(resolve) {
            //                 resolve(response);
            //             });
            //             swalInit.fire({
            //                 title: 'Select a Reason for rejecting the gig',
            //                 showCancelButton: true,
            //                 confirmButtonText: 'Yes, reject!',
            //                 cancelButtonText: 'No, cancel!',
            //                 confirmButtonClass: 'btn btn-success',
            //                 cancelButtonClass: 'btn btn-danger',
            //                 input: 'radio',
            //                 inputOptions: inputOptions,
            //                 inputClass: 'form-check-styled',
            //                 inputValidator: function(value) {
            //                     return !value && 'You need to choose something!'
            //                 },
            //                 onOpen: function() {
            //                     $('.swal2-radio').css("flex-direction", "column")
            //                     $('.swal2-radio label+label').css("margin-left", "0")
            //                     $('.swal2-radio.form-check-styled input[type=radio]').uniform();
            //                 }
            //             }).then(function(result) {
            //                 if (result.value) {
            //                     $.ajax({
            //                         url: url,
            //                         method: 'post',
            //                         data: {
            //                           gig_id: gig_id,
            //                           rejection_reason: result.value
            //                         },
            //                         dataType: 'json',
            //                         success: function(resp) {
            //                             if(resp.status) {
            //                                 window.location.href = base_url + resp.route;
            //                                 // swalInit.fire({
            //                                 //     type: 'success',
            //                                 //     title: 'Success',
            //                                 //     text: 'Gig has been rejected!',
            //                                 // });
            //                             } else {
            //                                 swalInit.fire({
            //                                     title: 'Error',
            //                                     type: 'warning'
            //                                 });
            //                             }
            //                         }
            //                     })
            //                 } else if (result.dismiss === swal.DismissReason.cancel) {
            //                     swalInit.fire(
            //                         'Cancelled',
            //                         'Gig is not rejected!',
            //                         'error'
            //                     );
            //                 }
            //             });
            //         }
            //     })
            // })
        });
    </script>
</body>

</html>