<!DOCTYPE html>
<html lang="en">

<head>
	<?php $this->load->view('admin/layout/meta_tags'); ?>
	<title>Configurations</title>
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
                            <span class="breadcrumb-item active">Popularity Weightages</span>
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
						<h5 class="card-title">Popularity Weightages</h5>
					</div>

					<div class="card-body">
						<form action="<?php echo admin_base_url() ?>configurations/popularity_weightage" method="post" id="datas_form">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Backers per day Weight <span class="text-danger">*</span></label>
										<input type="text" class="form-control" value="<?php echo $backers_per_day ?? '' ?>" name="backers_per_day" data-error="#backers_per_day1">
										<span id="backers_per_day1" class="text-danger" generated="true"><?php echo form_error('backers_per_day'); ?></span>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Percantage Funded Weight <span class="text-danger">*</span></label>
										<input type="text" class="form-control" value="<?php echo $percentage_funded ?? '' ?>" name="percentage_funded" data-error="#percentage_funded1">
										<span id="percentage_funded1" class="text-danger" generated="true"><?php echo form_error('percentage_funded'); ?></span>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Percentage per data Weight <span class="text-danger">*</span></label>
										<input type="text" class="form-control" value="<?php echo $percentage_per_day ?? '' ?>" name="percentage_per_day" data-error="#percentage_per_day1">
										<span id="percentage_per_day1" class="text-danger" generated="true"><?php echo form_error('percentage_per_day'); ?></span>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Amount Raised Weight <span class="text-danger">*</span></label>
										<input type="text" class="form-control" value="<?php echo $amount_raised ?? '' ?>" name="amount_raised" data-error="#amount_raised1">
										<span id="amount_raised1" class="text-danger" generated="true"><?php echo form_error('amount_raised'); ?></span>
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
			$('#sidebar_popularity_weightage a').addClass('active');

			var validator = $('#datas_form').validate({
				rules: {
					backers_per_day: {
						required: true
					},
					percentage_funded: {
						required: true
					},
					percentage_per_day: {
						required: true
					},
					amount_raised: {
						required: true
					}
				},
				messages: {
                    backers_per_day: {
                        required: "Backers per day Weight is required field"
					},
                    percentage_funded: {
                        required: "Percantage Funded Weight is required field"
                    },
					percentage_per_day: {
                        required: "Percentage per data Weight is required field"
					},
                    amount_raised: {
                        required: "Amount Raised Weight is required field"
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