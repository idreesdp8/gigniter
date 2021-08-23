<!DOCTYPE html>
<html lang="en">

<head>
	<?php $this->load->view('admin/layout/meta_tags'); ?>
	<title>AWS Configuration</title>
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
                            <a href="<?php echo admin_base_url(); ?>configurations" class="breadcrumb-item"> Configurations</a>
                            <span class="breadcrumb-item active">AWS Configuration</span>
						</div>

						<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
					</div>
				</div>
			</div>
			<div class="content">
				<?php $this->load->view('alert/alert'); ?>
				<!-- Basic layout-->
				<div class="card">
					<div class="card-header header-elements-inline">
						<h5 class="card-title">AWS Configuration</h5>
					</div>

					<div class="card-body">
						<form action="<?php echo admin_base_url() ?>configurations/aws_config" method="post" id="datas_form">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label>AWS Key <span class="text-danger">*</span></label>
										<input type="text" class="form-control" value="<?php echo $aws_key ?? '' ?>" name="aws_key" data-error="#aws_key1">
										<span id="aws_key1" class="text-danger" generated="true"><?php echo form_error('aws_key'); ?></span>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label>AWS Secret <span class="text-danger">*</span></label>
										<input type="text" class="form-control" value="<?php echo $aws_secret ?? '' ?>" name="aws_secret" data-error="#aws_secret1">
										<span id="aws_secret1" class="text-danger" generated="true"><?php echo form_error('aws_secret'); ?></span>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label>AWS Version <span class="text-danger">*</span></label>
										<input type="text" class="form-control" value="<?php echo $aws_version ?? '' ?>" name="aws_version" data-error="#aws_version1">
										<span id="aws_version1" class="text-danger" generated="true"><?php echo form_error('aws_version'); ?></span>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label>AWS Region <span class="text-danger">*</span></label>
										<input type="text" class="form-control" value="<?php echo $aws_region ?? '' ?>" name="aws_region" data-error="#aws_region1">
										<span id="aws_region1" class="text-danger" generated="true"><?php echo form_error('aws_region'); ?></span>
									</div>
								</div>
							</div>
							<div class="text-right">
								<button type="submit" class="btn btn-primary"><i class="icon-add mr-2"></i> Update</button>
							</div>
						</form>
					</div>
				</div>
				<!-- /basic layout -->

			</div>

			<?php $this->load->view('admin/layout/footer'); ?>

		</div>
	</div>

	<script>
		$(document).ready(function() {
			$('#sidebar_configuration').addClass('nav-item-open');
			$('#sidebar_configuration ul').first().css('display', 'block');
			$('#sidebar_aws a').addClass('active');

			var validator = $('#datas_form').validate({
				rules: {
					aws_key: {
						required: true
					},
					aws_secret: {
						required: true
					},
				},
				messages: {
                    aws_key: {
                        required: "AWS Key is required field"
					},
                    aws_secret: {
                        required: "AWS Secret is required field"
                    },
				},
				errorPlacement: function(error, element) {
					var placement = $(element).data('error');
					if (placement) {
						$(placement).append(error)
					} else {
						error.insertAfter(element);
					}
				},
				submitHandler: function() {
					document.forms["datas_form"].submit();
				}
			});
		});
	</script>
</body>

</html>