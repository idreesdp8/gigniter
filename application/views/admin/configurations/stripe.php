<!DOCTYPE html>
<html lang="en">

<head>
	<?php $this->load->view('admin/layout/meta_tags'); ?>
	<title>Stripe Configuration</title>
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
                            <span class="breadcrumb-item active">Stripe Configuration</span>
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
						<h5 class="card-title">Stripe Configuration</h5>
					</div>

					<div class="card-body">
						<form action="<?php echo admin_base_url() ?>configurations/stripe" method="post" id="datas_form">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label>Stripe Key <span class="text-danger">*</span></label>
										<input type="text" class="form-control" value="<?php echo $stripe_key ?? '' ?>" name="stripe_key" data-error="#stripe_key1">
										<span id="stripe_key1" class="text-danger" generated="true"><?php echo form_error('stripe_key'); ?></span>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label>Stripe Secret <span class="text-danger">*</span></label>
										<input type="text" class="form-control" value="<?php echo $stripe_secret ?? '' ?>" name="stripe_secret" data-error="#stripe_secret1">
										<span id="stripe_secret1" class="text-danger" generated="true"><?php echo form_error('stripe_secret'); ?></span>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label>Stripe Currency <span class="text-danger">*</span></label>
										<input type="text" class="form-control" value="<?php echo $stripe_currency ?? '' ?>" name="stripe_currency" data-error="#stripe_currency1">
										<span id="stripe_currency1" class="text-danger" generated="true"><?php echo form_error('stripe_currency'); ?></span>
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
			$('#sidebar_stripe a').addClass('active');

			var validator = $('#datas_form').validate({
				rules: {
					stripe_key: {
						required: true
					},
					stripe_secret: {
						required: true
					},
					stripe_currency: {
						required: true
					},
				},
				messages: {
                    stripe_key: {
                        required: "Stripe Key is required field"
					},
                    stripe_secret: {
                        required: "Stripe Secret is required field"
                    },
                    stripe_currency: {
                        required: "Stripe Currency is required field"
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