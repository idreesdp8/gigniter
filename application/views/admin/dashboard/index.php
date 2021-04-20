<!DOCTYPE html>
<html lang="en">

<head>
	<?php $this->load->view('admin/layout/meta_tags'); ?>
	<title>Dashboard</title>
	<style>
		.font-size-2 {
			font-size: 2rem;
		}
	</style>
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
							<span class="breadcrumb-item active">Dashboard</span>
						</div>

						<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
					</div>
				</div>
			</div>
			<!-- /page header -->
			<!-- Content area -->
			<div class="content">
				<div class="row">
					<div class="col-lg-3">
						<div class="card bg-teal-400">
							<div class="card-body">
								<div class="d-flex">
									<div>
										<div class="d-flex">
											<h3 class="font-weight-semibold mb-0"><?php echo $gigs_count ?></h3>
											<!-- <span class="badge bg-teal-800 badge-pill align-self-center ml-auto">+53,6%</span> -->
										</div>
										<div>
											Total Gigs
											<!-- <div class="font-size-sm opacity-75">489 avg</div> -->
										</div>
									</div>
									<span class="align-self-center ml-auto"><i class="icon-mic2 font-size-2"></i></span>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-3">
						<div class="card bg-violet-400">
							<div class="card-body">
								<div class="d-flex">
									<div>
										<div class="d-flex">
											<h3 class="font-weight-semibold mb-0"><?php echo $customers_count ?></h3>
											<!-- <span class="badge bg-teal-800 badge-pill align-self-center ml-auto">+53,6%</span> -->
										</div>
										<div>
											Total Customers
											<!-- <div class="font-size-sm opacity-75">489 avg</div> -->
										</div>
									</div>
									<span class="align-self-center ml-auto"><i class="icon-user font-size-2"></i></span>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-3">
						<div class="card bg-indigo-400">
							<div class="card-body">
								<div class="d-flex">
									<div>
										<div class="d-flex">
											<h3 class="font-weight-semibold mb-0"><?php echo $bookings_count ?></h3>
											<!-- <span class="badge bg-teal-800 badge-pill align-self-center ml-auto">+53,6%</span> -->
										</div>
										<div>
											Total Orders
											<!-- <div class="font-size-sm opacity-75">489 avg</div> -->
										</div>
									</div>
									<span class="align-self-center ml-auto"><i class="icon-cart font-size-2"></i></span>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-3">
						<div class="card bg-success-400">
							<div class="card-body">
								<div class="d-flex">
									<div>
										<div class="d-flex">
											<h3 class="font-weight-semibold mb-0"><?php echo '$' . $transaction->admin_fee ?></h3>
											<!-- <span class="badge bg-teal-800 badge-pill align-self-center ml-auto">+53,6%</span> -->
										</div>
										<div>
											Total Admin Fee
											<!-- <div class="font-size-sm opacity-75">489 avg</div> -->
										</div>
									</div>
									<span class="align-self-center ml-auto"><i class="icon-coin-dollar font-size-2"></i></span>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="card">
					<div class="card-header header-elements-inline">
						<h5 class="card-title">Stacked lines</h5>
						<div class="header-elements">
							<div class="list-icons">
								<a class="list-icons-item" data-action="collapse"></a>
								<a class="list-icons-item" data-action="reload"></a>
								<a class="list-icons-item" data-action="remove"></a>
							</div>
						</div>
					</div>

					<div class="card-body">
						<div class="chart-container">
							<div class="chart has-fixed-height" id="line_stacked"></div>
						</div>
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
		$(document).ready(function() {
			$('#sidebar_dashboard a').addClass('active');
		});
	</script>
</body>

</html>