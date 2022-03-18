<!DOCTYPE html>
<html lang="en">

<head>
	<?php $this->load->view('frontend/layout/meta_tags'); ?>
	<title>Gigniter - Online Ticket Booking Service</title>
	<style>
		.exlpore-title {
			text-transform: uppercase;
		}

		.card {
			background-color: #11326f;
			/* box-shadow: 0 4px 8px 0 #061332ab; */
		}

		.ticket_info {
			display: flex;
			justify-content: space-between;
		}

		tr td {
			vertical-align: middle;
		}
		.table a {
			text-decoration: none;
			color: #fff;
		}
	</style>
</head>

<body>
	<?php $this->load->view('frontend/layout/preloader'); ?>
	<?php $this->load->view('frontend/layout/header'); ?>
	<!-- Page content -->
	<!-- ==========Banner-Section========== -->
	<section class="explore-banner-section bg_img" data-background="<?php echo user_asset_url(); ?>images/banner/banner-3.png">
		<div class="container">
			<div class="text-box text-center">
				<h2 class="exlpore-title">My Wallet</h2>
			</div>
		</div>
	</section>
	<!-- ==========Banner-Section========== -->

	<!-- ==========Explore-content-Section========== -->
	<div class="event-facility padding-bottom padding-top">
		<div class="container">
			<?php $this->load->view('alert/alert'); ?>
			<div class="row">
				<div class="col-lg-12">
					<div class="checkout-widget checkout-contact">
						<!-- <h5 class="title">Gigs</h5> -->
						<div class="row">
							<div class="col-lg-12">
								<div class="card">
									<div class="card-body">
										<table class="table text-white table-striped">
											<thead>
												<tr>
													<th>#</th>
													<th>Gig</th>
													<th>Status</th>
													<th>Total Sale</th>
													<th>Ticket Booked</th>
													<th>Ticket Left</th>
												</tr>
											</thead>
											<tbody>
												<?php
												if ($gigs) {
													foreach ($gigs as $key => $value) { ?>
														<tr>
															<td><?php echo $key + 1; ?></td>
															<td><a href="<?php echo user_base_url() . 'transactions/show/' . $value->id ?>" target="_blank"><?php echo $value->title ?></a></td>
															<td>
																<?php if($value->status == 0) : ?>
																	Inactive
																<?php elseif($value->status == 1) : ?>
																	Active
																<?php elseif($value->status == 2) : ?>
																	Live
																<?php elseif($value->status == 3) : ?>
																	Completed
																<?php endif; ?>
															</td>
															<td><?php echo '$' . $value->total_sale ?></td>
															<td><?php echo $value->ticket_bought ?></td>
															<td><?php echo $value->ticket_left ?></td>
														</tr>
													<?php
													}
												} else { ?>
													<tr>
														<td colspan="9" style="text-align:center"><strong>No record found!</strong></td>
													</tr>
												<?php  } ?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="d-flex float-right">
						<a type="button" class="btn btn-secondary ml-2" href="<?php echo user_base_url() . 'transactions'; ?>">Back</a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- ==========Explore-content-Section========== -->
	<!-- /page content -->

	<?php $this->load->view('frontend/layout/footer'); ?>
	<?php $this->load->view('frontend/layout/scripts'); ?>
	<script>
	</script>
</body>

</html>