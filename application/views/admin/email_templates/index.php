<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('admin/layout/meta_tags'); ?>
    <title>Email Templates</title>
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
                            <span class="breadcrumb-item active">Email Templates</span>
                        </div>

                        <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                    </div>
                </div>
            </div>
            <div class="content">
                <?php $this->load->view('alert/alert'); ?>
                <!-- Striped rows -->
                <div class="card">
                    <form name="datas_form" id="datas_form" method="post" action="">
                        <div class="card-header header-elements-inline">
                            <h5 class="card-title">Email Templates</h5>
                            <div class="header-elements">
                                <div class="list-icons">
                                    <label class="mb-0">Search: </label>
                                    <input type="text" name="search" id="search" class="form-control" placeholder="Search..." value="<?php echo (isset($_POST['search']) && strlen($_POST['search']) > 0) ? $_POST['search'] : ''; ?>">
                                    <!--<a class="list-icons-item" data-action="collapse"></a>
                                <a class="list-icons-item" data-action="reload"></a>
                                <a class="list-icons-item" data-action="remove"></a> -->
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <div id="table">
                                <?php //$this->load->view('admin/email_templates/index_partial'); 
                                ?>
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Recipients</th>
                                            <th>Subject</th>
                                            <th>Template Slug</th>
                                            <th>Content</th>
                                            <th>Modified on</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sr_no = 1;
                                        if (isset($records) && count($records) > 0) {
                                            foreach ($records as $record) { ?>
                                                <tr>
                                                    <td><?php echo $sr_no; ?></td>
                                                    <td><?php echo $record->recipients; ?></td>
                                                    <td><?php echo $record->subject; ?></td>
                                                    <td><?php echo $record->template_slug; ?></td>
                                                    <td><button type="button" data-id="<?php echo $record->id; ?>" class="btn btn-primary btn-sm preview-content"><i class="icon-eye4 mr-2"></i> Preview</button></td>
                                                    <td><?php echo date('M d, Y H:i A', strtotime($record->updated_on)); ?></td>
                                                    <td>
                                                        <div class="d-flex">
                                                            <a href="<?php echo admin_base_url() ?>email_templates/update/<?php echo $record->id ?>" type="button" class="btn btn-primary btn-icon"><i class="icon-pencil7"></i></a> &nbsp; <a href="<?php echo admin_base_url() ?>email_templates/trash/<?php echo $record->id ?>" type="button" class="btn btn-danger btn-icon" onClick="return confirm('Do you want to delete this?');"><i class="icon-trash"></i></a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php
                                                $sr_no++;
                                            }
                                        } else { ?>
                                            <tr>
                                                <td colspan="7" style="text-align:center;">
                                                    <div style="padding: 10px; text-align: center; color: #333;"> No record found! </div>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /striped rows -->
            </div>

            <div id="modal_large" class="modal fade" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Template Preview</h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <div class="modal-body">
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <?php $this->load->view('admin/layout/footer'); ?>

        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#sidebar_email').addClass('nav-item-open');
            $('#sidebar_email ul').first().css('display', 'block');
            $('#sidebar_email_view a').addClass('active');

            $('.preview-content').click(function() {
                var id = $(this).data('id');
                console.log(id);
                $.ajax({
                    url: base_url + 'email_templates/get_template_content',
                    data: {
                        id: id
                    },
                    method: 'POST',
                    dataType: 'JSON',
                    success: function(resp) {
                        if (resp.record) {
                            $('.modal-body').empty();
                            $('.modal-body').append(resp.record.content)
                            $('#modal_large').modal('show')
                        }
                    }
                })
            })
        });
    </script>
</body>

</html>