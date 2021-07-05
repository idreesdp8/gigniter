<!DOCTYPE html>
<html lang="en">

<head>
	<?php $this->load->view('frontend/layout/meta_tags'); ?>
	<title>Gigniter - Online Ticket Booking Service</title>
	<style>
		.exlpore-title,
		.explore-subtitle {
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

		.bundle-pill {
			padding: 3px 8px;
			background: #f1c40c;
			margin: 2px;
			border-radius: .75rem;
			color: #0e1e5e;
			font-weight: 600;
		}

		.bundle_image {
			border-radius: 50%;
		}

		tr td {
			vertical-align: middle;
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
				<h2 class="exlpore-title">Payment Details</h2>
				<h5 class="explore-subtitle">Gig Title: <?php echo $gig->title ?? ''; ?></h5>
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
						<h5 class="title">Payment Details</h5>
						<div class="row">
							<div class="col-lg-9">
								<div class="row">
									<div class="col-lg-4">
										<h6>Gig Title</h6>
										<p><?php echo $gig->title; ?></p>
									</div>
									<div class="col-lg-4">
										<h6>Quantity</h6>
										<p><?php echo $gig->ticket_limit; ?></p>
									</div>
									<div class="col-lg-4">
										<h6>Tickets Left</h6>
										<p><?php echo $gig->ticket_left; ?></p>
									</div>
									<div class="col-lg-4">
										<h6>Genre</h6>
										<p><?php echo $gig->genre_label; ?></p>
									</div>
									<div class="col-lg-4">
										<h6>Category</h6>
										<p><?php echo $gig->category_label; ?></p>
									</div>
									<div class="col-lg-4">
										<h6>Total Sales</h6>
										<p><?php echo '$' . $gig->total_sale; ?></p>
									</div>
									<div class="col-lg-4">
										<h6>Venue(s)</h6>
										<p><?php echo $gig->venues; ?></p>
									</div>
									<div class="col-lg-4">
										<h6>Status</h6>
										<p><?php echo $gig->status_label; ?></p>
									</div>
									<div class="col-lg-4">
										<h6>Concert Date</h6>
										<p><?php echo date('M d,Y', strtotime($gig->gig_date)); ?></p>
									</div>
								</div>
							</div>
							<div class="col-lg-3">
								<div class="row">
									<div class="col-lg-12">
										<div class="circlebar">
											<div class="pie_progress3 <?php echo $gig->booked < 60 ? 'booked-color-2' : 'booked-color-1' ?>" role="progressbar" data-goal="<?php echo $gig->booked ?>">
												<div class="pie_progress__number"><?php echo $gig->booked ?>%</div>
												<div class="pie_progress__label">Booked</div>
											</div>
										</div>
									</div>
								</div>
							</div>


							<div class="col-lg-12" style="margin-top:15px;">
								<h6>Transactions</h6>
							</div> <br>
							<div class="col-lg-12">
								<div class="card">
									<div class="card-body">
										<table class="table text-white table-striped">
											<thead>
												<tr>
													<th>#</th>
													<th>Order #</th>
													<th>Customer</th>
													<th>Ticket Name</th>
													<th>Price</th>
													<th>Qty</th>
													<th>Sub Total</th>
													<th>Purchase Date</th>
													<th>Bundle(s)</th>
												</tr>
											</thead>
											<tbody>
												<?php
												if ($gig->cart_items) {
													foreach ($gig->cart_items as $key => $value) { ?>
														<tr>
															<td><?php echo $key + 1; ?></td> 
															<td><?php echo (isset($value->booking->booking_no)) ? $value->booking->booking_no : ''; ?></td>
															
															<td><?php echo $value->user_name ?></td>
															<td><?php echo $value->ticket->name ?? '' ?></td>
															<td><?php echo (isset($value->ticket->price)) ? '$' . $value->ticket->price : ''; ?></td>
															<td><?php echo $value->quantity ?></td>
															<td><?php echo '$' . $value->price ?></td>
															<td><?php echo date('M d, Y H:i A', strtotime($value->created_on)); ?></td>
															<td>
																<?php
																if (isset($value->ticket->bundles)) {
																	foreach ($value->ticket->bundles as $bundle) {
																?>
																		<img class="bundle_image" src="<?php echo $bundle->image ? bundle_thumbnail_url() . $bundle->image : ''; ?>" width="50" height="auto" />
																		<!-- echo '<span class="bundle-pill">' . $bundle->title . '</span>'; -->
																<?php
																	}
																} else {
																	echo 'NA';
																}
																?>
															</td>
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

							<div class="col-lg-12" style="margin-top:15px;">
								<h6>Tickets</h6>
							</div> <br>
							<div class="col-lg-12">
								<div class="card">
									<div class="card-body">
										<table class="table text-white table-striped">
											<thead>
												<tr>
													<th>Sr #</th>
													<th>Ticket #</th>
													<th>Gig</th>
													<th>Price ($)</th>
													<th>Category</th>
													<th>Address</th>
													<th>User</th>
													<th>User Email</th>
													<th>Purchase Date</th>
													<th>QR Code</th>
												</tr>
											</thead>
											<tbody>
												<?php
												$sr_no = 1;
												if (isset($tickets_rows)) {
													foreach ($tickets_rows as $tickets_row) { ?>
														<tr>
															<td><?php echo $sr_no; ?> </td>
															<td><?php echo $tickets_row->ticket_no; ?> </td>
															<td><?php echo $tickets_row->title . ' ' . $tickets_row->subtitle; ?> </td>
															<td><?php echo '$ ' . number_format($tickets_row->price, 2, ".", ","); ?> </td>
															<td><?php echo $tickets_row->category; ?> </td>
															<td><?php echo $tickets_row->address; ?> </td>
															<td><?php echo $tickets_row->fname . ' ' . $tickets_row->lname; ?> </td>
															<td><?php echo $tickets_row->email; ?> </td>
															<td><?php echo date('M d, Y H:i A', strtotime($tickets_row->created_on)) ?></td>
															<td>
																<?php
																if (strlen($tickets_row->qr_token) > 0) {
																	$qr_code_url = '';
																	if ($_SERVER['HTTP_HOST'] == "localhost") {
																		$qr_code_url = "http://" . $_SERVER["HTTP_HOST"] . "/gigniter/downloads/tickets_qr_code_imgs/ticket_" . $tickets_row->qr_token . ".png";
																	} else {
																		$qr_code_url = "http://" . $_SERVER["HTTP_HOST"] . "/downloads/tickets_qr_code_imgs/ticket_" . $tickets_row->qr_token . ".png";
																	} ?>
																	<img src="<?php echo $qr_code_url; ?>" style="width:60px; height:60px;">
																<?php
																} else {
																	echo "N/A";
																} ?>
															</td>
														</tr>
													<?php
														$sr_no++;
													}
												}

												if ($sr_no == 1) {  ?>
													<tr>
														<td colspan="9" style="text-align:center"><strong>No record found!</strong></td>
													</tr>
												<?php } ?>
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