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
                                <input type="text" name="search" id="search" class="form-control" placeholder="Search..." value="<?php echo (isset($_POST['search']) && strlen($_POST['search'])>0) ? $_POST['search'] : ''; ?>">
                                 <!--<a class="list-icons-item" data-action="collapse"></a>
                                <a class="list-icons-item" data-action="reload"></a>
                                <a class="list-icons-item" data-action="remove"></a> -->
                            </div>
                        </div>
                    </div> 

                    <div class="table-responsive">
                        <div id="table">
                            <?php //$this->load->view('admin/email_templates/index_partial'); ?> 
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
												<td><?php echo $record->content; ?></td> 
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
										
									}else{ ?>
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

            <?php $this->load->view('admin/layout/footer'); ?>

        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#sidebar_user').addClass('nav-item-open');
            $('#sidebar_user ul').first().css('display', 'block');
            $('#sidebar_user_view a').addClass('active'); 
        });
    </script>
</body>

</html>